@php($isEdit = isset($customer))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">First name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="first_name" required
               value="{{ old('first_name', $customer->first_name ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Last name *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="last_name" required
               value="{{ old('last_name', $customer->last_name ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Email</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="email" type="email"
               value="{{ old('email', $customer->email ?? '') }}">
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Phone</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="phone"
               value="{{ old('phone', $customer->phone ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Country code</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm uppercase shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="country_code" maxlength="2"
               value="{{ old('country_code', $customer->country_code ?? '') }}"
               placeholder="KH">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">ID number</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="id_number"
               value="{{ old('id_number', $customer->id_number ?? '') }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Date of birth</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="date_of_birth" type="date"
               value="{{ old('date_of_birth', optional($customer->date_of_birth ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Notes</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="notes" rows="3">{{ old('notes', $customer->notes ?? '') }}</textarea>
    </div>
</div>

