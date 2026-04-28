<?php

namespace Database\Seeders;

use App\Models\RatePlan;
use App\Models\RoomType;
use App\Models\RoomTypeRate;
use Illuminate\Database\Seeder;

class RoomTypeRateSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = RoomType::query()->orderBy('id')->get();
        $ratePlans = RatePlan::query()->orderBy('id')->get();

        if ($roomTypes->isEmpty() || $ratePlans->isEmpty()) {
            return;
        }

        $faker = fake();

        for ($i = 1; $i <= 10; $i++) {
            $roomType = $roomTypes[($i - 1) % $roomTypes->count()];
            $ratePlan = $ratePlans[($i - 1) % $ratePlans->count()];

            $start = now()->startOfDay()->addDays($faker->numberBetween(-5, 10));
            $end = $start->copy()->addDays($faker->numberBetween(1, 7));
            $price = (float) $faker->numberBetween(35, 160);

            RoomTypeRate::query()->updateOrCreate(
                [
                    'room_type_id' => $roomType->id,
                    'rate_plan_id' => $ratePlan->id,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                ],
                [
                    'price' => $price,
                    'currency' => $roomType->currency ?? 'USD',
                    'inventory_override' => $faker->boolean(30) ? $faker->numberBetween(1, 10) : null,
                ]
            );
        }
    }
}

