<x-admin-layout :title="'Settings'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Settings</div>
                <div class="text-sm text-slate-600">Application configuration (key/value).</div>
            </div>
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('admin.settings.index') }}" class="hidden sm:block">
                    <input name="q" value="{{ $q ?? '' }}" placeholder="Search..." class="w-64 rounded-xl border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-300" />
                </form>
                <a href="{{ route('admin.settings.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                    + New Setting
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Key</th>
                        <th class="px-5 py-3">Group</th>
                        <th class="px-5 py-3">Type</th>
                        <th class="px-5 py-3">Value</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($settings as $s)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $s->key }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $s->group ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $s->type ?? '-' }}</td>
                            <td class="px-5 py-3 text-slate-700">
                                <div class="max-w-[520px] truncate">
                                    {{ is_array($s->value) ? json_encode($s->value) : ($s->value ?? '-') }}
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <x-admin.partials.table-actions
                                    :edit-url="route('admin.settings.edit', $s)"
                                    :delete-url="route('admin.settings.destroy', $s)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="5">No settings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">{{ $settings->links() }}</div>
    </div>
</x-admin-layout>
