<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $bookingsCount = Booking::query()->count();
        $customersCount = Customer::query()->count();
        $roomsCount = Room::query()->count();
        $propertiesCount = Property::query()->count();

        $revenue = (float) Payment::query()
            ->whereIn('status', ['captured', 'paid', 'succeeded'])
            ->sum('amount');

        $revenueCurrency = Payment::query()
            ->whereIn('status', ['captured', 'paid', 'succeeded'])
            ->whereNotNull('currency')
            ->value('currency') ?? 'USD';

        $latestBookings = Booking::query()
            ->with(['property', 'customer'])
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $start = Carbon::today()->subDays(6)->startOfDay();
        $labels = collect(range(0, 6))
            ->map(fn ($i) => Carbon::today()->subDays(6 - $i)->format('M j'))
            ->values();

        $bookingCountsByDate = Booking::query()
            ->where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as d, COUNT(*)::int as c')
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('c', 'd');

        $revenueByDate = Payment::query()
            ->where('created_at', '>=', $start)
            ->whereIn('status', ['captured', 'paid', 'succeeded'])
            ->selectRaw('DATE(created_at) as d, COALESCE(SUM(amount), 0) as s')
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('s', 'd');

        $chartDates = collect(range(0, 6))
            ->map(fn ($i) => Carbon::today()->subDays(6 - $i)->toDateString())
            ->values();

        $bookingSeries = $chartDates->map(fn ($d) => (int) ($bookingCountsByDate[$d] ?? 0))->values();
        $revenueSeries = $chartDates->map(fn ($d) => (float) ($revenueByDate[$d] ?? 0))->values();

        return view('admin.dashboard', [
            'user' => $request->user(),
            'bookingsCount' => $bookingsCount,
            'customersCount' => $customersCount,
            'roomsCount' => $roomsCount,
            'propertiesCount' => $propertiesCount,
            'revenue' => $revenue,
            'revenueCurrency' => $revenueCurrency,
            'latestBookings' => $latestBookings,
            'chartLabels' => $labels,
            'chartBookings' => $bookingSeries,
            'chartRevenue' => $revenueSeries,
        ]);
    }
}

