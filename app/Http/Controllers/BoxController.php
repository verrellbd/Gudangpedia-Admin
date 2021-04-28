<?php

namespace App\Http\Controllers;

use App\Box;
use App\Detail;
use App\Storage;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PDO;

class BoxController extends Controller
{
    //
    public function index($id)
    {
        $boxs = Box::where('storage_id', $id)->where('state', '0')->get();
        $details = Detail::all();
        $storage = Storage::where('storage_id', $id)->first();
        return view('storage.box', ['boxs' => $boxs, 'details' => $details, 'storage' => $storage]);
    }

    public function create(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'detail_id' => 'required',
            'slot' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:5000',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $box = new Box;
        $box->storage_id = $id;
        $box->detail_id = $request->detail_id;
        $box->price = $request->price;
        $box->state = 0;
        $box->save();


        for ($x = 0; $x < $request->slot; $x++) {
            $unit = new Unit;
            $unit->box_id = $box->box_id;
            $unit->save();
            $unit->unit_code = strtoupper(substr($box->storage->name, 0, 3) . $unit->unit_id);
            $unit->save();
        }

        return redirect('/box/' . $id)->with(session()->flash('default', 'Success Create Box'));
    }

    public function delete(Box $box)
    {
        Unit::where('box_id', $box->box_id)->delete();
        $box->delete();
        return redirect('/box/' . $box->storage_id);
    }

    public function edit(Box $box)
    {
        $details = Detail::all();
        return view('storage.edit.box', ['box' => $box, 'details' => $details]);
    }

    public function update(Request $request, Box $box)
    {
        $validator = Validator::make($request->all(), [
            'detail_id' => 'required',
            'price' => 'required|numeric|min:5000',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $box->update($request->all());
        return redirect('/box/' . $box->storage->storage_id)->with(session()->flash('default', 'Success Update Box'));
    }
}
