<?php

namespace App\Http\Controllers;

use App\Mail\NewOwner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function createowner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'dob' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = date('Y-m-d H:i:s', strtotime($request->dob));
        $user->address = $request->address;

        $password = Str::random(10);
        $user->password = bcrypt($password);
        $user->role = 'owner';
        $user->save();
        Mail::send(new NewOwner($user->id, $user->name, $user->email, $password));
        return redirect('/user')->with(session()->flash('default', 'Success Create Owner'));
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->dob = date('Y-m-d H:i:s', strtotime($request->dob));
        $user->address = $request->address;
        $user->save();

        return redirect('/user')->with(session()->flash('default', 'Success Update User'));
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('/user')->with(session()->flash('default', 'Success Delete User'));
    }

    public function admin()
    {
        $user = User::where('role', 'admin')->get();
        return view('user.admin', ['users' => $user]);
    }

    public function profile(User $user)
    {
        return view('user.profile', ['user' => $user]);
    }

    public function editprofile(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect('/profile/' . $user->id)->with(session()->flash('default', 'Success Edit Profile'));
    }
}
