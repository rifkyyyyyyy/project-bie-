<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class BookingController extends Controller
{
    public function calendar()
    {
        $rooms = Room::all();
        $bookings = Booking::all();

        return view('calendar', compact('rooms', 'bookings'));
    }
}
