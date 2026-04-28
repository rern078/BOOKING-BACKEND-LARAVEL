<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::query()
            ->with('property')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        $properties = Property::query()->orderBy('name')->get();
        return view('admin.room-types.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:100'],
            'max_adults' => ['required', 'integer', 'min:0', 'max:20'],
            'max_children' => ['required', 'integer', 'min:0', 'max:20'],
            'max_occupancy' => ['required', 'integer', 'min:1', 'max:20'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        RoomType::create($data);

        return redirect()->route('admin.room-types.index')->with('status', 'Room type created.');
    }

    public function edit(RoomType $room_type)
    {
        $properties = Property::query()->orderBy('name')->get();
        return view('admin.room-types.edit', ['roomType' => $room_type, 'properties' => $properties]);
    }

    public function update(Request $request, RoomType $room_type)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:100'],
            'max_adults' => ['required', 'integer', 'min:0', 'max:20'],
            'max_children' => ['required', 'integer', 'min:0', 'max:20'],
            'max_occupancy' => ['required', 'integer', 'min:1', 'max:20'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $room_type->update($data);

        return back()->with('status', 'Room type updated.');
    }

    public function destroy(RoomType $room_type)
    {
        $room_type->delete();

        return redirect()->route('admin.room-types.index')->with('status', 'Room type deleted.');
    }
}

