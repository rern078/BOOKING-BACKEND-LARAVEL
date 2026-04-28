<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::query()
            ->with(['property', 'roomType'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $properties = Property::query()->orderBy('name')->get();
        $roomTypes = RoomType::query()->with('property')->orderBy('name')->get();

        return view('admin.rooms.create', compact('properties', 'roomTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'room_number' => ['nullable', 'string', 'max:50'],
            'floor' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('status', 'Room created.');
    }

    public function edit(Room $room)
    {
        $properties = Property::query()->orderBy('name')->get();
        $roomTypes = RoomType::query()->with('property')->orderBy('name')->get();

        return view('admin.rooms.edit', compact('room', 'properties', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'room_number' => ['nullable', 'string', 'max:50'],
            'floor' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $room->update($data);

        return back()->with('status', 'Room updated.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('status', 'Room deleted.');
    }
}

