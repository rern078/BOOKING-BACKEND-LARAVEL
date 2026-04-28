<x-admin-layout :title="'Edit Room Type Amenities'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-lg font-semibold">Edit Amenities</div>
                <div class="text-sm text-slate-600">{{ $roomType->name }} • {{ $roomType->property?->name }}</div>
            </div>
            <a href="{{ route('admin.room-type-amenities.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                Back
            </a>
        </div>

        <form class="mt-6" method="POST" action="{{ route('admin.room-type-amenities.update', $roomType) }}">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border bg-slate-50 p-4">
                <div class="text-sm font-semibold">Select amenities</div>
                <div class="mt-3 grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @php($selected = $roomType->amenities->pluck('id')->all())
                    @foreach ($amenities as $a)
                        <label class="flex items-center gap-2 rounded-xl border bg-white px-3 py-2 text-sm hover:bg-slate-50">
                            <input
                                type="checkbox"
                                class="rounded border"
                                name="amenity_ids[]"
                                value="{{ $a->id }}"
                                {{ in_array($a->id, old('amenity_ids', $selected), true) ? 'checked' : '' }}
                            />
                            <span class="font-medium">{{ $a->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2 border-t pt-5">
                <a href="{{ route('admin.room-type-amenities.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    Cancel
                </a>
                <button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800" type="submit">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

