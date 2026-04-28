<x-admin-layout :title="'Admin Register'" variant="auth">
    <div class="mx-auto max-w-md overflow-hidden rounded-2xl border bg-white shadow-sm">
        <div class="border-b bg-slate-50 px-6 py-5">
            <h1 class="text-xl font-semibold">Create admin account</h1>
            <p class="mt-1 text-sm text-slate-600">Register, then you’ll be redirected to the dashboard.</p>
        </div>

        @if ($errors->any())
            <div class="mx-6 mt-6 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="px-6 pb-6 pt-6 space-y-4" method="POST" action="{{ route('admin.register.submit') }}">
            @csrf

            <div>
                <label class="text-sm font-medium" for="name">Name</label>
                <input
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                />
            </div>

            <div>
                <label class="text-sm font-medium" for="email">Email</label>
                <input
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                />
            </div>

            <div>
                <label class="text-sm font-medium" for="password">Password</label>
                <input
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div>
                <label class="text-sm font-medium" for="password_confirmation">Confirm password</label>
                <input
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                />
            </div>

            <button class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800" type="submit">
                Register
            </button>
        </form>

        <div class="border-t bg-white px-6 py-4 text-sm text-slate-600">
            Already have an account?
            <a class="font-semibold text-slate-900 hover:underline" href="{{ route('admin.login') }}">Login</a>
        </div>
    </div>
</x-admin-layout>

