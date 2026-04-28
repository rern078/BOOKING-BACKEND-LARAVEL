<x-admin-layout :title="'Booking Coupons'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Booking Coupons</div>
                <div class="text-sm text-slate-600">Assign coupons to bookings.</div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Booking</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Coupons</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($bookings as $b)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3">
                                <div class="font-semibold">{{ $b->reference ?? ('#'.$b->id) }}</div>
                                <div class="text-xs text-slate-500">{{ $b->property?->name }}</div>
                            </td>
                            <td class="px-5 py-3 text-slate-700">{{ $b->customer?->first_name }} {{ $b->customer?->last_name }}</td>
                            <td class="px-5 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($b->coupons as $c)
                                        <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">{{ $c->code }}</span>
                                    @empty
                                        <span class="text-slate-500">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.booking-coupons.edit', $b) }}" class="rounded-xl border bg-white px-3 py-2 text-sm font-semibold hover:bg-slate-50">
                                    Manage
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="4">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $bookings->links() }}
        </div>
    </div>
</x-admin-layout>

