<x-admin-layout :title="'Edit Property'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-lg font-semibold">Edit Property</div>
                <div class="text-sm text-slate-600">{{ $property->name }}</div>
            </div>
            <a href="{{ route('admin.properties.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                Back
            </a>
        </div>

        <form class="mt-6" method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.properties.form', ['property' => $property])

            <div class="mt-6 flex justify-end gap-2 border-t pt-5">
                <a href="{{ route('admin.properties.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    Cancel
                </a>
                <button class="rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600" type="submit">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

