@php($isEdit = isset($amenity))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="name" required
               value="{{ old('name', $amenity->name ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Icon (optional)</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="icon"
               value="{{ old('icon', $amenity->icon ?? '') }}"
               placeholder="wifi / pool / parking">
    </div>
</div>

