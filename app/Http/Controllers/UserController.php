<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('content.users.users', [
            'title' => 'Pengguna'
        ]);
    }

    public function getUsers()
    {
        $show = request('show');
        $search = request('search');
        if ($search) {
            $data = User::where('nama', 'like', '%' . $search . '%')->paginate($show);
        } else {
            $data = User::paginate($show);
        }
        return response()->json($data);
    }


    public function getUser()
    {
        $data = User::where('id', request('id'))->get();
        return response()->json($data);
    }


    public function postUser()
    {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('email')),
            'alamat' => request('alamat'),
            'level' => request('level')
        ]);
    }


    public function updateUser()
    {
        User::where('id', request('id'))->update([
            'name' => request('name'),
            'email' => request('email'),
            'alamat' => request('alamat'),
            'level' => request('level')
        ]);
    }


    public function deleteUser()
    {
        User::where('id', request('id'))->delete();
    }
}
