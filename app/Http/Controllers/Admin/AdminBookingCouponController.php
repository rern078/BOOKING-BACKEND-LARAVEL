<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminBookingCouponController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
            ->with(['property', 'customer', 'coupons'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.booking-coupons.index', compact('bookings'));
    }

    public function edit(Booking $booking)
    {
        $booking->load(['property', 'customer', 'coupons']);
        $coupons = Coupon::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->get();

        return view('admin.booking-coupons.edit', compact('booking', 'coupons'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'coupon_ids' => ['array'],
            'coupon_ids.*' => ['integer', 'exists:coupons,id'],
        ]);

        $booking->coupons()->sync($data['coupon_ids'] ?? []);

        return back()->with('status', 'Booking coupons updated.');
    }
}

