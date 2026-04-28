<x-admin-layout :title="'Refunds'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Refunds</div>
                <div class="text-sm text-slate-600">Track refunded payment transactions.</div>
            </div>
            <a href="{{ route('admin.refunds.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Refund
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Payment</th>
                        <th class="px-5 py-3">Reference</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Refunded at</th>
                        <th class="px-5 py-3 text-right">Amount</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($refunds as $refund)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 text-slate-700">
                                <div class="font-semibold">{{ $refund->payment?->transaction_reference ?? ('#'.$refund->payment_id) }}</div>
                                <div class="text-xs text-slate-500">{{ $refund->payment?->booking?->reference ?? 'No booking' }}</div>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $refund->reference ?? '-' }}</td>
                            <td class="px-5 py-3"><span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $refund->status }}</span></td>
                            <td class="px-5 py-3 text-slate-600">{{ optional($refund->refunded_at)->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-5 py-3 text-right font-semibold">{{ $refund->currency }} {{ number_format((float) $refund->amount, 2) }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.refunds.edit', $refund)"
                                    :delete-url="route('admin.refunds.destroy', $refund)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-5 py-8 text-center text-slate-600" colspan="6">No refunds yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">{{ $refunds->links() }}</div>
    </div>
</x-admin-layout>
