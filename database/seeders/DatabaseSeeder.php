<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
            ]
        );

        $this->call([
            PropertySeeder::class,
            CustomerSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            BookingSeeder::class,
            CouponSeeder::class,
            BookingGuestSeeder::class,
            BookingCouponSeeder::class,
            InvoiceSeeder::class,
            PaymentSeeder::class,
            RefundSeeder::class,
            ReviewSeeder::class,
            AmenitySeeder::class,
            RatePlanSeeder::class,
            RoomTypeRateSeeder::class,
        ]);
    }
}
