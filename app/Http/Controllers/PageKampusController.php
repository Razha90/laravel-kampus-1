<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PageKampusController extends Controller
{
    public function pageMahasiswa() {
        return view('pages.mahasiswaPage');
    }

    public function data_mahasiswa(Request $request)
    {
        $data = Mahasiswa::orderBy('id', 'desc')->paginate(15);

        $pagination = [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    
        $response = [
            'data' => $data->items(),
            'pagination' => $pagination,
        ];
    
        return response()->json($response);
    }

    public function pageDosen() {
        return view('pages.dosenPage');
    }

    public function data_dosen(Request $request)
    {
        $data = Dosen::orderBy('id', 'desc')->paginate(15);

        $pagination = [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    
        $response = [
            'data' => $data->items(),
            'pagination' => $pagination,
        ];
    
        return response()->json($response);
    }

    public function pageJurusan() {
        return view('pages.jurusanPage');
    }

    public function data_jurusan(Request $request)
    {
        $data = Jurusan::orderBy('id', 'desc')->paginate(15);

        $pagination = [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    
        $response = [
            'data' => $data->items(),
            'pagination' => $pagination,
        ];
    
        return response()->json($response);
    }

}
