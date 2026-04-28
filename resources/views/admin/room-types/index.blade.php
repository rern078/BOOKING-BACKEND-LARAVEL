<x-admin-layout :title="'Room Types'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Room Types</div>
                <div class="text-sm text-slate-600">Manage room categories.</div>
            </div>
            <a href="{{ route('admin.room-types.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New Room Type
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Code</th>
                        <th class="px-5 py-3">Base price</th>
                        <th class="px-5 py-3">Active</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($roomTypes as $rt)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $rt->name }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $rt->property?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $rt->code ?? '-' }}</td>
                            <td class="px-5 py-3 font-semibold">{{ $rt->currency }} {{ number_format((float) $rt->base_price, 2) }}</td>
                            <td class="px-5 py-3">
                                @if ($rt->is_active)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.room-types.edit', $rt)"
                                    :delete-url="route('admin.room-types.destroy', $rt)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No room types yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $roomTypes->links() }}
        </div>
    </div>
</x-admin-layout>

