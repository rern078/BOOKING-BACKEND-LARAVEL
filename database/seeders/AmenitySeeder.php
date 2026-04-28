<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Wi‑Fi', 'icon' => 'wifi'],
            ['name' => 'Parking', 'icon' => 'parking'],
            ['name' => 'Air conditioning', 'icon' => 'ac'],
            ['name' => 'Breakfast', 'icon' => 'breakfast'],
            ['name' => 'Pool', 'icon' => 'pool'],
            ['name' => 'Gym', 'icon' => 'gym'],
            ['name' => 'Spa', 'icon' => 'spa'],
            ['name' => 'Airport shuttle', 'icon' => 'shuttle'],
            ['name' => 'Pet friendly', 'icon' => 'pet'],
            ['name' => 'Room service', 'icon' => 'room-service'],
        ];

        foreach ($items as $row) {
            Amenity::query()->updateOrCreate(
                ['name' => $row['name']],
                ['icon' => $row['icon']]
            );
        }
    }
}

