<?php
// RoomRequestController.php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomRequestController extends Controller
{
    public function index()
    {
        $roomRequests = RoomRequest::with('aksesroom')->get();
        return response()->json($roomRequests, 200);
    }
    // Method for students to book a room
    public function bookRoom(Request $request)
    {


        $room = Room::find($request->room_id);

        // Check if the room is available
        if ($room->status == false) {
            return response()->json(['message' => 'Room is already booked.'], 400); // HTTP status code 400 for Bad Request
        }

        // Create a new room request
        $roomRequest = new RoomRequest;
        $roomRequest->user_id = $request->user_id;
        $roomRequest->room_id = $request->room_id;
        $roomRequest->status = 'pending';
        $roomRequest->start_time = $request->start_time;
        $roomRequest->end_time = $request->end_time;
        $roomRequest->save();

        // Update the room status to unavailable
        $room->status = false;
        $room->save();

        return response()->json(['message' => 'Room booked successfully. Waiting for approval.'], 201); // HTTP status code 201 for Created
    }

    // Method for baak to approve a room request
    public function approveRoomRequest($id)
    {
        $roomRequest = RoomRequest::find($id);

        // Check if the room request exists
        if (!$roomRequest) {
            return response()->json(['message' => 'Room request not found.'], 404); // HTTP status code 404 for Not Found
        }

        // Approve the room request
        $roomRequest->status = 'approved';
        $roomRequest->save();

        return response()->json(['message' => 'Room request approved successfully.'], 200); // HTTP status code 200 for OK
    }
    public function rejectRoomRequest($id)
    {
        $roomRequest = RoomRequest::find($id);
    
        // Check if the room request exists
        if (!$roomRequest) {
            return response()->json(['message' => 'Room request not found.'], 404); // HTTP status code 404 for Not Found
        }
    
        // Update the room status
        $room = $roomRequest->aksesroom; // Use the aksesroom relation to get the associated room
        $room->status = 1;
        $room->save();
    
        // Delete the room request
        $roomRequest->delete();
    
        return response()->json(['message' => 'Room request rejected, room status updated, and room request deleted successfully.'], 200); // HTTP status code 200 for OK
    }
    public function getUserHistory($user_id)
    {

        $userHistory = RoomRequest::where('user_id', $user_id)->with('aksesroom')->get();


        return response()->json($userHistory, 200);
    }

    public function delete($id)
    {
        $roomRequest = RoomRequest::find($id);
        if ($roomRequest) {
            $roomRequest->delete();
            return response()->json(['message' => 'RoomRequest deleted'], 200);
        } else {
            return response()->json(['error' => 'RoomRequest not found'], 404);
        }
    }
}
