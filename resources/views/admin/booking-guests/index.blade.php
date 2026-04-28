<x-admin-layout :title="'Booking Guests'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Booking Guests</div>
                <div class="text-sm text-slate-600">Guests linked to bookings.</div>
            </div>
            <a href="{{ route('admin.booking-guests.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Guest
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Guest</th>
                        <th class="px-5 py-3">Booking</th>
                        <th class="px-5 py-3">Primary</th>
                        <th class="px-5 py-3">Contact</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($guests as $g)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3">
                                <div class="font-semibold">{{ $g->first_name }} {{ $g->last_name }}</div>
                                <div class="text-xs text-slate-500">#{{ $g->id }}</div>
                            </td>
                            <td class="px-5 py-3 text-slate-700">
                                <div class="font-semibold">{{ $g->booking?->reference ?? ('#'.$g->booking_id) }}</div>
                                <div class="text-xs text-slate-500">{{ $g->booking?->property?->name }}</div>
                            </td>
                            <td class="px-5 py-3">
                                @if ($g->is_primary)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Yes</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">No</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-slate-600">
                                <div>{{ $g->email ?? '—' }}</div>
                                <div class="text-xs">{{ $g->phone ?? '' }}</div>
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.booking-guests.edit', $g)"
                                    :delete-url="route('admin.booking-guests.destroy', $g)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="5">No guests yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $guests->links() }}
        </div>
    </div>
</x-admin-layout>

