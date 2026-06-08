<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Buka izin semua kolom
    protected $guarded = ['id'];

    // Relasi ke tabel Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Relasi ke tabel User (Admin/Kasir yang memproses)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
