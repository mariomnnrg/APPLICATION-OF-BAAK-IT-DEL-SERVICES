<?php
// ReqIbController.php
namespace App\Http\Controllers;

use App\Models\ReqIb;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReqIbController extends Controller
{
    public function index()
    {
        $reqIbs = ReqIb::all();

        return response()->json($reqIbs, 200); // 200 OK
    }
    public function store(Request $request)
    {
        $requestedStartTime = Carbon::parse($request->waktu_mulai);
        $requestedDay = $requestedStartTime->dayOfWeek;
        $requestedTime = $requestedStartTime->format('H:i');

        // Check if the request is made on Friday after 17:00 or on Saturday between 08:00 and 17:00
        if (
            ($requestedDay == Carbon::FRIDAY && $requestedTime >= '17:00') ||
            ($requestedDay == Carbon::SATURDAY && $requestedTime >= '08:00' && $requestedTime <= '17:00')
        ) {

            $reqIb = new ReqIb;
            $reqIb->user_id = $request->user_id;
            $reqIb->keperluan = $request->keperluan;
            $reqIb->waktu_mulai = $request->waktu_mulai;
            $reqIb->waktu_selesai = $request->waktu_selesai;
            // add other fields if necessary
            $reqIb->status = 'pending'; // set status to pending
            $reqIb->save();

            return response()->json($reqIb, 201); // 201 Created
        } else {
            return response()->json(['message' => 'Request IB Gak bisa dilakukan pada waktu ini '], 400); // 400 Bad Request
        }
    }
    public function approve($id)
    {
        $reqIb = ReqIb::find($id);

        if ($reqIb) {
            $reqIb->status = 'approved';
            $reqIb->save();

            return response()->json($reqIb, 200); // 200 OK
        } else {
            return response()->json(['message' => 'Request not found'], 404); // 404 Not Found
        }
    }

    public function getUserHistory($user_id)
    {
        $userHistory = ReqIb::where('user_id', $user_id)->get();
        return response()->json($userHistory, 200);
    }
    
    public function delete($id)
    {
        $reqIb = ReqIb::find($id);    
        if ($reqIb) {
            $reqIb->delete();
            return response()->json(['message' => 'ReqIb deleted'], 200);
        } else {
            return response()->json(['error' => 'ReqIb not found'], 404);
        }
    }
}