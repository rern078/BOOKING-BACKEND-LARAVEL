<x-admin-layout :title="'Profile'">
    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold">Profile</h1>
                <p class="mt-1 text-sm text-slate-600">Manage your admin account details.</p>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-900">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-900">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-6 lg:grid-cols-12">
                <!-- Profile Image -->
                <div class="lg:col-span-12">
                    <div class="text-sm font-semibold">Profile Image <span class="text-red-600">*</span></div>
                    <div class="mt-3 flex items-center gap-4">
                        @php
                            $avatarUrl = $user->avatar_path ? asset('storage/'.$user->avatar_path) : null;
                            $initial = strtoupper(substr($user->name ?? 'A', 0, 1));
                        @endphp
                        <div class="relative">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="Avatar" class="h-16 w-16 rounded-full object-cover ring-2 ring-slate-200">
                            @else
                                <div class="grid h-16 w-16 place-items-center rounded-full bg-slate-500 text-white ring-2 ring-slate-200">
                                    <span class="text-lg font-semibold">{{ $initial }}</span>
                                </div>
                            @endif
                            <label class="absolute -bottom-1 -right-1 grid h-7 w-7 cursor-pointer place-items-center rounded-full bg-white shadow ring-1 ring-slate-200">
                                <input type="file" name="avatar" class="hidden" accept="image/*">
                                <svg class="h-4 w-4 text-slate-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 5h7v7M19 5 10 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M5 7v12h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </label>
                        </div>
                        <div class="text-sm text-slate-600">
                            Click the icon to upload a new photo (max 2MB).
                        </div>
                    </div>
                </div>

                <!-- Basic info -->
                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">First Name <span class="text-red-600">*</span></label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="first_name"
                        value="{{ old('first_name', $user->first_name) }}"
                        placeholder="First name"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Last Name <span class="text-red-600">*</span></label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="last_name"
                        value="{{ old('last_name', $user->last_name) }}"
                        placeholder="Last name"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Email <span class="text-red-600">*</span></label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="email"
                        type="email"
                        required
                        value="{{ old('email', $user->email) }}"
                        placeholder="Email"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Phone Number <span class="text-red-600">*</span></label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="Phone number"
                    />
                </div>

                <!-- Address -->
                <div class="lg:col-span-12">
                    <div class="mt-2 text-sm font-semibold">Address Information</div>
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Address Line 1</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="address_line1"
                        value="{{ old('address_line1', $user->address_line1) }}"
                        placeholder="Address line 1"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Address Line 2</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="address_line2"
                        value="{{ old('address_line2', $user->address_line2) }}"
                        placeholder="Address line 2"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Country</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="country"
                        value="{{ old('country', $user->country) }}"
                        placeholder="Country"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">State</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="state"
                        value="{{ old('state', $user->state) }}"
                        placeholder="State"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">City</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="city"
                        value="{{ old('city', $user->city) }}"
                        placeholder="City"
                    />
                </div>

                <div class="lg:col-span-6">
                    <label class="text-sm font-medium">Pincode</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="postal_code"
                        value="{{ old('postal_code', $user->postal_code) }}"
                        placeholder="Pincode"
                    />
                </div>

                <!-- Password -->
                <div class="lg:col-span-12">
                    <div class="mt-2 text-sm font-semibold">Change Password</div>
                </div>

                <div class="lg:col-span-4">
                    <label class="text-sm font-medium">Current Password</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        placeholder="Current password"
                    />
                </div>

                <div class="lg:col-span-4">
                    <label class="text-sm font-medium">New Password</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="new_password"
                        type="password"
                        autocomplete="new-password"
                        placeholder="New password"
                    />
                </div>

                <div class="lg:col-span-4">
                    <label class="text-sm font-medium">Confirm Password</label>
                    <input
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                        name="new_password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        placeholder="Confirm password"
                    />
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t pt-5">
                <a href="{{ route('admin.dashboard') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-medium hover:bg-slate-50">
                    Cancel
                </a>
                <button class="rounded-xl bg-slate-500 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600" type="submit">
                    Save Change
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

