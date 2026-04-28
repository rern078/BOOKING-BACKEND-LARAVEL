@php($isEdit = isset($rate))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Room Type *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="room_type_id" required>
            <option value="">Select</option>
            @foreach ($roomTypes as $rt)
                <option value="{{ $rt->id }}" {{ (string) old('room_type_id', $rate->room_type_id ?? '') === (string) $rt->id ? 'selected' : '' }}>
                    {{ $rt->name }} ({{ $rt->property?->name ?? '—' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Rate Plan *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="rate_plan_id" required>
            <option value="">Select</option>
            @foreach ($ratePlans as $rp)
                <option value="{{ $rp->id }}" {{ (string) old('rate_plan_id', $rate->rate_plan_id ?? '') === (string) $rp->id ? 'selected' : '' }}>
                    {{ $rp->name }} ({{ $rp->property?->name ?? '—' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Start date *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="start_date" type="date" required
               value="{{ old('start_date', optional($rate->start_date ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">End date *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="end_date" type="date" required
               value="{{ old('end_date', optional($rate->end_date ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Price *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="price" type="number" step="0.01" min="0" required
               value="{{ old('price', $rate->price ?? 0) }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Currency *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm uppercase shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="currency" maxlength="3" required
               value="{{ old('currency', $rate->currency ?? 'USD') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Inventory override</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="inventory_override" type="number" min="0"
               value="{{ old('inventory_override', $rate->inventory_override ?? '') }}"
               placeholder="leave blank = use default inventory">
    </div>
</div>

