<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();

        $seed = [
            ['first_name' => 'John', 'last_name' => 'Smith', 'email' => 'john.smith@example.com', 'phone' => '+1 702 555 0101', 'country_code' => 'US'],
            ['first_name' => 'Emily', 'last_name' => 'Carter', 'email' => 'emily.carter@example.com', 'phone' => '+1 702 555 0102', 'country_code' => 'US'],
            ['first_name' => 'David', 'last_name' => 'Lee', 'email' => 'david.lee@example.com', 'phone' => '+1 702 555 0103', 'country_code' => 'US'],
            ['first_name' => 'Patricia', 'last_name' => 'Brown', 'email' => 'patricia.brown@example.com', 'phone' => '+1 702 555 0104', 'country_code' => 'US'],
            ['first_name' => 'Lisa', 'last_name' => 'White', 'email' => 'lisa.white@example.com', 'phone' => '+1 702 555 0105', 'country_code' => 'US'],
            ['first_name' => 'Sok', 'last_name' => 'Dara', 'email' => 'sok.dara@example.com', 'phone' => '+855 23 555 0106', 'country_code' => 'KH'],
            ['first_name' => 'Srey', 'last_name' => 'Neang', 'email' => 'srey.neang@example.com', 'phone' => '+855 23 555 0107', 'country_code' => 'KH'],
            ['first_name' => 'Somchai', 'last_name' => 'Wong', 'email' => 'somchai.wong@example.com', 'phone' => '+66 2 555 0108', 'country_code' => 'TH'],
            ['first_name' => 'Araya', 'last_name' => 'Siri', 'email' => 'araya.siri@example.com', 'phone' => '+66 2 555 0109', 'country_code' => 'TH'],
            ['first_name' => 'Narin', 'last_name' => 'Kitt', 'email' => 'narin.kitt@example.com', 'phone' => '+66 2 555 0110', 'country_code' => 'TH'],
        ];

        foreach ($seed as $row) {
            Customer::query()->updateOrCreate(
                ['email' => $row['email']],
                [
                    ...$row,
                    'date_of_birth' => $faker->dateTimeBetween('-55 years', '-18 years')->format('Y-m-d'),
                    'id_number' => strtoupper($faker->bothify('??######')),
                    'notes' => $faker->boolean(40) ? $faker->sentence() : null,
                ]
            );
        }
    }
}

