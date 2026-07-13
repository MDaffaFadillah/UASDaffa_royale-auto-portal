<?php

namespace App\Http\Controllers;

use App\Models\LuxuryCar;
use App\Models\VipBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($car_id)
    {
        $car = LuxuryCar::findOrFail($car_id);

        return view('booking.create', compact('car'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => ['required', 'exists:luxury_cars,id'],
            'booking_type' => ['required', 'in:bespoke_configuration,test_drive'],
            'preferred_datetime' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        VipBooking::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'booking_type' => $validated['booking_type'],
            'preferred_datetime' => $validated['preferred_datetime'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('profile')->with('success', 'Your bespoke experience has been booked successfully.');
    }

    public function profile()
    {
        $bookings = Auth::user()->bookings()->with('car')->orderBy('created_at', 'desc')->get();

        return view('profile', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = VipBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('car')
            ->firstOrFail();

        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = VipBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'preferred_datetime' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $booking->update([
            'preferred_datetime' => $validated['preferred_datetime'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'rescheduled',
        ]);

        return redirect()->route('profile')->with('success', 'Your booking schedule has been updated.');
    }

    public function destroy($id)
    {
        $booking = VipBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->delete();

        return redirect()->route('profile')->with('success', 'Your booking has been cancelled successfully.');
    }
}
