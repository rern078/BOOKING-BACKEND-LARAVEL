<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Booking *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="booking_id" required>
            @foreach ($bookings as $b)
                <option value="{{ $b->id }}" {{ (string) old('booking_id', $guest->booking_id ?? '') === (string) $b->id ? 'selected' : '' }}>
                    #{{ $b->id }} — {{ $b->reference ?? 'N/A' }} ({{ optional($b->check_in_date)->format('Y-m-d') }} → {{ optional($b->check_out_date)->format('Y-m-d') }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">First name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="first_name" required
               value="{{ old('first_name', $guest->first_name ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Last name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="last_name" required
               value="{{ old('last_name', $guest->last_name ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Email</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="email" type="email"
               value="{{ old('email', $guest->email ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Phone</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="phone"
               value="{{ old('phone', $guest->phone ?? '') }}">
    </div>

    <div class="lg:col-span-12">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" class="rounded border" name="is_primary" value="1" {{ old('is_primary', $guest->is_primary ?? false) ? 'checked' : '' }}>
            Primary guest for this booking
        </label>
    </div>
</div>

