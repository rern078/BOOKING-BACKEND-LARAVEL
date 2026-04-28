<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Coupon;
use Illuminate\Database\Seeder;

class BookingCouponSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::query()->orderBy('id')->limit(10)->get();
        $coupons = Coupon::query()->orderBy('id')->get();

        if ($bookings->isEmpty() || $coupons->isEmpty()) {
            return;
        }

        $faker = fake();

        foreach ($bookings as $booking) {
            // Attach 0-2 coupons per booking.
            $count = $faker->numberBetween(0, 2);
            $ids = $coupons->random(min($count, $coupons->count()))->pluck('id')->all();
            $booking->coupons()->syncWithoutDetaching($ids);
        }
    }
}

