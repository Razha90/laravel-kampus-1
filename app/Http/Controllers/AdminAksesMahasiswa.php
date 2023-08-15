<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminAksesMahasiswa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(403);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'Admin') {
            $request->validate([
                'nama' => 'required|min:7|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email',
                'nim' => 'required|min:4|numeric',
            ]);
    
            // Simpan data ke dalam database
            $user = new Mahasiswa;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->id = $request->nim;
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();
            $request->session()->flash('success', 'Data Berhasil Disimpan Dalam Database');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Data Gagal Disimpan Dalam Database');
            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->role == 'Admin') {
            $dt = Mahasiswa::find($id);
            return response()->json($dt, 200);
        } else {
            return response()->json([
                'message' => 'Hanya Admin yang bisa melakukan update data'
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id_edit = request('nim');
        if (auth()->user()->role == 'Admin') {
            $data = Mahasiswa::find($id_edit);
            $data->nama = request('nama');
            $data->email = request('email');
            $data->updated_at = now();
            $data->id = $id_edit;
            $data->save();
            $request->session()->flash('Message', 'Data berhasil diupdate.');

            return redirect()->back();
        } else {
            abort(403, 'Akses ditolak.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (auth()->user()->role == 'Admin') {
            Mahasiswa::where('id', $id)->delete();
            $request->session()->flash('Message', 'Data berhasil Dihapus');
    
            return redirect()->back();
        }else {
            abort(403, 'Akses ditolak.');
        }

    }
}
