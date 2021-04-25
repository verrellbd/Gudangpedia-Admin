<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if ($user->role == 'admin' || $user->role == 'owner' || $user->role == 'superadmin') {
                // return 'berhasil';
                return redirect('/home');
            } else {
                return view('auth.login');
            }
        } else {
            return view('auth.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotpassword(User $user)
    {
        return view('user.forgotpassword', ['user' => $user]);
    }

    public function postforgotpassword(Request $request, User $user)
    {
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/');
    }


    public function emailforgotpassword()
    {
        return view('user.email_forgotpassword');
    }

    public function postemailforgotpassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            Mail::send(new ForgotPassword($user->id, $user->name, $user->email));
            return view('user.email_forgotpassword')->with(session()->flash('default', 'Success Send Email to Reset Password'));
        } else {
            return view('user.email_forgotpassword')->with(session()->flash('danger', 'Error Send Email to Reset Password'));
        }
    }
}
