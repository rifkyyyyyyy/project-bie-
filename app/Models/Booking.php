<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id', 'guest_name', 'start_date', 'end_date', 'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
