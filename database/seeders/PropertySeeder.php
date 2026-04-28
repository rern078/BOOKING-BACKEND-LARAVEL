<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
  public function run(): void
  {
    $faker = fake();
    Property::query()->updateOrCreate(
      ['slug' => 'trustcare-lasvegas'],
      [
        'name' => 'Trustcare Clinic',
        'description' => 'Main branch for appointments and admin operations.',
        'email' => 'trustcare@example.com',
        'phone' => '+1 702 555 0199',
        'address_line1' => '123 Main Street',
        'city' => 'Las Vegas',
        'state' => 'NV',
        'postal_code' => '89101',
        'country_code' => 'US',
        'latitude' => 36.1699412,
        'longitude' => -115.1398296,
        'timezone' => 'America/Los_Angeles',
        'is_active' => true,
      ]
    );

    Property::query()->updateOrCreate(
      ['slug' => 'chamrern-cambodia'],
      [
        'name' => 'Chamrern Booking (Cambodia)',
        'description' => 'Sample property for Cambodia.',
        'email' => 'cambodia@example.com',
        'phone' => '+855 23 000 000',
        'address_line1' => 'No. 1, Riverside',
        'city' => 'Cambodia',
        'state' => 'Cambodia',
        'postal_code' => '10110',
        'country_code' => 'KH',
        'latitude' => 13.7563309,
        'longitude' => 100.5017651,
        'timezone' => 'Asia/Phnom_Penh',
        'is_active' => true,
      ]
    );

    Property::query()->updateOrCreate(
      ['slug' => 'demo-phnom-penh'],
      [
        'name' => 'Demo Property (Phnom Penh)',
        'description' => 'Sample property for Cambodia.',
        'email' => 'phnompenh@example.com',
        'phone' => '+855 23 000 000',
        'address_line1' => 'No. 1, Riverside',
        'city' => 'Phnom Penh',
        'state' => 'Phnom Penh',
        'postal_code' => '12000',
        'country_code' => 'KH',
        'latitude' => 11.5563738,
        'longitude' => 104.9282099,
        'timezone' => 'Asia/Phnom_Penh',
        'is_active' => true,
      ]
    );

    // Add more sample properties (total 10).
    $rows = [
      ['name' => 'Singapore Central', 'city' => 'Singapore', 'state' => 'Singapore', 'postal_code' => '238801', 'country_code' => 'SG', 'timezone' => 'Asia/Singapore', 'lat' => 1.290270, 'lng' => 103.851959],
      ['name' => 'Kuala Lumpur Hub', 'city' => 'Kuala Lumpur', 'state' => 'Kuala Lumpur', 'postal_code' => '50000', 'country_code' => 'MY', 'timezone' => 'Asia/Kuala_Lumpur', 'lat' => 3.139003, 'lng' => 101.686855],
      ['name' => 'Hanoi Old Quarter', 'city' => 'Hanoi', 'state' => 'Hanoi', 'postal_code' => '100000', 'country_code' => 'VN', 'timezone' => 'Asia/Ho_Chi_Minh', 'lat' => 21.027763, 'lng' => 105.834160],
      ['name' => 'Chiang Mai Riverside', 'city' => 'Chiang Mai', 'state' => 'Chiang Mai', 'postal_code' => '50000', 'country_code' => 'TH', 'timezone' => 'Asia/Bangkok', 'lat' => 18.788343, 'lng' => 98.985300],
      ['name' => 'Vientiane Center', 'city' => 'Vientiane', 'state' => 'Vientiane', 'postal_code' => '01000', 'country_code' => 'LA', 'timezone' => 'Asia/Vientiane', 'lat' => 17.975706, 'lng' => 102.633104],
      ['name' => 'Jakarta Downtown', 'city' => 'Jakarta', 'state' => 'Jakarta', 'postal_code' => '10110', 'country_code' => 'ID', 'timezone' => 'Asia/Jakarta', 'lat' => -6.208763, 'lng' => 106.845599],
      ['name' => 'Manila Bay View', 'city' => 'Manila', 'state' => 'Metro Manila', 'postal_code' => '1000', 'country_code' => 'PH', 'timezone' => 'Asia/Manila', 'lat' => 14.599512, 'lng' => 120.984220],
    ];

    foreach ($rows as $row) {
      $slug = Str::slug($row['name']);

      Property::query()->updateOrCreate(
        ['slug' => $slug],
        [
          'name' => $row['name'],
          'description' => $faker->sentence(),
          'email' => Str::slug($row['city']) . '@example.com',
          'phone' => $faker->phoneNumber(),
          'address_line1' => $faker->streetAddress(),
          'city' => $row['city'],
          'state' => $row['state'],
          'postal_code' => $row['postal_code'],
          'country_code' => $row['country_code'],
          'latitude' => $row['lat'],
          'longitude' => $row['lng'],
          'timezone' => $row['timezone'],
          'is_active' => true,
        ]
      );
    }
  }
}
