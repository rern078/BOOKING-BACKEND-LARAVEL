@php($isEdit = isset($coupon))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Code *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="code" required
               value="{{ old('code', $coupon->code ?? '') }}"
               placeholder="SAVE10">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Property</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="property_id">
            <option value="">All properties</option>
            @foreach ($properties as $p)
                <option value="{{ $p->id }}" {{ (string) old('property_id', $coupon->property_id ?? '') === (string) $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Name</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="name"
               value="{{ old('name', $coupon->name ?? '') }}"
               placeholder="Summer Sale">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Type *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="type" required>
            @foreach (['percent' => 'Percent', 'fixed' => 'Fixed'] as $k => $v)
                <option value="{{ $k }}" {{ old('type', $coupon->type ?? 'percent') === $k ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Value *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="value" type="number" step="0.01" min="0" required
               value="{{ old('value', $coupon->value ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Min total</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="min_total" type="number" step="0.01" min="0"
               value="{{ old('min_total', $coupon->min_total ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Max redemptions</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="max_redemptions" type="number" min="1"
               value="{{ old('max_redemptions', $coupon->max_redemptions ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="inline-flex items-center gap-2 text-sm mt-6">
            <input type="checkbox" class="rounded border" name="is_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }}>
            Active
        </label>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Starts at</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="starts_at" type="date"
               value="{{ old('starts_at', optional($coupon->starts_at ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Ends at</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="ends_at" type="date"
               value="{{ old('ends_at', optional($coupon->ends_at ?? null)->format('Y-m-d')) }}">
    </div>
</div>

