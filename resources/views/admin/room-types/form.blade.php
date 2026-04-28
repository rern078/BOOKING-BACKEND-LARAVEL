@php($isEdit = isset($roomType))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Property *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="property_id" required>
            <option value="">Select</option>
            @foreach ($properties as $p)
                <option value="{{ $p->id }}" {{ (string) old('property_id', $roomType->property_id ?? '') === (string) $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="name" required
               value="{{ old('name', $roomType->name ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Code</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="code"
               value="{{ old('code', $roomType->code ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Currency *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm uppercase shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="currency" maxlength="3" required
               value="{{ old('currency', $roomType->currency ?? 'USD') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Base price *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="base_price" type="number" step="0.01" min="0" required
               value="{{ old('base_price', $roomType->base_price ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Max adults *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="max_adults" type="number" min="0" max="20" required
               value="{{ old('max_adults', $roomType->max_adults ?? 1) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Max children *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="max_children" type="number" min="0" max="20" required
               value="{{ old('max_children', $roomType->max_children ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Max occupancy *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="max_occupancy" type="number" min="1" max="20" required
               value="{{ old('max_occupancy', $roomType->max_occupancy ?? 1) }}">
    </div>

    <div class="lg:col-span-12">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" class="rounded border"
                   name="is_active" value="1"
                   {{ old('is_active', $roomType->is_active ?? true) ? 'checked' : '' }}>
            Active
        </label>
    </div>
    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Description</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="description" rows="3">{{ old('description', $roomType->description ?? '') }}</textarea>
    </div>
</div>

