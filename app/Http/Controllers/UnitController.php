<?php

namespace App\Http\Controllers;

use App\Box;
use App\Detail;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    //
    public function index($id)
    {
        $units = Unit::where('box_id', $id)->get();
        $details = Detail::all();
        $box = Box::where('box_id', $id)->first();
        return view('storage.unit', ['units' => $units, 'details' => $details, 'box' => $box]);
    }

    public function create(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'slot' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        for ($x = 0; $x < $request->slot; $x++) {
            $unit = new Unit;
            $unit->box_id = $id;
            $unit->unit_code = strtoupper(substr($unit->box->storage->name, 0, 3) . $unit->unit_id);
            $unit->save();
        }
        return redirect('/unit/' . $id);
    }

    public function delete(Unit $unit)
    {
        $box_id = $unit->box_id;
        $unit->delete();
        return redirect('/unit/' . $box_id)->with(session()->flash('default', 'Success Delete Promo'));
    }

    public function edit(Unit $unit)
    {
        $details = Detail::all();
        return view('storage.edit.unit', ['unit' => $unit, 'details' => $details]);
    }

    public function update(Request $request, Unit $unit)
    {
        $validator = Validator::make($request->all(), [
            'unit_code' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $unit->unit_code = $request->unit_code;
        $unit->save();
        return redirect('/unit/' . $unit->box->box_id)->with(session()->flash('default', 'Success Update Unit'));
    }
}
