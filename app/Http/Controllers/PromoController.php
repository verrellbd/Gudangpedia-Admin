<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PromoController extends Controller
{
    //
    public function index()
    {
        $promos = Promo::all();
        return view('promo.index', ['promos' => $promos]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'discount' => 'required|numeric',
            'code' => 'required|size:6',
            'image' => 'required|mimes:jpeg,png|max:2048',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $promo = new Promo;
        $promo->name = $request->name;
        $promo->description = $request->description;
        $promo->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
        $promo->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
        $promo->discount = $request->discount;
        $promo->code = $request->code;

        // return $request;
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $imagename = $request->name . "." . $request->image->extension();
                $imagename = str_replace(' ', '_', $imagename);
                $request->image->storeAs('public/images/promo/', $imagename);
                $promo->image = "images/promo/" . $imagename;

                $file = $request->file('image');
                $file->move('images/promo', $imagename);
            }
        } else {
            $promo->image = NULL;
        }

        $promo->save();

        return redirect('/promo')->with(session()->flash('default', 'Success Create Promo'));
    }

    public function delete(Promo $promo)
    {
        try {
            File::delete(public_path($promo->image));
            $promo->delete();
            return redirect('/promo')->with(session()->flash('default', 'Success Delete Promo'));
        } catch (Throwable $e) {
            return redirect('/promo')->with(session()->flash('danger', 'Failed Delete Promo'));
        }
    }

    public function edit(Promo $promo)
    {
        return view('promo.edit', ['promo' => $promo]);
    }

    public function update(Request $request, Promo $promo)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'discount' => 'required|numeric',
            'code' => 'required|size:6',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $promo->name = $request->name;
        $promo->description = $request->description;
        $promo->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
        $promo->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
        $promo->discount = $request->discount;
        $promo->code = $request->code;

        if ($request->hasFile('image')) {
            $path = public_path() . '/images/promo/';

            //code for remove old image
            if ($promo->image != ''  && $promo->image != "NULL") {
                $image_old = public_path() . '/' . $promo->image;
                unlink($image_old);
            }

            //upload new image
            $image = $request->image;
            $imagename = $request->name . "." . $request->image->extension();
            $imagename = str_replace(' ', '_', $imagename);
            $image->move($path, $imagename);

            //for update in table
            $image_new = 'images/promo/' . $imagename;
            $promo->image = $image_new;
        }

        $promo->save();
        return redirect('/promo')->with(session()->flash('default', 'Success Update Promo'));
    }
}
