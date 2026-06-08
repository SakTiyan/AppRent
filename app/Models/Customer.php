<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Mengizinkan semua kolom diisi kecuali ID

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
