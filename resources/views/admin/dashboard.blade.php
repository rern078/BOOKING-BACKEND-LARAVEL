<x-admin-layout :title="'Dashboard'">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
            <p class="mt-1 text-sm text-slate-600">Welcome back, {{ $user?->name }}.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a class="rounded-xl bg-slate-500 px-4 py-2 text-sm font-medium text-white hover:bg-slate-600" href="{{ route('admin.bookings.create') }}">
                + New Booking
            </a>
        </div>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="relative overflow-hidden rounded-2xl border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-indigo-50 text-indigo-700">
                    <x-heroicon-o-calendar-days class="h-5 w-5" />
                </div>
            </div>
            <div class="mt-4 text-sm text-slate-500">Bookings</div>
            <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $bookingsCount) }}</div>
            <div class="mt-3 h-10 w-full rounded-lg bg-gradient-to-r from-indigo-50 to-white"></div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-rose-50 text-rose-700">
                    <x-heroicon-o-users class="h-5 w-5" />
                </div>
            </div>
            <div class="mt-4 text-sm text-slate-500">Customers</div>
            <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $customersCount) }}</div>
            <div class="mt-3 h-10 w-full rounded-lg bg-gradient-to-r from-rose-50 to-white"></div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-sky-50 text-sky-700">
                    <x-heroicon-o-key class="h-5 w-5" />
                </div>
            </div>
            <div class="mt-4 text-sm text-slate-500">Rooms</div>
            <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $roomsCount) }}</div>
            <div class="mt-3 h-10 w-full rounded-lg bg-gradient-to-r from-sky-50 to-white"></div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-emerald-50 text-emerald-700">
                    <x-heroicon-o-credit-card class="h-5 w-5" />
                </div>
            </div>
            <div class="mt-4 text-sm text-slate-500">Revenue</div>
            <div class="mt-1 text-2xl font-semibold">{{ $revenueCurrency }} {{ number_format((float) $revenue, 2) }}</div>
            <div class="mt-3 h-10 w-full rounded-lg bg-gradient-to-r from-emerald-50 to-white"></div>
        </div>
    </div>

    <div class="mt-6 grid gap-4 xl:grid-cols-12">
        <div class="rounded-2xl border bg-white p-5 shadow-sm xl:col-span-8">
            <div class="flex items-center justify-between">
                <div class="font-semibold">Bookings & revenue (last 7 days)</div>
                <a class="rounded-xl border bg-white px-3 py-1.5 text-xs font-medium hover:bg-slate-50" href="{{ route('admin.payments.index') }}">Payments</a>
            </div>

            <div class="mt-4 grid gap-4 lg:grid-cols-2">
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Bookings</div>
                    <div class="mt-3">
                        <canvas id="bookingsChart" height="140"></canvas>
                    </div>
                </div>
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Revenue ({{ $revenueCurrency }})</div>
                    <div class="mt-3">
                        <canvas id="revenueChart" height="140"></canvas>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="font-semibold">Latest bookings</div>
                <a class="rounded-xl border bg-white px-3 py-1.5 text-xs font-medium hover:bg-slate-50" href="{{ route('admin.bookings.index') }}">View all</a>
            </div>
            <div class="mt-4 overflow-x-auto rounded-2xl border">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Ref</th>
                            <th class="px-4 py-3">Property</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Dates</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y bg-white">
                        @forelse ($latestBookings as $b)
                            <tr class="hover:bg-slate-50/60">
                                <td class="px-4 py-3 font-semibold">{{ $b->reference }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $b->property?->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $b->customer?->full_name ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-600">
                                    {{ optional($b->check_in_date)->format('Y-m-d') }} → {{ optional($b->check_out_date)->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $b->status }}</span>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold">{{ $b->currency }} {{ number_format((float) $b->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-8 text-center text-slate-600" colspan="6">No bookings yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border bg-white p-5 shadow-sm xl:col-span-4">
            <div class="flex items-center justify-between">
                <div class="font-semibold">System</div>
                <a class="rounded-xl border bg-white px-3 py-1.5 text-xs font-medium hover:bg-slate-50" href="{{ route('admin.properties.index') }}">Properties</a>
            </div>

            @php
                $today = \Carbon\Carbon::today();
                $monthStart = $today->copy()->startOfMonth();
                $monthEnd = $today->copy()->endOfMonth();
                $firstDayOfWeekIndex = (int) $monthStart->dayOfWeek; // 0=Sun..6=Sat
                $daysInMonth = (int) $monthStart->daysInMonth;
                $cells = (int) (ceil(($firstDayOfWeekIndex + $daysInMonth) / 7) * 7);
            @endphp

            <div class="mt-4 rounded-2xl border bg-slate-50 p-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold">{{ $today->format('F Y') }}</div>
                    <div class="text-xs text-slate-500">{{ $monthStart->format('M j') }} – {{ $monthEnd->format('M j') }}</div>
                </div>

                <div class="mt-3 grid grid-cols-7 gap-2 text-center text-xs text-slate-500">
                    @foreach (['Su','Mo','Tu','We','Th','Fr','Sa'] as $d)
                        <div class="font-semibold">{{ $d }}</div>
                    @endforeach

                    @for ($i = 0; $i < $cells; $i++)
                        @php
                            $dayNumber = $i - $firstDayOfWeekIndex + 1;
                            $isInMonth = $dayNumber >= 1 && $dayNumber <= $daysInMonth;
                            $isToday = $isInMonth && $dayNumber === (int) $today->day;
                        @endphp

                        <div class="rounded-lg px-2 py-1 {{ $isToday ? 'bg-slate-500 text-white' : ($isInMonth ? 'bg-white text-slate-700' : 'bg-transparent text-slate-400') }}">
                            {{ $isInMonth ? $dayNumber : '' }}
                        </div>
                    @endfor
                </div>
            </div>

            <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Properties</div>
                    <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $propertiesCount) }}</div>
                </div>
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Rooms</div>
                    <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $roomsCount) }}</div>
                </div>
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Customers</div>
                    <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $customersCount) }}</div>
                </div>
                <div class="rounded-2xl border bg-slate-50 p-4">
                    <div class="text-xs font-semibold text-slate-500">Bookings</div>
                    <div class="mt-1 text-2xl font-semibold">{{ number_format((int) $bookingsCount) }}</div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/json" id="dashboardChartData">
        {!! json_encode([
            'labels' => $chartLabels ?? [],
            'bookings' => $chartBookings ?? [],
            'revenue' => $chartRevenue ?? [],
        ]) !!}
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const dataEl = document.getElementById('dashboardChartData');
            let parsed = {};
            try {
                parsed = dataEl ? JSON.parse(dataEl.textContent || '{}') : {};
            } catch (e) {
                console.error('Dashboard chart JSON parse failed', e);
                parsed = {};
            }
            const labels = Array.isArray(parsed.labels) ? parsed.labels : [];
            const bookings = Array.isArray(parsed.bookings) ? parsed.bookings : [];
            const revenue = Array.isArray(parsed.revenue) ? parsed.revenue : [];

            const bookingsEl = document.getElementById('bookingsChart');
            const revenueEl = document.getElementById('revenueChart');
            if (!bookingsEl || !revenueEl || !window.Chart) return;

            const baseOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { intersect: false, mode: 'index' }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: 'rgba(15, 23, 42, 0.06)' }, ticks: { precision: 0 } }
                }
            };

            new Chart(bookingsEl, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        data: bookings,
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.12)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 2,
                        pointHoverRadius: 4
                    }]
                },
                options: baseOptions
            });

            new Chart(revenueEl, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        data: revenue,
                        backgroundColor: 'rgba(16, 185, 129, 0.30)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        borderRadius: 10
                    }]
                },
                options: baseOptions
            });
        })();
    </script>
</x-admin-layout>

