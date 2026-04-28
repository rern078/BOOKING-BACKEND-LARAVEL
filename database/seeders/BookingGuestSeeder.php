<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BookingGuest;
use Illuminate\Database\Seeder;

class BookingGuestSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::query()->orderBy('id')->limit(10)->get();
        if ($bookings->isEmpty()) {
            return;
        }

        $faker = fake();

        // Create 1 guest per booking (10 guests total).
        foreach ($bookings as $booking) {
            BookingGuest::query()->updateOrCreate(
                [
                    'booking_id' => $booking->id,
                    'is_primary' => true,
                ],
                [
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'email' => $faker->boolean(70) ? $faker->unique()->safeEmail() : null,
                    'phone' => $faker->boolean(70) ? $faker->phoneNumber() : null,
                ]
            );
        }
    }
}

