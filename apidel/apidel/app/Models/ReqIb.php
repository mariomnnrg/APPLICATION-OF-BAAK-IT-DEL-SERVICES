<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ReqIb extends Model
{
    protected $table = 'req_ib';
    protected $fillable = ['user_id', 'status', 'keperluan', 'waktu_mulai', 'waktu_selesai'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function aksesuser()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
