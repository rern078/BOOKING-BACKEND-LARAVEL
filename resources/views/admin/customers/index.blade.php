<x-admin-layout :title="'Customers'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Customers</div>
                <div class="text-sm text-slate-600">Manage customers.</div>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <form method="GET" action="{{ route('admin.customers.index') }}" class="flex items-center gap-2">
                    <input
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:w-64"
                        name="q"
                        value="{{ $q ?? '' }}"
                        placeholder="Search name, email, phone"
                    />
                    <button class="rounded-xl border bg-white px-3 py-2 text-sm font-semibold hover:bg-slate-50" type="submit">
                        Search
                    </button>
                </form>

                <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                    + New Customer
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Phone</th>
                        <th class="px-5 py-3">DOB</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($customers as $c)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $c->full_name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $c->email ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $c->phone ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ optional($c->date_of_birth)->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.customers.edit', $c)"
                                    :delete-url="route('admin.customers.destroy', $c)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="5">No customers yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $customers->links() }}
        </div>
    </div>
</x-admin-layout>

