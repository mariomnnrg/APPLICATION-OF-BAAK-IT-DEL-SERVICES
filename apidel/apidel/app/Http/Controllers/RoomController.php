<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    // Method to get all rooms
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms, 200);
    }
    // Method to create a new room
    public function create(Request $request)
    {
        $room = new Room;
        $room->name = $request->name;
        $room->status = true; // set room as available
        $room->save();

        return response()->json(['message' => 'Room created successfully.']);
    }


    // Method to delete a room
    public function delete($id)
    {
        $room = Room::find($id);

        // Check if the room exists
        if (!$room) {
            return response()->json(['message' => 'Room not found.']);
        }

        $room->delete();

        return response()->json(['message' => 'Room deleted successfully.']);
    }
}