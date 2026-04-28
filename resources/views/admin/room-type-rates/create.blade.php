<x-admin-layout :title="'New Room Type Rate'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-lg font-semibold">Create Rate</div>
                <div class="text-sm text-slate-600">Add a date-range price.</div>
            </div>
            <a href="{{ route('admin.room-type-rates.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                Back
            </a>
        </div>

        <form class="mt-6" method="POST" action="{{ route('admin.room-type-rates.store') }}">
            @csrf
            @include('admin.room-type-rates.form')

            <div class="mt-6 flex justify-end gap-2 border-t pt-5">
                <a href="{{ route('admin.room-type-rates.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    Cancel
                </a>
                <button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

