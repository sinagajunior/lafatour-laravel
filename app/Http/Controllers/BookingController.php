<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $packageId = $request->query('package');
        $package = $packageId ? Package::findOrFail($packageId) : null;

        $packages = Package::active()->get();

        return view('booking.create', compact('packages', 'package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:lafatour_packages,id',
            'customer_name' => 'required|string|min:2|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_whatsapp' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'id_card_number' => 'required|string|max:50',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'family_info' => 'nullable|array',
            'special_requests' => 'nullable|string',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        $booking = Booking::create([
            ...$validated,
            'total_amount' => $package->price,
            'booking_status' => 'pending',
            'payment_status' => 'pending',
            'down_payment' => $package->price * 0.3,
            'down_payment_amount' => $package->price * 0.3,
            'remaining_payment' => $package->price * 0.7,
        ]);

        return redirect()->route('booking.success', $booking)
            ->with('success', 'Booking submitted successfully! Please complete your payment.');
    }

    public function success(Booking $booking)
    {
        $booking->load('package');

        return view('booking.success', compact('booking'));
    }
}
