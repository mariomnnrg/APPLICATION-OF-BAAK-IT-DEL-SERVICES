<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaos;
use Illuminate\Support\Facades\DB;

class KaosController extends Controller
{
    public function index()
    {
        $kaos = Kaos::all(); // Mengambil semua data kaos
        $ukuran = $kaos->pluck('ukuran');
        return response()->json($ukuran);
    }
    public function index2()
    {
        $kaos = Kaos::all(); // Mengambil semua data kaos
        $ukuran = $kaos->pluck('ukuran');
        $harga = $kaos->pluck('harga');
        return response()->json(['ukuran' => $ukuran, 'harga' => $harga]);
    }

    public function store(Request $request)
    {
        $kaos = Kaos::create($request->all());
        return response()->json($kaos, 201);
    }
}