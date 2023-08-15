<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('content.users.users', [
            'title' => 'Pengguna'
        ]);
    }

    public function profile()
    {
        return view('content.users.profile', [
            'title' => 'Profile'
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
        if (request('password')) {
            $newPassword = bcrypt(request('newPassword'));            
            $credentials = request()->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                User::where('id', request('id'))->update([
                    'password' => $newPassword
                ]);
                return response()->json(['success' => true]);
            }else{
                return response()->json(['success' => false]);
            }
            
        }else{
            User::where('id', request('id'))->update([
                'name' => request('name'),
                'email' => request('email'),
                'alamat' => request('alamat'),
                'level' => request('level')
            ]);
        }
    }


    public function deleteUser()
    {
        User::where('id', request('id'))->delete();
    }
}
