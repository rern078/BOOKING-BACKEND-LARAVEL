<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Property;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        if ($properties->isEmpty()) {
            return;
        }

        $faker = fake();

        $rows = [
            ['code' => 'SAVE10', 'type' => 'percent', 'value' => 10, 'name' => 'Save 10%'],
            ['code' => 'WELCOME5', 'type' => 'fixed', 'value' => 5, 'name' => 'Welcome $5'],
            ['code' => 'SPRING15', 'type' => 'percent', 'value' => 15, 'name' => 'Spring 15%'],
            ['code' => 'VIP20', 'type' => 'percent', 'value' => 20, 'name' => 'VIP 20%'],
            ['code' => 'FLASH8', 'type' => 'fixed', 'value' => 8, 'name' => 'Flash $8'],
            ['code' => 'WEEKEND12', 'type' => 'percent', 'value' => 12, 'name' => 'Weekend 12%'],
            ['code' => 'FAMILY6', 'type' => 'fixed', 'value' => 6, 'name' => 'Family $6'],
            ['code' => 'EARLYBIRD7', 'type' => 'fixed', 'value' => 7, 'name' => 'Early bird $7'],
            ['code' => 'ROOMUPGRADE9', 'type' => 'fixed', 'value' => 9, 'name' => 'Room upgrade $9'],
            ['code' => 'HOLIDAY18', 'type' => 'percent', 'value' => 18, 'name' => 'Holiday 18%'],
        ];

        foreach ($rows as $i => $row) {
            $property = $properties[$i % $properties->count()];

            Coupon::query()->updateOrCreate(
                ['code' => $row['code']],
                [
                    'property_id' => $faker->boolean(60) ? $property->id : null,
                    'name' => $row['name'],
                    'type' => $row['type'],
                    'value' => $row['value'],
                    'min_total' => $faker->boolean(50) ? $faker->numberBetween(20, 120) : null,
                    'max_redemptions' => $faker->boolean(40) ? $faker->numberBetween(10, 200) : null,
                    'times_redeemed' => $faker->numberBetween(0, 8),
                    'starts_at' => $faker->boolean(60) ? now()->subDays($faker->numberBetween(1, 20)) : null,
                    'ends_at' => $faker->boolean(60) ? now()->addDays($faker->numberBetween(5, 45)) : null,
                    'is_active' => $faker->boolean(85),
                ]
            );
        }
    }
}

