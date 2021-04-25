<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\PaymentSuccess;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {
        try {
            $transaction = Transaction::where('transaction_id', $request->transaction_id)->first();
            $transaction->state = 1;
            $transaction->save();
            // SELECT t.total_price,d.size,d.type,s.name,s.address ,COUNT(u.unit_id) AS total_unit FROM transaction t JOIN transaction_item ti JOIN unit u JOIN box b JOIN detail d JOIN storage s ON ti.unit_id=u.unit_id and b.box_id=u.box_id AND d.detail_id=b.detail_id AND s.storage_id=b.storage_id AND ti.transaction_id=t.transaction_id WHERE ti.transaction_id=1 GROUP BY t.total_price

            $email_trans = DB::table('transaction')
                ->join('transaction_item', 'transaction.transaction_id', '=', 'transaction_item.transaction_id')
                ->join('unit', 'unit.unit_id', '=', 'transaction_item.unit_id')
                ->join('box', 'box.box_id', '=', 'unit.box_id')
                ->join('detail', 'detail.detail_id', '=', 'box.detail_id')
                ->join('storage', 'box.storage_id', '=', 'storage.storage_id')
                ->join('users', 'users.id', '=', 'transaction.user_id')
                ->where('transaction_item.transaction_id', $request->transaction_id)
                ->select(
                    DB::raw("COUNT(unit.unit_id) AS total_unit"),
                    'transaction.total_price AS total_price',
                    'detail.size AS size',
                    'detail.type AS type',
                    'storage.name AS storage_name',
                    'storage.address AS address',
                    'users.email AS email',
                    'users.name AS name'
                )
                ->groupBy(
                    'total_price',
                    'size',
                    'type',
                    'storage_name',
                    'address',
                    'email',
                    'name'
                )
                ->first();

            Mail::send(new PaymentSuccess($email_trans->total_price, $email_trans->size, $email_trans->type, $email_trans->storage_name, $email_trans->address, $email_trans->total_unit, $email_trans->email, $email_trans->name));
            return response()->json(['success' => 'Payment success']);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Payment not success']);
        }
    }
}
