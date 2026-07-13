<?php

namespace App\Http\Controllers;

use App\Models\VipBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Simple role check
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied. Executive clearance required.');
        }

        $bookings = VipBooking::with(['user', 'car'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function updateBooking(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied. Executive clearance required.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,rescheduled,rejected'],
            'preferred_datetime' => ['required', 'date'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $booking = VipBooking::findOrFail($id);

        $booking->update([
            'status' => $validated['status'],
            'preferred_datetime' => $validated['preferred_datetime'],
            'admin_notes' => $validated['admin_notes'] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Booking #' . substr($id, 0, 8) . ' has been updated successfully.');
    }
}
