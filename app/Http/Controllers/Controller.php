<?php

namespace App\Http\Controllers;

use App\Storage;
use App\Transaction;
use App\TransactionItem;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tes()
    {
        $transaction = Transaction::get()->last();
        $start_rent = '2021-03-07';
        $end_rent = '2021-03-13';
        $box_id = 3;
        $slot = 2;

        $unit_available = DB::select(DB::raw("SELECT u.unit_id,u.unit_code
        FROM unit u WHERE 
        NOT EXISTS (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
         t.transaction_id=ti.transaction_id AND
        (start_rent <= '" . $end_rent . "' and end_rent >= '" . $start_rent . "'))
        AND u.box_id=" . $box_id . ""));

        for ($x = 0; $x < $slot; $x++) {
            $transaction_item = new TransactionItem;
            $transaction_item->transaction_id = $transaction->transaction_id;
            $transaction_item->unit_id = $unit_available[0]->unit_id;
            $transaction_item->save();
            array_shift($unit_available);
        }

        return $unit_available;
    }

    public function sip()
    {
        // $tes = DB::select(DB::raw("SELECT s.storage_id,s.name,COUNT(*) as Availability FROM unit u JOIN box b JOIN storage s WHERE NOT EXISTS (SELECT * FROM transaction t WHERE u.unit_id=t.unit_id AND (start_rent <= '2021-03-13' and end_rent >= '2021-03-07')) AND b.box_id=u.box_id AND s.storage_id=b.storage_id AND city='Depok' GROUP BY u.box_id HAVING COUNT(*) > 0"));
        $times = [
            Carbon::parse('2021-03-07'),
            Carbon::parse('2021-03-13'),
        ];

        $storage = Unit::whereDoesntHave('transaction', function ($query) use ($times) {
            $query->where('start_rent', '<=', $times[1])
                ->where('end_rent', '>=', $times[0]);
        })->get();

        // $tes = DB::table('storage')
        //     ->join('box', 'box.storage_id', '=', 'storage.storage_id')
        //     ->join('unit', 'unit.box_id', '=', 'box.box_id')
        //     ->whereDoesntHave('transaction', function ($query) use ($times) {
        //         $query->where('start_rent', '<=', $times[1])
        //             ->where('end_rent', '>=', $times[0]);
        //     })
        //     ->where(['storage.city' => 'Depok'])
        //     ->groupBy(['unit.box_id', 'storage.storage_id', 'storage.name'])
        //     ->havingRaw('Count(*) > ?', [0])
        //     ->select(
        //         'storage.storage_id AS  storage_id',
        //         'storage.name AS storage_name',
        //         DB::raw('COUNT(*) as Availability')
        //     )->get();

        $tes = DB::select(DB::raw("SELECT s.storage_id,s.name,COUNT(u.box_id) as Availability
        FROM unit u JOIN box b JOIN storage s
        WHERE NOT EXISTS 
        (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
         t.transaction_id=ti.transaction_id AND
        (start_rent <= '2021-03-13' and end_rent >= '2021-03-07')) 
        AND b.box_id=u.box_id AND s.storage_id=b.storage_id AND city='Depok'
        GROUP BY  s.storage_id,s.name HAVING COUNT(*) >= 1"));

        return $tes;
    }
}
