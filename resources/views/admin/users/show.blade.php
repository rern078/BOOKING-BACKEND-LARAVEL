<x-admin-layout :title="'User Details'">
    @include('admin.partials.flash')

    <div class="mb-4 flex items-center justify-between">
        <div>
            <div class="text-lg font-semibold">User Details</div>
            <div class="text-sm text-slate-600">View account information and roles.</div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
            ← Back
        </a>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border bg-white p-5 shadow-sm lg:col-span-2">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <div class="text-xl font-bold">{{ $user->name }}</div>
                    <div class="mt-1 text-sm text-slate-600">{{ $user->email }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-slate-500 text-white">
                    <span class="text-lg font-semibold">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">User ID</div>
                    <div class="mt-1 font-semibold">{{ $user->id }}</div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Created</div>
                    <div class="mt-1 font-semibold">{{ optional($user->created_at)->format('Y-m-d H:i') ?? '-' }}</div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Email verified</div>
                    <div class="mt-1 font-semibold">
                        {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i') : 'No' }}
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Roles</div>
                    <div class="mt-1 flex flex-wrap gap-2">
                        @forelse ($user->roles as $role)
                            <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                                {{ $role->name }}
                            </span>
                        @empty
                            <span class="text-sm text-slate-600">-</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-4">
                <div class="text-sm font-semibold">Change Role</div>
                <div class="mt-1 text-sm text-slate-600">Set this user as admin or user.</div>

                @php($currentRole = $user->roles->pluck('name')->first() ?? 'user')
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                    @csrf
                    @method('PATCH')

                    <select
                        name="role"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:w-56"
                    >
                        <option value="user" @selected($currentRole === 'user')>user</option>
                        <option value="admin" @selected($currentRole === 'admin')>admin</option>
                    </select>

                    <button class="inline-flex items-center justify-center rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600" type="submit">
                        Save
                    </button>
                </form>
            </div>

            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4">
                <div class="text-sm font-semibold">Account Status</div>
                <div class="mt-1 text-sm text-slate-600">Disable to prevent this user from logging in.</div>

                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm">
                        Status:
                        @if ($user->is_active ?? true)
                            <span class="ml-2 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                        @else
                            <span class="ml-2 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Inactive</span>
                        @endif
                    </div>

                    <form
                        method="POST"
                        action="{{ route('admin.users.status', $user) }}"
                        onsubmit="return confirm('{{ ($user->is_active ?? true) ? 'Disable this user?' : 'Enable this user?' }}')"
                    >
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="is_active" value="{{ ($user->is_active ?? true) ? 0 : 1 }}">

                        @if (($user->is_active ?? true))
                            <button class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-800 hover:bg-red-100" type="submit">
                                Disable user
                            </button>
                        @else
                            <button class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500" type="submit">
                                Enable user
                            </button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4">
                <div class="text-sm font-semibold">Online Status</div>
                <div class="mt-1 text-sm text-slate-600">Based on latest frontend activity (last 5 minutes).</div>

                @php($lastUsedRaw = $user->api_tokens_max_last_used_at ?? null)
                @php($lastUsed = $lastUsedRaw ? \Illuminate\Support\Carbon::parse($lastUsedRaw) : null)
                @php($online = $lastUsed && now()->diffInMinutes($lastUsed) <= 5)

                <div class="mt-4 flex items-center gap-2 text-sm font-semibold">
                    <span class="h-2.5 w-2.5 rounded-full {{ $online ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                    <span class="{{ $online ? 'text-emerald-700' : 'text-slate-600' }}">
                        {{ $online ? 'Online' : 'Offline' }}
                    </span>
                </div>
                @if ($lastUsed)
                    <div class="mt-2 text-sm text-slate-600">Last seen: {{ $lastUsed->format('Y-m-d H:i') }}</div>
                @else
                    <div class="mt-2 text-sm text-slate-600">No activity yet.</div>
                @endif
            </div>
        </div>

        <div class="rounded-2xl border bg-white p-5 shadow-sm">
            <div class="text-sm font-semibold">Customer Profile</div>
            <div class="mt-1 text-sm text-slate-600">If this user is linked to a customer.</div>

            <div class="mt-4 rounded-2xl bg-slate-50 p-4 text-sm">
                @if ($user->customer)
                    <div class="font-semibold">{{ $user->customer->full_name }}</div>
                    <div class="mt-2 text-slate-600">Email: {{ $user->customer->email ?? '-' }}</div>
                    <div class="text-slate-600">Phone: {{ $user->customer->phone ?? '-' }}</div>
                    <div class="text-slate-600">DOB: {{ optional($user->customer->date_of_birth)->format('Y-m-d') ?? '-' }}</div>
                    <div class="mt-3">
                        <a
                            class="inline-flex items-center justify-center rounded-xl border bg-white px-3 py-2 text-xs font-semibold hover:bg-slate-50"
                            href="{{ route('admin.customers.edit', $user->customer) }}"
                        >
                            Open Customer
                        </a>
                    </div>
                @else
                    <div class="text-slate-600">No customer profile linked.</div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>

