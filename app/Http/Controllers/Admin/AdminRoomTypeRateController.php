<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatePlan;
use App\Models\RoomType;
use App\Models\RoomTypeRate;
use Illuminate\Http\Request;

class AdminRoomTypeRateController extends Controller
{
    public function index()
    {
        $rates = RoomTypeRate::query()
            ->with(['roomType.property', 'ratePlan'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.room-type-rates.index', compact('rates'));
    }

    public function create()
    {
        $roomTypes = RoomType::query()->with('property')->orderBy('name')->get();
        $ratePlans = RatePlan::query()->with('property')->orderBy('name')->get();

        return view('admin.room-type-rates.create', compact('roomTypes', 'ratePlans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'rate_plan_id' => ['required', 'exists:rate_plans,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'inventory_override' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        RoomTypeRate::create($data);

        return redirect()->route('admin.room-type-rates.index')->with('status', 'Rate created.');
    }

    public function edit(RoomTypeRate $room_type_rate)
    {
        $roomTypes = RoomType::query()->with('property')->orderBy('name')->get();
        $ratePlans = RatePlan::query()->with('property')->orderBy('name')->get();

        return view('admin.room-type-rates.edit', [
            'rate' => $room_type_rate,
            'roomTypes' => $roomTypes,
            'ratePlans' => $ratePlans,
        ]);
    }

    public function update(Request $request, RoomTypeRate $room_type_rate)
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'rate_plan_id' => ['required', 'exists:rate_plans,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'inventory_override' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $room_type_rate->update($data);

        return back()->with('status', 'Rate updated.');
    }

    public function destroy(RoomTypeRate $room_type_rate)
    {
        $room_type_rate->delete();

        return redirect()->route('admin.room-type-rates.index')->with('status', 'Rate deleted.');
    }
}

