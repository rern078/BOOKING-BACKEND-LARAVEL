@php($isEdit = isset($room))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Property *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="property_id" required>
            <option value="">Select</option>
            @foreach ($properties as $p)
                <option value="{{ $p->id }}" {{ (string) old('property_id', $room->property_id ?? '') === (string) $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Room Type *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="room_type_id" required>
            <option value="">Select</option>
            @foreach ($roomTypes as $rt)
                <option value="{{ $rt->id }}" {{ (string) old('room_type_id', $room->room_type_id ?? '') === (string) $rt->id ? 'selected' : '' }}>
                    {{ $rt->name }} ({{ $rt->property?->name ?? '—' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="name" required
               value="{{ old('name', $room->name ?? '') }}"
               placeholder="Room name">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Room number</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="room_number"
               value="{{ old('room_number', $room->room_number ?? '') }}"
               placeholder="101">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Floor</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="floor"
               value="{{ old('floor', $room->floor ?? '') }}"
               placeholder="1">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Status *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="status" required>
            @foreach (['active','maintenance','out_of_order'] as $s)
                <option value="{{ $s }}" {{ old('status', $room->status ?? 'active') === $s ? 'selected' : '' }}>
                    {{ $s }}
                </option>
            @endforeach
        </select>
    </div>
</div>

