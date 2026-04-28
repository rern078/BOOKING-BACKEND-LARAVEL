@php($isEdit = isset($refund))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Payment *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="payment_id" required>
            @foreach ($payments as $payment)
                <option value="{{ $payment->id }}" {{ (string) old('payment_id', $refund->payment_id ?? '') === (string) $payment->id ? 'selected' : '' }}>
                    #{{ $payment->id }} - {{ $payment->transaction_reference ?? 'No ref' }} ({{ $payment->booking?->reference ?? 'No booking' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Currency *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="currency" maxlength="3" required value="{{ old('currency', $refund->currency ?? 'USD') }}">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Amount *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="amount" type="number" step="0.01" min="0" required value="{{ old('amount', $refund->amount ?? 0) }}">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Status *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="status" required>
            @foreach (['pending' => 'Pending', 'succeeded' => 'Succeeded', 'failed' => 'Failed'] as $k => $v)
                <option value="{{ $k }}" {{ old('status', $refund->status ?? 'pending') === $k ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Reference</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="reference" value="{{ old('reference', $refund->reference ?? '') }}" placeholder="RF-000001">
    </div>

    <div class="lg:col-span-4">
        <label class="text-sm font-medium">Refunded at</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="refunded_at" type="date" value="{{ old('refunded_at', optional($refund->refunded_at ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Notes</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="meta" rows="4">{{ old('meta', $refund->meta['notes'] ?? '') }}</textarea>
    </div>
</div>
