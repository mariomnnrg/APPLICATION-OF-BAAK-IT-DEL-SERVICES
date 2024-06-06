<?php

namespace App\Http\Controllers;

use App\Models\ReqIk;
use Illuminate\Http\Request;
use App\Models\Ik;

class ReqIkController extends Controller
{
    public function index()
    {
        $reqIk = ReqIk::all();
        return response()->json($reqIk, 200);
    }
    public function store(Request $request)
    {
        $reqIk = new ReqIk;
        $reqIk->user_id = $request->user_id;
        $reqIk->keperluan = $request->keperluan;
        $reqIk->waktu_mulai = $request->waktu_mulai;
        $reqIk->waktu_selesai = $request->waktu_selesai;
        // add other fields if necessary
        $reqIk->save();



        return response()->json($reqIk, 201);
    }

    public function approve($id)
    {
        $reqIk = ReqIk::find($id);

        if ($reqIk) {
            $reqIk->status = 'approved';
            $reqIk->save();

            return response()->json($reqIk, 200);
        } else {
            return response()->json(['error' => 'ReqIk not found'], 404);
        }
    }
    public function getUserHistory($user_id)
    {
        $userHistory = ReqIk::where('user_id', $user_id)->get();
        return response()->json($userHistory, 200);
    }
    //delete
    public function delete($id)
    {
        $reqIk = ReqIk::find($id);
        if ($reqIk) {
            $reqIk->delete();
            return response()->json(['message' => 'ReqIk deleted'], 200);
        } else {
            return response()->json(['error' => 'ReqIk not found'], 404);
        }
    }
}