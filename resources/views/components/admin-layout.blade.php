@props([
    'title' => 'Admin',
    'variant' => 'app', // app | auth
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>[x-cloak]{display:none!important}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    @php
        $nav = [
            ['label' => 'Dashboard', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'dashboard'],
            ['label' => 'Bookings', 'href' => route('admin.bookings.index'), 'active' => request()->routeIs('admin.bookings.*'), 'icon' => 'calendar'],
            [
                'label' => 'Invoices & Coupons',
                'href' => '#',
                'active' => request()->routeIs('admin.invoices.*') || request()->routeIs('admin.coupons.*') || request()->routeIs('admin.booking-coupons.*') || request()->routeIs('admin.booking-guests.*'),
                'icon' => 'layers',
                'children' => [
                    ['label' => 'Invoices', 'href' => route('admin.invoices.index'), 'active' => request()->routeIs('admin.invoices.*')],
                    ['label' => 'Coupons', 'href' => route('admin.coupons.index'), 'active' => request()->routeIs('admin.coupons.*')],
                    ['label' => 'Booking coupons', 'href' => route('admin.booking-coupons.index'), 'active' => request()->routeIs('admin.booking-coupons.*')],
                    ['label' => 'Booking guests', 'href' => route('admin.booking-guests.index'), 'active' => request()->routeIs('admin.booking-guests.*')],
                ],
            ],
            ['label' => 'Users', 'href' => route('admin.users.index'), 'active' => request()->routeIs('admin.users.*'), 'icon' => 'users'],
            ['label' => 'Customers', 'href' => route('admin.customers.index'), 'active' => request()->routeIs('admin.customers.*'), 'icon' => 'users'],
            ['label' => 'Properties', 'href' => route('admin.properties.index'), 'active' => request()->routeIs('admin.properties.*'), 'icon' => 'building'],
            [
                'label' => 'Room',
                'href' => '#',
                'active' => request()->routeIs('admin.rooms.*') || request()->routeIs('admin.room-types.*') || request()->routeIs('admin.room-type-rates.*') || request()->routeIs('admin.room-type-amenities.*') || request()->routeIs('admin.amenities.*'),
                'icon' => 'door',
                'children' => [
                    ['label' => 'Room', 'href' => route('admin.rooms.index'), 'active' => request()->routeIs('admin.rooms.*')],
                    ['label' => 'Room type', 'href' => route('admin.room-types.index'), 'active' => request()->routeIs('admin.room-types.*')],
                    ['label' => 'Room type rate', 'href' => route('admin.room-type-rates.index'), 'active' => request()->routeIs('admin.room-type-rates.*')],
                    ['label' => 'Amenities', 'href' => route('admin.amenities.index'), 'active' => request()->routeIs('admin.amenities.*')],
                    ['label' => 'Room type amenities', 'href' => route('admin.room-type-amenities.index'), 'active' => request()->routeIs('admin.room-type-amenities.*')],
                ],
            ],
            ['label' => 'Payments', 'href' => route('admin.payments.index'), 'active' => request()->routeIs('admin.payments.*'), 'icon' => 'credit-card'],
            ['label' => 'Profile', 'href' => route('admin.profile'), 'active' => request()->routeIs('admin.profile*'), 'icon' => 'user'],
        ];

        $hero = function (string $name): string {
            return match ($name) {
                'dashboard' => 'home',
                'calendar' => 'calendar-days',
                'users' => 'users',
                'building' => 'building-office-2',
                'layers' => 'squares-2x2',
                'door' => 'key',
                'credit-card' => 'credit-card',
                'user' => 'user-circle',
                default => 'home',
            };
        };
    @endphp

    @if ($variant === 'auth')
        <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">
            <div class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-4 py-12">
                <div class="w-full">
                    <div class="mx-auto mb-8 flex max-w-md items-center justify-center gap-2 text-slate-900">
                        <div class="grid h-9 w-9 place-items-center rounded-xl bg-slate-500 text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" aria-hidden="true">
                                <path d="M7 7h10M7 12h10M7 17h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="text-lg font-semibold">Booking Admin</div>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    @else
        <div x-data="{ sidebarOpen: false, profileOpen: false }" class="min-h-screen">
            <!-- Mobile sidebar overlay -->
            <div
                x-show="sidebarOpen"
                x-transition.opacity
                class="fixed inset-0 z-40 bg-slate-500/40 lg:hidden"
                @click="sidebarOpen = false"
                aria-hidden="true"
            ></div>

            <!-- Sidebar -->
            <aside
                class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full border-r bg-white shadow-sm transition-transform lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            >
                <div class="flex h-16 items-center justify-between border-b px-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <div class="grid h-9 w-9 place-items-center rounded-xl bg-slate-500 text-white">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" aria-hidden="true">
                                <path d="M4 12h16M12 4v16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-semibold leading-tight">Preclinic-like</div>
                            <div class="text-xs text-slate-500 leading-tight">Admin panel</div>
                        </div>
                    </a>
                    <button class="rounded-lg p-2 hover:bg-slate-100 lg:hidden" @click="sidebarOpen = false" type="button">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

                <div class="p-5">
                    <div class="rounded-2xl border bg-slate-50 p-4">
                        <div class="text-xs text-slate-500">Clinic</div>
                        <div class="mt-1 font-semibold">Trustcare Clinic</div>
                        <div class="text-sm text-slate-600">Lasvegas</div>
                    </div>

                    <div class="mt-6">
                        <div class="px-2 text-xs font-semibold text-slate-500">MAIN MENU</div>
                        <nav class="mt-3 space-y-1">
                            @foreach ($nav as $item)
                                @php($active = (bool) ($item['active'] ?? false))
                                @if (!empty($item['children']) && is_array($item['children']))
                                    <div x-data="{ open: {{ $active ? 'true' : 'false' }} }">
                                        <button
                                            type="button"
                                            class="w-full flex items-center justify-between gap-3 rounded-xl px-3 py-2 text-sm transition
                                                {{ $active ? 'bg-slate-500 text-white' : 'text-slate-700 hover:bg-slate-100' }}"
                                            @click="open = !open"
                                        >
                                            <span class="flex items-center gap-3">
                                                <span class="grid h-8 w-8 place-items-center rounded-lg {{ $active ? 'bg-white/10' : 'bg-slate-100' }}">
                                                    @php($heroName = $hero((string)($item['icon'] ?? '')))
                                                    <x-dynamic-component :component="'heroicon-o-'.$heroName" class="h-4 w-4" />
                                                </span>
                                                <span class="font-medium">{{ $item['label'] }}</span>
                                            </span>
                                            <x-heroicon-o-chevron-down
                                                class="h-4 w-4 transition-transform"
                                                x-bind:class="open ? 'rotate-180' : ''"
                                            />
                                        </button>

                                        <div x-show="open" x-collapse class="mt-1 space-y-1 pl-12">
                                            @foreach ($item['children'] as $child)
                                                @php($childActive = (bool) ($child['active'] ?? false))
                                                <a
                                                    href="{{ $child['href'] }}"
                                                    class="block rounded-xl px-3 py-2 text-sm transition
                                                        {{ $childActive ? 'bg-slate-500 text-white' : 'text-slate-700 hover:bg-slate-100' }}"
                                                >
                                                    {{ $child['label'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a
                                        href="{{ $item['href'] }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm transition
                                            {{ $active ? 'bg-slate-500 text-white' : 'text-slate-700 hover:bg-slate-100' }}"
                                    >
                                        <span class="grid h-8 w-8 place-items-center rounded-lg {{ $active ? 'bg-white/10' : 'bg-slate-100' }}">
                                            @php($heroName = $hero((string)($item['icon'] ?? '')))
                                            <x-dynamic-component :component="'heroicon-o-'.$heroName" class="h-4 w-4" />
                                        </span>
                                        <span class="font-medium">{{ $item['label'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </nav>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 border-t bg-white p-4">
                    <div class="flex items-center gap-3">
                        <div class="grid h-10 w-10 place-items-center rounded-full bg-slate-500 text-white">
                            <span class="text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                        </div>
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <div class="truncate text-xs text-slate-500">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main -->
            <div class="lg:pl-72">
                <!-- Topbar -->
                <header class="sticky top-0 z-30 border-b bg-white/80 backdrop-blur">
                    <div class="flex h-16 items-center justify-between px-4 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button
                                class="rounded-xl p-2 hover:bg-slate-100 lg:hidden"
                                @click="sidebarOpen = true"
                                type="button"
                            >
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>

                            <div class="hidden md:block">
                                <div class="text-sm font-semibold">{{ $title }}</div>
                                <div class="text-xs text-slate-500">Admin Dashboard</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="hidden sm:block">
                                <div class="relative">
                                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <input
                                        type="search"
                                        placeholder="Search"
                                        class="w-72 rounded-xl border bg-slate-50 py-2 pl-10 pr-3 text-sm focus:outline-none focus:ring-2 focus:ring-slate-300"
                                    />
                                </div>
                            </div>

                            <button class="rounded-xl p-2 hover:bg-slate-100" type="button" title="Notifications">
                                <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M9 17a3 3 0 0 0 6 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>

                            <div class="relative">
                                <button
                                    class="flex items-center gap-2 rounded-xl p-2 hover:bg-slate-100"
                                    type="button"
                                    @click="profileOpen = !profileOpen"
                                >
                                    <div class="grid h-9 w-9 place-items-center rounded-full bg-slate-500 text-white">
                                        <span class="text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                                    </div>
                                    <div class="hidden text-left sm:block">
                                        <div class="text-sm font-semibold leading-tight">{{ auth()->user()->name ?? 'Admin' }}</div>
                                        <div class="text-xs text-slate-500 leading-tight">Admin</div>
                                    </div>
                                    <svg class="hidden h-4 w-4 text-slate-500 sm:block" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>

                                <div
                                    x-show="profileOpen"
                                    x-transition
                                    @click.outside="profileOpen = false"
                                    class="absolute right-0 mt-2 w-56 rounded-xl border bg-white p-2 shadow-lg"
                                >
                                    <a href="{{ route('admin.profile') }}" class="block rounded-lg px-3 py-2 text-sm hover:bg-slate-50">Profile</a>
                                    <a href="#" class="block rounded-lg px-3 py-2 text-sm hover:bg-slate-50">Settings</a>
                                    <div class="my-2 h-px bg-slate-100"></div>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm text-red-700 hover:bg-red-50">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <main class="px-4 py-6 lg:px-8 lg:py-8">
                    {{ $slot }}
                </main>

                <footer class="border-t bg-white">
                    <div class="px-4 py-4 text-sm text-slate-600 lg:px-8">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                © {{ now()->year }} {{ config('app.name', 'Booking System') }}. All rights reserved.
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-2">
                                <a class="hover:underline" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                <a class="hover:underline" href="{{ route('admin.profile') }}">Profile</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    @endif
</body>
</html>

