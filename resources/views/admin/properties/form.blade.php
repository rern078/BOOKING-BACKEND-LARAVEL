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

    <div class="lg:col-span-12">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" class="rounded border"
                   name="is_active" value="1"
                   {{ old('is_active', $property->is_active ?? true) ? 'checked' : '' }}>
            Active
        </label>
    </div>
</div>

