<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Database\Seeder;

class RefundSeeder extends Seeder
{
    public function run(): void
    {
        $payments = Payment::query()->orderBy('id')->limit(10)->get();
        if ($payments->isEmpty()) {
            return;
        }

        $faker = fake();
        $statuses = ['pending', 'succeeded', 'failed'];

        for ($i = 1; $i <= 5; $i++) {
            $payment = $payments[($i - 1) % $payments->count()];
            $status = $statuses[($i - 1) % count($statuses)];

            Refund::query()->updateOrCreate(
                ['reference' => 'RF-'.str_pad((string) $i, 6, '0', STR_PAD_LEFT)],
                [
                    'payment_id' => $payment->id,
                    'currency' => $payment->currency ?? 'USD',
                    'amount' => min((float) $payment->amount, (float) $faker->numberBetween(5, 80)),
                    'status' => $status,
                    'meta' => [
                        'notes' => 'Sample refund',
                    ],
                    'refunded_at' => $status === 'succeeded' ? now()->subDays($faker->numberBetween(0, 14)) : null,
                ]
            );
        }
    }
}

