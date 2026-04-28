<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
            ->with(['property', 'customer'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $properties = Property::query()->orderBy('name')->get();
        $customers = Customer::query()->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.bookings.create', compact('properties', 'customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'status' => ['required', 'string', 'max:50'],
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'adults' => ['required', 'integer', 'min:1', 'max:20'],
            'children' => ['required', 'integer', 'min:0', 'max:20'],
            'rooms_count' => ['required', 'integer', 'min:1', 'max:20'],
            'currency' => ['required', 'string', 'size:3'],
            'total' => ['required', 'numeric', 'min:0'],
            'source' => ['nullable', 'string', 'max:50'],
            'special_requests' => ['nullable', 'string'],
            'internal_notes' => ['nullable', 'string'],
        ]);

        $data['created_by_user_id'] = $request->user()->id;
        $data['reference'] = 'BK-'.strtoupper(Str::random(8));
        $data['subtotal'] = $data['total'];
        $data['discount_total'] = 0;
        $data['tax_total'] = 0;

        Booking::create($data);

        return redirect()->route('admin.bookings.index')->with('status', 'Booking created.');
    }

    public function edit(Booking $booking)
    {
        $properties = Property::query()->orderBy('name')->get();
        $customers = Customer::query()->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.bookings.edit', compact('booking', 'properties', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'status' => ['required', 'string', 'max:50'],
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'adults' => ['required', 'integer', 'min:1', 'max:20'],
            'children' => ['required', 'integer', 'min:0', 'max:20'],
            'rooms_count' => ['required', 'integer', 'min:1', 'max:20'],
            'currency' => ['required', 'string', 'size:3'],
            'total' => ['required', 'numeric', 'min:0'],
            'source' => ['nullable', 'string', 'max:50'],
            'special_requests' => ['nullable', 'string'],
            'internal_notes' => ['nullable', 'string'],
        ]);

        $data['subtotal'] = $data['total'];

        $booking->update($data);

        return back()->with('status', 'Booking updated.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('status', 'Booking deleted.');
    }
}

