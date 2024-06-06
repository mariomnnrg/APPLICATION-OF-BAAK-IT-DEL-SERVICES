<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'status', 'start_time', 'end_time'];

    public function aksesroom()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}