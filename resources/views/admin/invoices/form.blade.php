<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Booking *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="booking_id" required>
            @foreach ($bookings as $b)
                <option value="{{ $b->id }}" {{ (string) old('booking_id', $invoice->booking_id ?? '') === (string) $b->id ? 'selected' : '' }}>
                    #{{ $b->id }} — {{ $b->reference ?? 'N/A' }} ({{ optional($b->check_in_date)->format('Y-m-d') }} → {{ optional($b->check_out_date)->format('Y-m-d') }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Number *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="number" required
               value="{{ old('number', $invoice->number ?? '') }}"
               placeholder="INV-000001">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Currency *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="currency" required maxlength="3"
               value="{{ old('currency', $invoice->currency ?? 'USD') }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Status *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="status" required>
            @foreach (['draft' => 'Draft', 'issued' => 'Issued', 'paid' => 'Paid', 'void' => 'Void'] as $k => $v)
                <option value="{{ $k }}" {{ old('status', $invoice->status ?? 'draft') === $k ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Issued at</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="issued_at" type="date"
               value="{{ old('issued_at', optional($invoice->issued_at ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Due at</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="due_at" type="date"
               value="{{ old('due_at', optional($invoice->due_at ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Subtotal *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="subtotal" type="number" step="0.01" min="0" required
               value="{{ old('subtotal', $invoice->subtotal ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Tax total *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="tax_total" type="number" step="0.01" min="0" required
               value="{{ old('tax_total', $invoice->tax_total ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Total *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="total" type="number" step="0.01" min="0" required
               value="{{ old('total', $invoice->total ?? 0) }}">
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">PDF URL</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="pdf_url"
               value="{{ old('pdf_url', $invoice->pdf_url ?? '') }}"
               placeholder="https://...">
    </div>
</div>

