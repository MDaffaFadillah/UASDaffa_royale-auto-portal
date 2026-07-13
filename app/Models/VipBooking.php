<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VipBooking extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id', 'car_id', 'booking_type', 'preferred_datetime', 
        'status', 'notes', 'admin_notes'
    ];

    protected function casts(): array
    {
        return [
            'preferred_datetime' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(LuxuryCar::class);
    }
}