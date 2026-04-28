<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        if ($properties->isEmpty()) {
            return;
        }

        $bookings = Booking::query()->orderBy('id')->limit(10)->get();
        $customers = Customer::query()->orderBy('id')->get();

        $faker = fake();

        $seed = [
            ['rating' => 5, 'title' => 'Excellent stay', 'comment' => 'Clean rooms, friendly staff, and great location.', 'is_published' => true],
            ['rating' => 4, 'title' => 'Very good', 'comment' => 'Nice experience overall. Would book again.', 'is_published' => true],
            ['rating' => 3, 'title' => 'Average', 'comment' => 'It was okay. A few small issues but acceptable.', 'is_published' => false],
            ['rating' => 2, 'title' => 'Needs improvement', 'comment' => 'Check-in was slow and the room needed maintenance.', 'is_published' => false],
            ['rating' => 5, 'title' => 'Loved it', 'comment' => 'Amazing service and comfortable beds!', 'is_published' => true],
        ];

        foreach ($seed as $i => $row) {
            $property = $properties[$i % $properties->count()];
            $booking = $bookings->isNotEmpty() ? $bookings[$i % $bookings->count()] : null;
            $customer = $customers->isNotEmpty() ? $customers[$i % $customers->count()] : null;

            Review::query()->updateOrCreate(
                [
                    'property_id' => $property->id,
                    'title' => $row['title'],
                ],
                [
                    'booking_id' => $booking?->id,
                    'customer_id' => $customer?->id,
                    'rating' => $row['rating'],
                    'comment' => $row['comment'],
                    'is_published' => (bool) $row['is_published'],
                    'created_at' => now()->subDays($faker->numberBetween(0, 30)),
                ]
            );
        }
    }
}

