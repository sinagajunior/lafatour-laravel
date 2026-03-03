<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'booking_number' => 'required|string',
            'customer_email' => 'required|email',
        ]);

        $booking = Booking::where('booking_number', $validated['booking_number'])
            ->where('customer_email', $validated['customer_email'])
            ->with('package')
            ->first();

        if (!$booking) {
            return redirect()->back()
                ->with('error', 'Booking not found. Please check your booking number and email.');
        }

        return view('tracking.result', ['booking' => $booking, 'page_title' => 'Status Pemesanan']);
    }
}
