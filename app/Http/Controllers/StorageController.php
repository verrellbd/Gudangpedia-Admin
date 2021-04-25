<?php

namespace App\Http\Controllers;

use App\Box;
use App\Detail;
use App\Exports\StorageExport;
use App\Storage;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class StorageController extends Controller
{
    //
    public function editstorage(Storage $storage)
    {
        return view('storage.edit.storage', ['storage' => $storage]);
    }

    public function updatestorage(Request $request, Storage $storage)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'address' => 'required',
            'end_contract' => 'required|after:start_contract',
            'image' => 'mimes:jpeg,png,jpg|max:2048',
            'image1' => 'mimes:jpeg,png,jpg|max:2048',
            'image2' => 'mimes:jpeg,png,jpg|max:2048',
            'image3' => 'mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $storage->name = $request->name;
        $storage->city = $request->city;
        $storage->address = $request->address;
        $storage->end_contract = date('Y-m-d H:i:s', strtotime($request->end_contract));
        $storage->cctv = $request->cctv;
        $storage->ac = $request->ac;
        $storage->fullday = $request->fullday;

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $path = public_path() . '/images/storage/';

                //code for remove old image
                if ($storage->image != ''  && $storage->image != null) {
                    $image_old = public_path() . '/' . $storage->image;
                    unlink($image_old);
                }

                //upload new image
                $image = $request->image;
                $imagename = $image->getClientOriginalName();
                $imagename = str_replace(' ', '_', $imagename);
                $image->move($path, $imagename);

                //for update in table
                $image_new = 'images/storage/' . $imagename;
                $storage->image = $image_new;
            }
        }

        if ($request->hasFile('image1')) {
            if ($request->file('image1')->isValid()) {
                $path = public_path() . '/images/storage/';

                //code for remove old image
                if ($storage->image1 != ''  && $storage->image1 != null) {
                    $image_old = public_path() . '/' . $storage->image1;
                    unlink($image_old);
                }

                //upload new image
                $image = $request->image1;
                $imagename = $image->getClientOriginalName();
                $imagename = str_replace(' ', '_', $imagename);
                $image->move($path, $imagename);

                //for update in table
                $image_new = 'images/storage/' . $imagename;
                $storage->image1 = $image_new;
            }
        }

        if ($request->hasFile('image2')) {
            if ($request->file('image2')->isValid()) {
                $path = public_path() . '/images/storage/';

                //code for remove old image
                if ($storage->image2 != ''  && $storage->image2 != null) {
                    $image_old = public_path() . '/' . $storage->image2;
                    unlink($image_old);
                }

                //upload new image
                $image = $request->image2;
                $imagename = $image->getClientOriginalName();
                $imagename = str_replace(' ', '_', $imagename);
                $image->move($path, $imagename);

                //for update in table
                $image_new = 'images/storage/' . $imagename;
                $storage->image1 = $image_new;
            }
        }

        if ($request->hasFile('image3')) {
            if ($request->file('image3')->isValid()) {

                $path = public_path() . '/images/storage/';

                //code for remove old image
                if ($storage->image3 != ''  && $storage->image3 != null) {
                    $image_old = public_path() . '/' . $storage->image3;
                    unlink($image_old);
                }

                //upload new image
                $image = $request->image3;
                $imagename = $image->getClientOriginalName();
                $imagename = str_replace(' ', '_', $imagename);
                $image->move($path, $imagename);

                //for update in table
                $image_new = 'images/storage/' . $imagename;
                $storage->image3 = $image_new;
            }
        }

        $storage->save();
        return redirect('/storages')->with(session()->flash('default', 'Success Update Storage'));
    }

    public function deletestorage(Storage $storage)
    {
        Unit::where('box_id', $storage->box->box_id)->delete();
        Box::where('storage_id', $storage->storage_id)->delete();
        if ($storage->image != NULL) {
            File::delete(public_path($storage->image));
        }
        if ($storage->image1 != NULL) {
            File::delete(public_path($storage->image1));
        }
        if ($storage->image2 != NULL) {
            File::delete(public_path($storage->image2));
        }
        if ($storage->image3 != NULL) {
            File::delete(public_path($storage->image3));
        }
        $storage->delete();
        return redirect('/storages')->with(session()->flash('default', 'Success Delete Storage'));
    }

    public function createstorage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'address' => 'required',
            'code' => 'required|size:6',
            'start_contract' => 'required|before:end_contract',
            'end_contract' => 'required|after:start_contract'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        //storage
        $storage = new Storage;
        $storage->user_id = $request->user_id;
        $storage->name = $request->name;
        $storage->description = $request->description;
        $storage->start_contract = date('Y-m-d H:i:s', strtotime($request->start_contract));
        $storage->end_contract = date('Y-m-d H:i:s', strtotime($request->end_contract));
        $storage->address = $request->address;
        $storage->city = $request->city;
        $storage->cctv = $request->cctv;
        $storage->ac = $request->ac;
        $storage->fullday = $request->fullday;

        //photo
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png,jpg|max:2048',
                ]);
                $extension = $request->image->extension();
                $request->image->storeAs('public/images/storage/', $validated['name'] . "_main" . "." . $extension);
                $url = "images/storage/" . $validated['name'] . "_main" . "." . $extension;
                $storage->image = $url;
                $file = $request->file('image');
                $file->move("images/storage/", $validated['name'] . "_main" . "." . $extension);
            }
        }

        if ($request->hasFile('image1')) {
            //  Let's do everything here
            if ($request->file('image1')->isValid()) {
                $validated = $request->validate([
                    'image1' => 'mimes:jpeg,png,jpg|max:2048',
                ]);
                $extension = $request->image1->extension();
                $request->image1->storeAs('public/images/storage/', $validated['name'] . "_1" . "." . $extension);
                $url = "images/storage/" . $validated['name'] . "_1" . "." . $extension;
                $storage->image1 = $url;
                $file = $request->file('image1');
                $file->move("images/storage/", $validated['name'] . "_1" . "." . $extension);
            }
        }

        if ($request->hasFile('image2')) {
            //  Let's do everything here
            if ($request->file('image2')->isValid()) {
                $validated = $request->validate([
                    'image2' => 'mimes:jpeg,png,jpg|max:2048',
                ]);
                $extension = $request->image2->extension();
                $request->image2->storeAs('public/images/storage/', $validated['name'] . "_2" . "." . $extension);
                $url = "images/storage/" . $validated['name'] . "_2" . "." . $extension;
                $storage->image2 = $url;
                $file = $request->file('image2');
                $file->move("images/storage/", $validated['name'] . "_2" . "." . $extension);
            }
        }

        if ($request->hasFile('image3')) {
            //  Let's do everything here
            if ($request->file('image3')->isValid()) {
                $validated = $request->validate([
                    'image3' => 'mimes:jpeg,png,jpg|max:2048',
                ]);
                $extension = $request->image3->extension();
                $request->image3->storeAs('public/images/storage/', $validated['name'] . "_3" . "." . $extension);
                $url = "images/storage/" . $validated['name'] . "_3" . "." . $extension;
                $storage->image3 = $url;
                $file = $request->file('image3');
                $file->move("images/storage/", $validated['name'] . "_3" . "." . $extension);
            }
        }

        // return $file;
        $storage->save();
        return redirect('/storages')->with(session()->flash('default', 'Success Create Storage'));
    }

    public function detail()
    {
        $details = Detail::all();
        return view('storage.detail', ['details' => $details]);
    }

    public function createdetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|min:2',
            'high_size' => 'required|numeric|min:1',
            'wide_size' => 'required|numeric|min:1',
            'long_size' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $detail = new Detail;
        $detail->type = $request->type;
        $detail->size = $request->high_size * $request->wide_size * $request->long_size;
        $detail->high_size = $request->high_size;
        $detail->wide_size = $request->wide_size;
        $detail->long_size = $request->long_size;
        $detail->save();

        return redirect('/detail')->with(session()->flash('default', 'Success Create Detail'));
    }

    public function deletedetail(Detail $detail)
    {
        Detail::where('detail_id', $detail->detail_id)->delete();
        $detail->delete();
        return redirect('/detail')->with(session()->flash('default', 'Success Delete Detail'));
    }

    public function editdetail(Detail $detail)
    {
        return view('storage.edit.detail', ['detail' => $detail]);
    }

    public function updatedetail(Request $request, Detail $detail)
    {
        $validator = Validator::make($request->all(), [
            'high_size' => 'required|numeric|min:1',
            'wide_size' => 'required|numeric|min:1',
            'long_size' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $detail->update($request->all());
        $detail->size = $request->high_size * $request->wide_size * $request->long_size;
        $detail->save();
        return redirect('/detail')->with(session()->flash('default', 'Success Update Detail'));
    }

    public function exportStorage()
    {
        return Excel::download(new StorageExport, 'storage.xlsx');
    }
}
