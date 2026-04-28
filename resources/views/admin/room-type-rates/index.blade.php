<x-admin-layout :title="'Room Type Rates'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Room Type Rates</div>
                <div class="text-sm text-slate-600">Date-range pricing for room types.</div>
            </div>
            <a href="{{ route('admin.room-type-rates.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New Rate
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Room Type</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Rate plan</th>
                        <th class="px-5 py-3">Dates</th>
                        <th class="px-5 py-3">Price</th>
                        <th class="px-5 py-3">Inventory</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($rates as $r)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $r->roomType?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $r->roomType?->property?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $r->ratePlan?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">
                                {{ optional($r->start_date)->format('Y-m-d') }} → {{ optional($r->end_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-5 py-3 font-semibold">{{ $r->currency }} {{ number_format((float) $r->price, 2) }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $r->inventory_override ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.room-type-rates.edit', $r)"
                                    :delete-url="route('admin.room-type-rates.destroy', $r)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="7">No rates yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $rates->links() }}
        </div>
    </div>
</x-admin-layout>

