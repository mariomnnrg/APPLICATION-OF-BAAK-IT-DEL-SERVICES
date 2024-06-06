<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReqIk extends Model
{

    protected $table = 'req_ik';
    protected $fillable = ['user_id', 'status', 'keperluan', 'waktu_mulai', 'waktu_selesai'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}