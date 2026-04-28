<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPropertyController extends Controller
{
    public function index()
    {
        $properties = Property::query()
            ->with(['gallery' => fn ($q) => $q->orderBy('sort_order')->orderBy('id')->limit(4)])
            ->withCount('gallery')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:properties,slug'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:255'],
            'country_code' => ['nullable', 'string', 'size:2'],
            'timezone' => ['nullable', 'string', 'max:64'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:5120'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']).'-'.Str::random(6);
        $data['timezone'] = $data['timezone'] ?: 'UTC';
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        unset($data['image'], $data['gallery']);

        $property = Property::create($data);

        $this->syncMainImage($request, $property);

        $this->appendGalleryUploads($request->file('gallery', []), $property);

        return redirect()->route('admin.properties.index')->with('status', 'Property created.');
    }

    public function edit(Property $property)
    {
        $property->load('gallery');

        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:properties,slug,'.$property->id],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:255'],
            'country_code' => ['nullable', 'string', 'size:2'],
            'timezone' => ['nullable', 'string', 'max:64'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:5120'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['integer', 'exists:property_images,id'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        unset($data['image'], $data['gallery'], $data['remove_image'], $data['remove_gallery']);

        $property->update($data);

        if ($request->boolean('remove_image')) {
            $this->deleteMainImageFile($property);
            $property->update(['image_path' => null]);
        }

        $this->syncMainImage($request, $property);

        $removeIds = $request->input('remove_gallery', []);
        if (is_array($removeIds) && count($removeIds) > 0) {
            $images = $property->gallery()->whereIn('id', $removeIds)->get();
            foreach ($images as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
        }

        $this->appendGalleryUploads($request->file('gallery', []), $property);

        return back()->with('status', 'Property updated.');
    }

    public function destroy(Property $property)
    {
        $this->deleteMainImageFile($property);
        foreach ($property->gallery as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }
        $property->delete();

        return redirect()->route('admin.properties.index')->with('status', 'Property deleted.');
    }

    private function syncMainImage(Request $request, Property $property): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        $this->deleteMainImageFile($property);

        $path = $request->file('image')->store('properties', 'public');
        $property->update(['image_path' => $path]);
    }

    private function deleteMainImageFile(Property $property): void
    {
        if ($property->image_path) {
            Storage::disk('public')->delete($property->image_path);
        }
    }

    /**
     * @param  array<int, \Illuminate\Http\UploadedFile|null>  $files
     */
    private function appendGalleryUploads(array $files, Property $property): void
    {
        $files = array_values(array_filter($files));
        if (count($files) === 0) {
            return;
        }

        $maxOrder = (int) $property->gallery()->max('sort_order');

        foreach ($files as $i => $file) {
            $path = $file->store('properties/gallery', 'public');
            $property->gallery()->create([
                'path' => $path,
                'sort_order' => $maxOrder + $i + 1,
            ]);
        }
    }
}
