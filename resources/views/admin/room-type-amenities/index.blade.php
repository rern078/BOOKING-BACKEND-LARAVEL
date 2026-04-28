<x-admin-layout :title="'Room Type Amenities'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Room Type Amenities</div>
                <div class="text-sm text-slate-600">Assign amenities to each room type.</div>
            </div>
            <a href="{{ route('admin.amenities.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                Manage Amenities
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Room Type</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Amenities</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($roomTypes as $rt)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $rt->name }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $rt->property?->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">
                                @if ($rt->amenities->isEmpty())
                                    -
                                @else
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($rt->amenities as $a)
                                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $a->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end">
                                    <a class="rounded-lg border bg-white px-2.5 py-1 text-xs font-semibold hover:bg-slate-50" href="{{ route('admin.room-type-amenities.edit', $rt) }}">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="4">No room types yet.</td>
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

