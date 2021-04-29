<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 'user';
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if ($logout) {
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = Auth::user();

        // $input = $request->all();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->save();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function mailforgotpassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        Mail::send(new ForgotPassword($user->id, $user->name, $user->email));
        return response()->json(['success' => 'Check Your Email'], $this->successStatus);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
