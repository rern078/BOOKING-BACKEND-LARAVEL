<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::query()
            ->with(['property', 'booking', 'customer'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $properties = Property::query()->orderBy('name')->get();
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        $customers = Customer::query()->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.reviews.create', compact('properties', 'bookings', 'customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'booking_id' => ['nullable', 'exists:bookings,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'comment' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        Review::create($data);

        return redirect()->route('admin.reviews.index')->with('status', 'Review created.');
    }

    public function edit(Review $review)
    {
        $properties = Property::query()->orderBy('name')->get();
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        $customers = Customer::query()->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.reviews.edit', compact('review', 'properties', 'bookings', 'customers'));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'booking_id' => ['nullable', 'exists:bookings,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'comment' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        $review->update($data);

        return back()->with('status', 'Review updated.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('status', 'Review deleted.');
    }
}
