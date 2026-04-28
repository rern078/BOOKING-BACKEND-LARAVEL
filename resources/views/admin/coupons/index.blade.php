<x-admin-layout :title="'Coupons'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Coupons</div>
                <div class="text-sm text-slate-600">Discount codes.</div>
            </div>
            <a href="{{ route('admin.coupons.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                + New Coupon
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Code</th>
                        <th class="px-5 py-3">Type</th>
                        <th class="px-5 py-3">Value</th>
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Active</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($coupons as $c)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $c->code }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $c->type }}</td>
                            <td class="px-5 py-3 font-semibold">
                                {{ $c->type === 'percent' ? rtrim(rtrim(number_format((float)$c->value, 2), '0'), '.') . '%' : number_format((float)$c->value, 2) }}
                            </td>
                            <td class="px-5 py-3 text-slate-700">{{ $c->property?->name ?? 'All properties' }}</td>
                            <td class="px-5 py-3">
                                @if ($c->is_active)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.coupons.edit', $c)"
                                    :delete-url="route('admin.coupons.destroy', $c)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No coupons yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $coupons->links() }}
        </div>
    </div>
</x-admin-layout>

