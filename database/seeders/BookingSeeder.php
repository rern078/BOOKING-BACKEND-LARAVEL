<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        $customers = Customer::query()->orderBy('id')->get();

        if ($properties->isEmpty() || $customers->isEmpty()) {
            return;
        }

        $faker = fake();
        $statuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];

        for ($i = 1; $i <= 10; $i++) {
            $property = $properties[($i - 1) % $properties->count()];
            $customer = $customers[($i - 1) % $customers->count()];

            $checkIn = now()->addDays($faker->numberBetween(-10, 20))->startOfDay();
            $nights = $faker->numberBetween(1, 5);
            $checkOut = $checkIn->copy()->addDays($nights);

            $currency = 'USD';
            $total = (float) ($faker->numberBetween(40, 180) * $nights);

            $reference = 'BK-'.str_pad((string) $i, 6, '0', STR_PAD_LEFT);

            Booking::query()->updateOrCreate(
                ['reference' => $reference],
                [
                    'property_id' => $property->id,
                    'customer_id' => $customer->id,
                    'created_by_user_id' => null,
                    'status' => $statuses[($i - 1) % count($statuses)],
                    'check_in_date' => $checkIn->toDateString(),
                    'check_out_date' => $checkOut->toDateString(),
                    'adults' => $faker->numberBetween(1, 3),
                    'children' => $faker->numberBetween(0, 2),
                    'rooms_count' => 1,
                    'currency' => $currency,
                    'subtotal' => $total,
                    'discount_total' => 0,
                    'tax_total' => 0,
                    'total' => $total,
                    'source' => 'admin',
                    'special_requests' => $faker->boolean(30) ? $faker->sentence() : null,
                    'internal_notes' => $faker->boolean(20) ? $faker->sentence() : null,
                    'confirmed_at' => null,
                    'cancelled_at' => null,
                ]
            );
        }
    }
}

