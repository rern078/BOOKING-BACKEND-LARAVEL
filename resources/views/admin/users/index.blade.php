<x-admin-layout :title="'Users'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-lg font-semibold">Users</div>
                <div class="text-sm text-slate-600">All registered accounts.</div>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-2">
                    <input
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:w-64"
                        name="q"
                        value="{{ $q ?? '' }}"
                        placeholder="Search name or email"
                    />
                    <button class="rounded-xl border bg-white px-3 py-2 text-sm font-semibold hover:bg-slate-50" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Roles</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Online</th>
                        <th class="px-5 py-3">Created</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($users as $u)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">{{ $u->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $u->email }}</td>
                            <td class="px-5 py-3 text-slate-600">
                                @php($roles = $u->roles->pluck('name')->values())
                                {{ $roles->isEmpty() ? '-' : $roles->join(', ') }}
                            </td>
                            <td class="px-5 py-3">
                                @if ($u->is_active ?? true)
                                    <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @php($lastUsedRaw = $u->api_tokens_max_last_used_at ?? null)
                                @php($lastUsed = $lastUsedRaw ? \Illuminate\Support\Carbon::parse($lastUsedRaw) : null)
                                @php($online = $lastUsed && now()->diffInMinutes($lastUsed) <= 5)
                                <div class="flex items-center gap-2 text-xs font-semibold">
                                    <span class="h-2 w-2 rounded-full {{ $online ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="{{ $online ? 'text-emerald-700' : 'text-slate-500' }}">
                                        {{ $online ? 'Online' : 'Offline' }}
                                    </span>
                                </div>
                                @if ($lastUsed)
                                    <div class="mt-1 text-xs text-slate-500">Last: {{ $lastUsed->format('Y-m-d H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ optional($u->created_at)->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a class="rounded-lg border bg-white px-2.5 py-1 text-xs font-semibold hover:bg-slate-50" href="{{ route('admin.users.show', $u) }}">
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="7">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>

