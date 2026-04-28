<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::query()->orderBy('id')->limit(10)->get();
        if ($bookings->isEmpty()) {
            return;
        }

        $faker = fake();
        $providers = ['stripe', 'paypal', 'cash', 'bank_transfer'];
        $methods = ['card', 'bank', 'cash'];
        $statuses = ['pending', 'captured', 'failed', 'refunded', 'succeeded'];

        foreach ($bookings as $i => $booking) {
            $idx = $i + 1;
            $status = $statuses[$i % count($statuses)];
            $amount = (float) $booking->total;

            Payment::query()->updateOrCreate(
                ['transaction_reference' => 'TX-'.str_pad((string) $idx, 8, '0', STR_PAD_LEFT)],
                [
                    'booking_id' => $booking->id,
                    'provider' => $providers[$i % count($providers)],
                    'method' => $methods[$i % count($methods)],
                    'status' => $status,
                    'currency' => $booking->currency ?? 'USD',
                    'amount' => $amount,
                    'meta' => [
                        'note' => 'Sample payment',
                    ],
                    'paid_at' => in_array($status, ['captured', 'succeeded'], true) ? now()->subDays($faker->numberBetween(0, 7)) : null,
                ]
            );
        }
    }
}

