<x-admin-layout :title="'Rooms'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Rooms</div>
                <div class="text-sm text-slate-600">Manage individual rooms.</div>
            </div>
            <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New Room
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Room #</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Room Type</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($rooms as $r)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $r->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $r->room_number ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $r->property?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $r->roomType?->name ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $r->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.rooms.edit', $r)"
                                    :delete-url="route('admin.rooms.destroy', $r)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No rooms yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $rooms->links() }}
        </div>
    </div>
</x-admin-layout>

