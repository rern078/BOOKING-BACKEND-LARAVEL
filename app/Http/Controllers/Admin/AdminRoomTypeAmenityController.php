<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomTypeAmenityController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::query()
            ->with(['property', 'amenities'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.room-type-amenities.index', compact('roomTypes'));
    }

    public function edit(RoomType $room_type)
    {
        $room_type->load(['property', 'amenities']);
        $amenities = Amenity::query()->orderBy('name')->get();

        return view('admin.room-type-amenities.edit', [
            'roomType' => $room_type,
            'amenities' => $amenities,
        ]);
    }

    public function update(Request $request, RoomType $room_type)
    {
        $data = $request->validate([
            'amenity_ids' => ['array'],
            'amenity_ids.*' => ['integer', 'exists:amenities,id'],
        ]);

        $ids = $data['amenity_ids'] ?? [];
        $room_type->amenities()->sync($ids);

        return back()->with('status', 'Amenities updated.');
    }
}

