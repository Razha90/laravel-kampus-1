<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class AdminAksesDosen extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                'phone' => 'required|min:9|regex:/^08\d{7,}$/'
            ]);
    
            // Simpan data ke dalam database
            $user = new Dosen;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->id = $request->nim;
            $user->phone = $request->phone;
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
            $dt = Dosen::find($id);
            return response()->json($dt, 200);
        } else {
            return response()->json([
                'message' => 'Hanya Admin yang bisa melakukan update data'
            ], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id_edit = request('id');
        if (auth()->user()->role == 'Admin') {
            $data = Dosen::find($id_edit);
            $data->nama = request('nama');
            $data->email = request('email');
            $data->phone = request('phone');
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
    public function destroy(Request $request ,string $id)
    {
        if (auth()->user()->role == 'Admin') {
            Dosen::where('id', $id)->delete();
            $request->session()->flash('Message', 'Data berhasil Dihapus');
    
            return redirect()->back();
        }else {
            abort(403, 'Akses ditolak.');
        }
    }
}
