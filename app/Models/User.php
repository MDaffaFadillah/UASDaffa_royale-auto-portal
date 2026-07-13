<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasUuids; // Wajib ditambahkan agar Laravel meng-generate UUID otomatis

    protected $fillable = ['full_name', 'email', 'password', 'phone_number', 'role'];
    protected $hidden = ['password', 'remember_token'];
    
    // Relasi One-to-Many ke VIP Bookings
    public function bookings()
    {
        return $this->hasMany(VipBooking::class);
    }
}
