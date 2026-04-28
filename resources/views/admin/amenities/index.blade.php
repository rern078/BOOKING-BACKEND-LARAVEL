<x-admin-layout :title="'Amenities'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Amenities</div>
                <div class="text-sm text-slate-600">Manage amenities list.</div>
            </div>
            <a href="{{ route('admin.amenities.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Amenity
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Icon</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($amenities as $a)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $a->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $a->icon ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.amenities.edit', $a)"
                                    :delete-url="route('admin.amenities.destroy', $a)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="3">No amenities yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $amenities->links() }}
        </div>
    </div>
</x-admin-layout>

