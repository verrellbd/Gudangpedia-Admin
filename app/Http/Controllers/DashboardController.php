<?php

namespace App\Http\Controllers;

use App\Storage;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function storage()
    {
        $storages = Storage::all();
        $users = User::where('role', 'owner')->get();
        return view('storage.index', ['storages' => $storages, 'users' => $users]);
    }

    public function user()
    {
        $users = User::where('role', 'owner')->orWhere('role', 'user')->get();
        return view('user.index', ['users' => $users]);
    }

    public function mystorage($user_id)
    {
        // return 'berhasil';
        $storages = Storage::where('user_id', $user_id)->get();
        return view('storage.index', ['storages' => $storages]);
    }
}
