<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Method;
use App\Payment;
use App\Storage;
use App\Transaction;
use App\TransactionItem;
use App\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionController extends Controller
{
    //
    public function listOnGoing()
    {
        $user = Auth::user();
        $ongoing = DB::table('transaction')
            ->join('transaction_item', 'transaction_item.transaction_id', '=', 'transaction.transaction_id')
            ->join('payment', 'payment.payment_id', '=', 'transaction.payment_id')
            ->join('unit', 'transaction_item.unit_id', '=', 'unit.unit_id')
            ->join('box', 'box.box_id', '=', 'unit.box_id')
            ->join('detail', 'box.detail_id', '=', 'detail.detail_id')
            ->join('promo', 'promo.promo_id', '=', 'payment.promo_id')
            ->join('storage', 'storage.storage_id', '=', 'box.storage_id')
            ->join('review', 'review.storage_id', '=', 'storage.storage_id')
            ->join('users', 'users.id', '=', 'transaction.user_id')
            ->where(['transaction.user_id' => $user->id, 'transaction.state' => 0])
            ->groupBy([
                'transaction.transaction_id',
                'transaction.total_price',
                'transaction.insurance',
                'transaction.pin',
                'transaction.start_rent',
                'transaction.end_rent',
                'storage.name',
                'storage.address',
                'storage.city',
                'storage.description',
                'storage.image',
                'storage.image1',
                'storage.image2',
                'storage.image3',
                'users.name',
                'detail.type',
                'promo.description',
                'payment.status',
            ])
            ->select(
                'transaction.transaction_id AS transaction_id',
                'transaction.total_price AS total_price',
                'transaction.insurance',
                'transaction.pin AS pin',
                'transaction.start_rent AS start_rent',
                'transaction.end_rent AS end_rent',
                'storage.name AS storage_name',
                'storage.address AS storage_address',
                'storage.city AS storage_city',
                'storage.description AS storage_description',
                DB::raw("AVG(rate) AS rate"),
                'storage.image AS storage_image',
                'storage.image1 AS storage_image1',
                'storage.image2 AS storage_image2',
                'storage.image3 AS storage_image3',
                'users.name AS owner',
                'detail.type AS type',
                'promo.description AS promo',
                'payment.status AS payment_status'
            )
            ->get();

        return response()->json(['success' => $ongoing]);
    }

    public function listHistory()
    {
        $user = Auth::user();
        $history = DB::table('transaction')
            ->join('transaction_item', 'transaction_item.transaction_id', '=', 'transaction.transaction_id')
            ->join('payment', 'payment.payment_id', '=', 'transaction.payment_id')
            ->join('unit', 'transaction_item.unit_id', '=', 'unit.unit_id')
            ->join('box', 'box.box_id', '=', 'unit.box_id')
            ->join('detail', 'box.detail_id', '=', 'detail.detail_id')
            ->join('promo', 'promo.promo_id', '=', 'payment.promo_id')
            ->join('storage', 'storage.storage_id', '=', 'box.storage_id')
            ->join('review', 'review.storage_id', '=', 'storage.storage_id')
            ->join('users', 'users.id', '=', 'transaction.user_id')
            ->where(['transaction.user_id' => $user->id, 'transaction.state' => 1])
            ->groupBy([
                'transaction.transaction_id',
                'transaction.total_price',
                'transaction.insurance',
                'transaction.pin',
                'transaction.start_rent',
                'transaction.end_rent',
                'storage.name',
                'storage.address',
                'storage.city',
                'storage.description',
                'storage.image',
                'storage.image1',
                'storage.image2',
                'storage.image3',
                'users.name',
                'detail.type',
                'promo.description',
                'payment.status',
                'transaction.review_state'
            ])
            ->select(
                'transaction.transaction_id AS transaction_id',
                'transaction.total_price AS total_price',
                'transaction.insurance',
                'transaction.pin AS pin',
                'transaction.start_rent AS start_rent',
                'transaction.end_rent AS end_rent',
                'storage.name AS storage_name',
                'storage.address AS storage_address',
                'storage.city AS storage_city',
                'storage.description AS storage_description',
                DB::raw("AVG(rate) AS rate"),
                'storage.image AS storage_image',
                'storage.image1 AS storage_image1',
                'storage.image2 AS storage_image2',
                'storage.image3 AS storage_image3',
                'users.name AS owner',
                'detail.type AS type',
                'promo.description AS promo',
                'payment.status AS payment_status',
                'transaction.review_state AS review_state'
            )
            ->get();
        return response()->json(['success' => $history]);
    }

    public function method()
    {
        $method = Method::all();
        return response()->json(['success' => $method]);
    }

    public function create(Request $request)
    {
        $storage = DB::select(DB::raw("SELECT b.box_id,COUNT(b.box_id) AS availability FROM unit u JOIN box b WHERE NOT EXISTS (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND t.transaction_id=ti.transaction_id AND (start_rent <= '" . $request->end_rent . "' and end_rent >= '" . $request->start_rent . "')) AND b.box_id=u.box_id AND b.box_id=" . $request->box_id . " GROUP BY b.box_id"));

        if (!$storage || $storage[0]->availability < $request->slot) {
            return response()->json(['error' => 'Already Booked By Another Person']);
        } else {
            // Payment
            $payment = new Payment;
            $payment->method_id = $request->method_id;
            $payment->status = 'Waiting Payment';
            $payment->promo_id = $request->promo_id;
            $payment->save();

            //Transaction 
            $transaction = new Transaction;
            $transaction->user_id = $request->user_id;
            $transaction->payment_id = Payment::get()->last()->payment_id;
            $transaction->state = 0;
            $transaction->slot = $request->slot;

            $pin = mt_rand(1000000, 9999999);
            $transaction->pin = str_shuffle($pin);
            $transaction->total_price = $request->total_price;
            $transaction->start_rent = $request->start_rent;
            $transaction->end_rent = $request->end_rent;
            $transaction->save();

            //Transaction Item
            $id = Transaction::get()->last();

            $unit_available = DB::select(DB::raw("SELECT u.unit_id,u.unit_code
        FROM unit u WHERE 
        NOT EXISTS (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
         t.transaction_id=ti.transaction_id AND
        (start_rent <= '" . $request->end_rent . "' and end_rent >= '" . $request->start_rent . "'))
        AND u.box_id=" . $request->box_id . ""));

            for ($x = 0; $x < $request->slot; $x++) {
                $transaction_item = new TransactionItem;
                $transaction_item->transaction_id = $id->transaction_id;
                $transaction_item->unit_id = $unit_available[0]->unit_id;
                $transaction_item->save();
                array_shift($unit_available);
            }

            $time_now = Carbon::now();
            $max_payment = $time_now->addDays(1);

            return response()->json(['success' => $max_payment]);
        }
    }

    public function detail($transaction_id)
    {
        $transaction = DB::table('transaction')
            ->join('transaction_item', 'transaction_item.transaction_id', '=', 'transaction.transaction_id')
            ->join('payment', 'payment.payment_id', '=', 'transaction.payment_id')
            ->join('unit', 'transaction_item.unit_id', '=', 'unit.unit_id')
            ->join('box', 'box.box_id', '=', 'unit.box_id')
            ->join('detail', 'box.detail_id', '=', 'detail.detail_id')
            ->join('promo', 'promo.promo_id', '=', 'payment.promo_id')
            ->join('storage', 'storage.storage_id', '=', 'box.storage_id')
            ->join('review', 'review.storage_id', '=', 'storage.storage_id')
            ->join('users', 'users.id', '=', 'transaction.user_id')
            ->join('method', 'method.method_id', '=', 'payment.method_id')
            ->where(['transaction.transaction_id' => $transaction_id])
            ->groupBy([
                'transaction.transaction_id',
                'transaction.total_price',
                'transaction.insurance',
                'transaction.pin',
                'transaction.start_rent',
                'transaction.end_rent',
                'storage.storage_id',
                'box.box_id',
                'users.name',
                'detail.type',
                'detail.size',
                'detail.high_size',
                'detail.wide_size',
                'detail.long_size',
                'box.price',
                'promo.code',
                'payment.status',
                'method.name',
                'method.account_number',
                'transaction.review_state',
                'transaction.slot'
            ])
            ->select(
                'transaction.transaction_id AS transaction_id',
                'transaction.total_price AS total_price',
                'transaction.insurance',
                'transaction.pin AS pin',
                'transaction.start_rent AS start_rent',
                'transaction.end_rent AS end_rent',
                'storage.storage_id AS storage_id',
                DB::raw("AVG(rate) AS rate"),
                'box.box_id AS box_id',
                'users.name AS owner',
                'detail.type AS type',
                'detail.size AS size',
                'detail.high_size AS high',
                'detail.wide_size AS wide',
                'detail.long_size AS long',
                'box.price AS box_price',
                'promo.code AS promo_code',
                'payment.status AS payment_status',
                'method.name AS method',
                'method.account_number AS account_number',
                'transaction.review_state AS review_state',
                'transaction.slot AS slot'
            )
            ->get();
        return response()->json(['success' => $transaction]);
    }
}
