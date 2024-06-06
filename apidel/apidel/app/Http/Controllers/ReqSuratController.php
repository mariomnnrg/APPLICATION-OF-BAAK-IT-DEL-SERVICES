<?php

namespace App\Http\Controllers;

use App\Models\ReqSurat;
use Illuminate\Http\Request;
use App\Models\Surat;

class ReqSuratController extends Controller
{
    public function index()
    {
        $reqSurat = ReqSurat::all();
        return response()->json($reqSurat, 200);
    }
    public function store(Request $request)
    {
        $reqSurat = new ReqSurat;
        $reqSurat->user_id = $request->user_id;
        $reqSurat->keperluan = $request->keperluan;
        $reqSurat->waktu_mulai = $request->waktu_mulai;
        $reqSurat->waktu_selesai = $request->waktu_selesai;
        // add other fields if necessary
        $reqSurat->save();



        return response()->json($reqSurat, 201);
    }

    public function approve($id)
    {
        $reqSurat = ReqSurat::find($id);

        if ($reqSurat) {
            $reqSurat->status = 'approved';
            $reqSurat->save();

            return response()->json($reqSurat, 200);
        } else {
            return response()->json(['error' => 'ReqSurat not found'], 404);
        }
    }
    public function getUserHistory($user_id)
    {
        $userHistory = ReqSurat::where('user_id', $user_id)->get();
        return response()->json($userHistory, 200);
    }
    
    public function delete($id)
    {
        $reqSurat = ReqSurat::find($id);    
        if ($reqSurat) {
            $reqSurat->delete();
            return response()->json(['message' => 'ReqSurat deleted'], 200);
        } else {
            return response()->json(['error' => 'ReqSurat not found'], 404);
        }
    }
}