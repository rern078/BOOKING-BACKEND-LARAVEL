<x-admin-layout :title="'Reviews'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Reviews</div>
                <div class="text-sm text-slate-600">Manage property reviews and publication status.</div>
            </div>
            <a href="{{ route('admin.reviews.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Review
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Rating</th>
                        <th class="px-5 py-3">Published</th>
                        <th class="px-5 py-3">Title</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($reviews as $review)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 text-slate-700">
                                <div class="font-semibold">{{ $review->property?->name ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $review->booking?->reference ?? 'No booking linked' }}</div>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $review->customer?->full_name ?? '-' }}</td>
                            <td class="px-5 py-3 font-semibold">{{ $review->rating }}/5</td>
                            <td class="px-5 py-3">
                                @if ($review->is_published)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Published</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Draft</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-slate-700">{{ $review->title ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.reviews.edit', $review)"
                                    :delete-url="route('admin.reviews.destroy', $review)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-5 py-8 text-center text-slate-600" colspan="6">No reviews yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">{{ $reviews->links() }}</div>
    </div>
</x-admin-layout>
