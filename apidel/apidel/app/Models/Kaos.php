<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaos extends Model
{
    protected $fillable = ['ukuran', 'harga'];

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}