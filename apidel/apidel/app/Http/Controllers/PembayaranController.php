<?php

namespace App\Http\Controllers;

use App\Models\Kaos;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function store(Request $request, Kaos $kaos)
    {
        if ((int) $request->nominal != $kaos->harga) {
            return response()->json(['message' => 'Pembayaran tidak berhasil.'], 400);
        }

        $pembayaran = new Pembayaran($request->all());
        $kaos->pembayaran()->save($pembayaran);

        return response()->json(['message' => 'Pembayaran berhasil.'], 200);
    }

}
