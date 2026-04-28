<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        if ($properties->isEmpty()) {
            return;
        }

        $templates = [
            ['name' => 'Standard', 'code' => 'STD', 'max_adults' => 2, 'max_children' => 1, 'max_occupancy' => 3, 'base_price' => 45, 'currency' => 'USD'],
            ['name' => 'Deluxe', 'code' => 'DLX', 'max_adults' => 2, 'max_children' => 2, 'max_occupancy' => 4, 'base_price' => 65, 'currency' => 'USD'],
            ['name' => 'Suite', 'code' => 'STE', 'max_adults' => 3, 'max_children' => 2, 'max_occupancy' => 5, 'base_price' => 95, 'currency' => 'USD'],
            ['name' => 'Family', 'code' => 'FAM', 'max_adults' => 4, 'max_children' => 2, 'max_occupancy' => 6, 'base_price' => 110, 'currency' => 'USD'],
        ];

        $count = 0;
        foreach ($properties as $p) {
            foreach ($templates as $t) {
                if ($count >= 10) {
                    break 2;
                }

                $code = $t['code'];
                RoomType::query()->updateOrCreate(
                    ['property_id' => $p->id, 'code' => $code],
                    [
                        'name' => $t['name'].' - '.$p->city,
                        'description' => $t['name'].' room type (sample).',
                        'max_adults' => $t['max_adults'],
                        'max_children' => $t['max_children'],
                        'max_occupancy' => $t['max_occupancy'],
                        'base_price' => $t['base_price'] + ($p->id * 3),
                        'currency' => $t['currency'],
                        'is_active' => true,
                    ]
                );

                $count++;
            }
        }
    }
}

