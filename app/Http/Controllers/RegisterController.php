<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index() {
        return view('Auth.register');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'username' => 'required|min:3|max:20|unique:users',
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        $validated['role'] = 'Guest';
        User::create($validated);
        $request->session()->flash('success','Pendaftaran Telah Berhasil Silakan Login!');
        $email = $request->input('email');
        $password = $request->input('password');

        return Redirect::to('/login')->withInput([
            'email' => $email,
            'password' => $password,
        ]);
    }
}
