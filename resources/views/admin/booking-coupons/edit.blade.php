<x-admin-layout :title="'Manage Booking Coupons'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="text-lg font-semibold">Manage Coupons</div>
                <div class="text-sm text-slate-600">
                    Booking: <span class="font-semibold">{{ $booking->reference ?? ('#'.$booking->id) }}</span>
                    <span class="text-slate-400">·</span>
                    {{ $booking->property?->name }}
                </div>
            </div>
            <a href="{{ route('admin.booking-coupons.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                Back
            </a>
        </div>

        <form class="mt-6" method="POST" action="{{ route('admin.booking-coupons.update', $booking) }}">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border">
                <div class="border-b p-4">
                    <div class="text-sm font-semibold">Select coupons</div>
                    <div class="text-xs text-slate-500">Only active coupons are listed.</div>
                </div>

                <div class="grid gap-3 p-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($coupons as $c)
                        <label class="flex items-start gap-3 rounded-2xl border bg-white p-4 hover:bg-slate-50">
                            <input
                                type="checkbox"
                                class="mt-1 rounded border"
                                name="coupon_ids[]"
                                value="{{ $c->id }}"
                                {{ in_array($c->id, old('coupon_ids', $booking->coupons->pluck('id')->all())) ? 'checked' : '' }}
                            >
                            <div class="min-w-0">
                                <div class="font-semibold">{{ $c->code }}</div>
                                <div class="text-xs text-slate-600">
                                    {{ $c->type }} · {{ $c->type === 'percent' ? rtrim(rtrim(number_format((float)$c->value, 2), '0'), '.') . '%' : number_format((float)$c->value, 2) }}
                                </div>
                                <div class="text-xs text-slate-500">{{ $c->name }}</div>
                            </div>
                        </label>
                    @empty
                        <div class="text-sm text-slate-600">No active coupons.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2 border-t pt-5">
                <a href="{{ route('admin.booking-coupons.index') }}" class="rounded-xl border bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    Cancel
                </a>
                <button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

