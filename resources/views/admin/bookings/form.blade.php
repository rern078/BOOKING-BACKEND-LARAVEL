@php($isEdit = isset($booking))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Property *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="property_id" required>
            <option value="">Select</option>
            @foreach ($properties as $p)
                <option value="{{ $p->id }}" {{ (string) old('property_id', $booking->property_id ?? '') === (string) $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Customer</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="customer_id">
            <option value="">—</option>
            @foreach ($customers as $c)
                <option value="{{ $c->id }}" {{ (string) old('customer_id', $booking->customer_id ?? '') === (string) $c->id ? 'selected' : '' }}>
                    {{ $c->full_name }} {{ $c->email ? "({$c->email})" : '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Check-in *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="check_in_date" type="date" required
               value="{{ old('check_in_date', optional($booking->check_in_date ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Check-out *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="check_out_date" type="date" required
               value="{{ old('check_out_date', optional($booking->check_out_date ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Status *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="status" required>
            @foreach (['pending','confirmed','checked_in','checked_out','cancelled','no_show'] as $s)
                <option value="{{ $s }}" {{ old('status', $booking->status ?? 'pending') === $s ? 'selected' : '' }}>
                    {{ $s }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Adults *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="adults" type="number" min="1" max="20" required
               value="{{ old('adults', $booking->adults ?? 1) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Children *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="children" type="number" min="0" max="20" required
               value="{{ old('children', $booking->children ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Rooms count *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="rooms_count" type="number" min="1" max="20" required
               value="{{ old('rooms_count', $booking->rooms_count ?? 1) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Currency *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm uppercase shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="currency" maxlength="3" required
               value="{{ old('currency', $booking->currency ?? 'USD') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Total *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="total" type="number" step="0.01" min="0" required
               value="{{ old('total', $booking->total ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Source</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="source"
               value="{{ old('source', $booking->source ?? '') }}"
               placeholder="web/admin/api">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Special requests</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="special_requests" rows="3">{{ old('special_requests', $booking->special_requests ?? '') }}</textarea>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Internal notes</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="internal_notes" rows="3">{{ old('internal_notes', $booking->internal_notes ?? '') }}</textarea>
    </div>
</div>

