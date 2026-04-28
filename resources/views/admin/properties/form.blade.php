@php($isEdit = isset($property))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="name" required
               value="{{ old('name', $property->name ?? '') }}"
               placeholder="Property name">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Slug {{ $isEdit ? '*' : '(auto)' }}</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="slug" {{ $isEdit ? 'required' : '' }}
               value="{{ old('slug', $property->slug ?? '') }}"
               placeholder="property-slug">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Email</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="email" type="email"
               value="{{ old('email', $property->email ?? '') }}"
               placeholder="email@example.com">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Phone</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="phone"
               value="{{ old('phone', $property->phone ?? '') }}"
               placeholder="Phone number">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">City</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="city"
               value="{{ old('city', $property->city ?? '') }}"
               placeholder="City">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Country code (2 letters)</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="country_code"
               value="{{ old('country_code', $property->country_code ?? '') }}"
               placeholder="KH">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Timezone</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="timezone"
               value="{{ old('timezone', $property->timezone ?? 'UTC') }}"
               placeholder="UTC">
    </div>

    <div class="lg:col-span-12 rounded-xl border border-slate-200 bg-slate-50/80 p-4">
        <div class="text-sm font-semibold text-slate-900">Main image</div>
        <p class="mt-1 text-xs text-slate-600">Cover photo used in listings (optional).</p>
        @if ($isEdit && $property->image_path)
            <div class="mt-3 flex flex-wrap items-end gap-4">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($property->image_path) }}" alt="" class="h-6 w-auto rounded-lg border border-slate-200 object-cover shadow-sm">
                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remove_image" value="1" class="rounded border" {{ old('remove_image') ? 'checked' : '' }}>
                    Remove current image
                </label>
            </div>
        @endif
        <div class="mt-3">
            <input type="file" name="image" accept="image/*"
                   class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-slate-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-600">
        </div>
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-12 rounded-xl border border-slate-200 bg-slate-50/80 p-4">
        <div class="text-sm font-semibold text-slate-900">Gallery</div>
        <p class="mt-1 text-xs text-slate-600">Add multiple photos. You can upload several files at once.</p>
        @if ($isEdit && $property->gallery->isNotEmpty())
            <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($property->gallery as $img)
                    <label class="flex gap-3 rounded-lg border border-slate-200 bg-white p-2 shadow-sm">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($img->path) }}" alt="" class="h-6 w-auto shrink-0 rounded-md object-cover">
                        <span class="flex min-w-0 flex-1 flex-col justify-center text-sm">
                            <span class="truncate text-slate-700">{{ basename($img->path) }}</span>
                            <span class="mt-1 inline-flex items-center gap-2">
                                <input type="checkbox" name="remove_gallery[]" value="{{ $img->id }}" class="rounded border">
                                <span class="text-xs text-red-700">Remove</span>
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>
        @endif
        <div class="mt-3">
            <input type="file" name="gallery[]" multiple accept="image/*"
                   class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-white file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-900 file:ring-1 file:ring-slate-200 hover:file:bg-slate-50">
        </div>
        @error('gallery')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('gallery.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-12">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" class="rounded border"
                   name="is_active" value="1"
                   {{ old('is_active', $property->is_active ?? true) ? 'checked' : '' }}>
            Active
        </label>
    </div>
</div>

