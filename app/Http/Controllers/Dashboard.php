<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function home() {
        return view('Admin.home');
    }

    public function createMahasiswa() {
        return view('Admin.createMahasiswa');
    }

    public function createDosen() {
        return view('Admin.createDosen');
    }

    
    public function createJurusan() {
        return view('Admin.createJurusan');
    }
}
