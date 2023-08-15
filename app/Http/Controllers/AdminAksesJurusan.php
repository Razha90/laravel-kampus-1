<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class AdminAksesJurusan extends Controller
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
                'kode' => 'required|min:4|numeric'
            ]);
    
            // Simpan data ke dalam database
            $user = new Jurusan;
            $user->nama_jurusan = $request->nama;
            $user->id = $request->kode;
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
            $dt = Jurusan::find($id);
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
        if (auth()->user()->role == 'Admin') {
            $id_edit = request('kode');
            $data = Jurusan::find($id_edit);
            if ($data) {
                $data->nama_jurusan = request("jurusan");
                $data->id = $id_edit;
                $data->updated_at = now();
                $data->save();
            $request->session()->flash('Message', 'Data berhasil diupdate.');
            } else {
            $request->session()->flash('Message', 'Data Gagal Di Ubah Periksa Pengaturan Database.');
            }
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
            Jurusan::where('id', $id)->delete();
            $request->session()->flash('Message', 'Data berhasil Dihapus');
    
            return redirect()->back();
        }else {
            abort(403, 'Akses ditolak.');
        }
    }
}
