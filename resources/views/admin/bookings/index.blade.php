<x-admin-layout :title="'Bookings'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Bookings</div>
                <div class="text-sm text-slate-600">Manage reservations.</div>
            </div>
            <a href="{{ route('admin.bookings.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Booking
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Ref</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Dates</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Total</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($bookings as $b)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $b->reference }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $b->property?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $b->customer?->full_name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">
                                {{ optional($b->check_in_date)->format('Y-m-d') }} → {{ optional($b->check_out_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $b->status }}</span>
                            </td>
                            <td class="px-5 py-3 font-semibold">{{ $b->currency }} {{ number_format((float) $b->total, 2) }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.bookings.edit', $b)"
                                    :delete-url="route('admin.bookings.destroy', $b)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="7">No bookings yet.</td>
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

