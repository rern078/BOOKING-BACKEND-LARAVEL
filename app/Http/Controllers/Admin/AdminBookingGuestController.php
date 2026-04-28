<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingGuest;
use Illuminate\Http\Request;

class AdminBookingGuestController extends Controller
{
    public function index()
    {
        $guests = BookingGuest::query()
            ->with('booking.property')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.booking-guests.index', compact('guests'));
    }

    public function create()
    {
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        return view('admin.booking-guests.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $data['is_primary'] = (bool) ($data['is_primary'] ?? false);

        if ($data['is_primary']) {
            BookingGuest::query()->where('booking_id', $data['booking_id'])->update(['is_primary' => false]);
        }

        BookingGuest::create($data);

        return redirect()->route('admin.booking-guests.index')->with('status', 'Guest created.');
    }

    public function edit(BookingGuest $booking_guest)
    {
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        return view('admin.booking-guests.edit', ['guest' => $booking_guest, 'bookings' => $bookings]);
    }

    public function update(Request $request, BookingGuest $booking_guest)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $data['is_primary'] = (bool) ($data['is_primary'] ?? false);

        if ($data['is_primary']) {
            BookingGuest::query()->where('booking_id', $data['booking_id'])->where('id', '!=', $booking_guest->id)->update(['is_primary' => false]);
        }

        $booking_guest->update($data);

        return back()->with('status', 'Guest updated.');
    }

    public function destroy(BookingGuest $booking_guest)
    {
        $booking_guest->delete();

        return redirect()->route('admin.booking-guests.index')->with('status', 'Guest deleted.');
    }
}

