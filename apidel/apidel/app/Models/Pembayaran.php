<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = [
        'kaos_id',
        "jenis_pembayaran",
        "nominal",
    ];
    public function kaos()
    {
        return $this->belongsTo(Kaos::class);
    }
}
