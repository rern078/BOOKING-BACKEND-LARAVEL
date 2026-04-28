<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AdminAmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::query()->orderBy('name')->paginate(20);
        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:amenities,name'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        Amenity::create($data);

        return redirect()->route('admin.amenities.index')->with('status', 'Amenity created.');
    }

    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:amenities,name,'.$amenity->id],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        $amenity->update($data);

        return back()->with('status', 'Amenity updated.');
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()->route('admin.amenities.index')->with('status', 'Amenity deleted.');
    }
}

