<x-admin-layout :title="'Payments'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="border-b p-5">
            <div class="text-lg font-semibold">Payments</div>
            <div class="text-sm text-slate-600">Recent payment transactions.</div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Booking</th>
                        <th class="px-5 py-3">Provider</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Amount</th>
                        <th class="px-5 py-3">Paid at</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($payments as $pay)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">#{{ $pay->id }}</td>
                            <td class="px-5 py-3 text-slate-700">
                                {{ $pay->booking?->reference ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $pay->provider ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $pay->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3 font-semibold">{{ $pay->currency }} {{ number_format((float) $pay->amount, 2) }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ optional($pay->paid_at)->format('Y-m-d H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No payments yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $payments->links() }}
        </div>
    </div>
</x-admin-layout>

