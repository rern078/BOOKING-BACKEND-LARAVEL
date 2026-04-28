<x-admin-layout :title="'Invoices'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Invoices</div>
                <div class="text-sm text-slate-600">Billing documents for bookings.</div>
            </div>
            <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New Invoice
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Number</th>
                        <th class="px-5 py-3">Booking</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Issued</th>
                        <th class="px-5 py-3 text-right">Total</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($invoices as $inv)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $inv->number }}</td>
                            <td class="px-5 py-3 text-slate-700">
                                <div class="font-semibold">{{ $inv->booking?->reference ?? ('#'.$inv->booking_id) }}</div>
                                <div class="text-xs text-slate-500">{{ $inv->booking?->property?->name }}</div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $inv->status }}</span>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ optional($inv->issued_at)->format('Y-m-d') }}</td>
                            <td class="px-5 py-3 text-right font-semibold">{{ $inv->currency }} {{ number_format((float)$inv->total, 2) }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.invoices.edit', $inv)"
                                    :delete-url="route('admin.invoices.destroy', $inv)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No invoices yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $invoices->links() }}
        </div>
    </div>
</x-admin-layout>

