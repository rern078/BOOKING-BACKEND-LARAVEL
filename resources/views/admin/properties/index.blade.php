<x-admin-layout :title="'Properties'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Properties</div>
                <div class="text-sm text-slate-600">Manage hotels/branches.</div>
            </div>
            <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Property
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Image</th>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Slug</th>
                        <th class="px-5 py-3">City</th>
                        <th class="px-5 py-3">Gallery</th>
                        <th class="px-5 py-3">Active</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($properties as $p)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 align-middle">
                                @if ($p->image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($p->image_path) }}" alt="" class="h-6 w-auto rounded-lg border border-slate-200 object-cover shadow-sm">
                                @else
                                    <span class="inline-flex h-6 min-w-[1.5rem] items-center justify-center rounded-lg border border-dashed border-slate-200 bg-slate-50 text-xs text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 font-semibold">{{ $p->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $p->slug }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $p->city ?? '-' }}</td>
                            <td class="px-5 py-3 align-middle">
                                @php($gallery = $p->gallery)
                                @if (($p->gallery_count ?? 0) === 0)
                                    <span class="text-slate-400">—</span>
                                @else
                                    <div class="flex flex-wrap items-center gap-1">
                                        @foreach ($gallery as $img)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($img->path) }}" alt="" class="h-6 w-auto rounded border border-slate-200 object-cover" title="Gallery">
                                        @endforeach
                                        @if ($p->gallery_count > 4)
                                            <span class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-semibold text-slate-600">+{{ $p->gallery_count - 4 }}</span>
                                        @endif
                                    </div>
                                    <!-- <div class="mt-1 text-xs text-slate-500">{{ $p->gallery_count }} {{ \Illuminate\Support\Str::plural('photo', $p->gallery_count) }}</div> -->
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if ($p->is_active)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.properties.edit', $p)"
                                    :delete-url="route('admin.properties.destroy', $p)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="7">No properties yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $properties->links() }}
        </div>
    </div>
</x-admin-layout>

