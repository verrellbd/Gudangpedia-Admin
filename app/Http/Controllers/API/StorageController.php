<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    public function search(Request $request)
    {
        $list = DB::select(DB::raw("SELECT us.name as Owner,s.storage_id,s.name,s.address,s.city,s.description,s.image,AVG(rate) as rate,COUNT(u.box_id) as Availability
        FROM unit u JOIN box b JOIN storage s JOIN users us JOIN review r
        WHERE NOT EXISTS 
        (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
         t.transaction_id=ti.transaction_id AND
        (start_rent <= '" . $request->end_date . "' and end_rent >= '" . $request->start_date . "')) 
        AND b.box_id=u.box_id AND s.storage_id=b.storage_id AND us.id=s.user_id AND city='" . $request->city . "'
        AND r.storage_id=s.storage_id
        GROUP BY us.name,s.storage_id,s.name,s.address,s.city,s.description,s.image HAVING COUNT(*) >=1"));

        return response()->json(['success' => $list]);
    }

    public function detail(Storage $storage)
    {
        $list = DB::table('storage')
            ->join('users', 'users.id', '=', 'storage.user_id')
            ->join('review', 'review.storage_id', '=', 'storage.storage_id')
            ->where(['storage.storage_id' => $storage->storage_id])
            ->select(
                'storage.storage_id AS  storage_id',
                'storage.name AS storage_name',
                'storage.address AS storage_address',
                'storage.city AS storage_city',
                'storage.description AS storage_description',
                DB::raw("AVG(rate) AS rate"),
                'storage.image AS storage_image',
                'storage.image1 AS storage_image1',
                'storage.image2 AS storage_image2',
                'storage.image3 AS storage_image3',
                'users.name AS owner_name'
            )
            ->groupBy(
                'storage_id',
                'storage_name',
                'storage_address',
                'storage_city',
                'storage_description',
                'storage_image',
                'storage_image1',
                'storage_image2',
                'storage_image3',
                'owner_name'
            )
            ->first();
        return response()->json(['success' => $list]);
    }

    public function box(Request $request)
    {
        // SELECT b.box_id,d.type,d.size,d.high_size,d.long_size,d.wide_size,COUNT(u.box_id) AS Availability
        // FROM unit u JOIN box b JOIN detail d WHERE 
        // NOT EXISTS (SELECT * FROM transaction t WHERE u.unit_id=t.unit_id AND (start_rent <= '2021-03-13' and end_rent >= '2021-03-07'))
        // AND b.box_id=u.box_id AND b.detail_id=d.detail_id AND b.storage_id=2 GROUP BY b.box_id

        $list = DB::select(DB::raw("SELECT b.price,b.box_id,d.type,d.size,d.high_size,d.long_size,d.wide_size,COUNT(u.box_id) AS Availability
        FROM unit u JOIN box b JOIN detail d WHERE 
        NOT EXISTS (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
         t.transaction_id=ti.transaction_id AND
        (start_rent <= '" . $request->end_date . "' and end_rent >= '" . $request->start_date . "'))
        AND b.box_id=u.box_id AND b.detail_id=d.detail_id AND b.storage_id=" . $request->storage_id . " 
        GROUP BY b.price,b.box_id,d.type,d.size,d.high_size,d.long_size,d.wide_size"));

        return response()->json(['success' => $list]);
    }

    public function unit(Request $request)
    {
        $list = DB::select(DB::raw("SELECT u.unit_id,u.unit_code
        FROM unit u WHERE 
        NOT EXISTS (SELECT * FROM transaction t JOIN transaction_item ti WHERE u.unit_id=ti.unit_id AND 
        (start_rent <= '" . $request->end_date . "' and end_rent >= '" . $request->start_date . "'))
        AND u.box_id=" . $request->box_id . ""));

        return response()->json(['success' => $list]);
    }

    public function recommendation()
    {
        $recommendation = DB::table('storage')
            ->join('review', 'review.storage_id', '=', 'storage.storage_id')
            ->join('users', 'users.id', '=', 'storage.user_id')
            ->select(
                'users.name as Owner',
                'storage.storage_id as storage_id',
                'storage.name AS name',
                'storage.address AS address',
                'storage.city AS city',
                'storage.description AS description',
                'storage.image AS image',
                DB::raw("AVG(rate) AS rate")
            )
            ->groupBy(
                'owner',
                'name',
                'address',
                'city',
                'description',
                'image',
                'storage_id'

            )
            ->orderBy('rate', 'desc')
            ->limit(5)
            ->get();

        return response()->json(['success' => $recommendation]);
    }

    public function edit(Request $request)
    {
        $storage = Storage::where('storage_id', $request->storage_id)->first();
        if ($storage->user_id == $request->user_id) {
            $storage->name = $request->name;
            $storage->description = $request->description;
            $storage->save();
            return response()->json(['success' => 'Update Storage Success']);
        } else {
            return response()->json(['error' => 'Update Storage Error']);
        }
    }
}
