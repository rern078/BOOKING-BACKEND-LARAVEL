<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <header class="border-b bg-white">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
                <div class="font-semibold">
                    <a href="{{ route('admin.dashboard') }}">Booking Admin</a>
                </div>
                <div class="text-sm text-slate-600">
                    @auth
                        <span class="mr-3">{{ auth()->user()->email }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button class="rounded-md border px-3 py-1 hover:bg-slate-50" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="hover:underline" href="{{ route('admin.login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-4 py-10">
            {{ $slot }}
        </main>
    </div>
</body>
</html>

