<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::query()->orderBy('id')->limit(10)->get();
        if ($bookings->isEmpty()) {
            return;
        }

        $faker = fake();
        $statuses = ['draft', 'issued', 'paid', 'void'];

        foreach ($bookings as $i => $booking) {
            $idx = $i + 1;
            $number = 'INV-'.str_pad((string) $idx, 6, '0', STR_PAD_LEFT);

            $subtotal = (float) ($booking->subtotal ?? $booking->total ?? 0);
            $tax = $faker->boolean(60) ? round($subtotal * 0.07, 2) : 0.0;
            $total = $subtotal + $tax;

            $status = $statuses[$i % count($statuses)];
            $issuedAt = in_array($status, ['issued', 'paid'], true) ? now()->subDays($faker->numberBetween(1, 14)) : null;
            $dueAt = $issuedAt ? $issuedAt->copy()->addDays(7) : null;

            Invoice::query()->updateOrCreate(
                ['number' => $number],
                [
                    'booking_id' => $booking->id,
                    'currency' => $booking->currency ?? 'USD',
                    'subtotal' => $subtotal,
                    'tax_total' => $tax,
                    'total' => $total,
                    'issued_at' => $issuedAt,
                    'due_at' => $dueAt,
                    'status' => $status,
                    'pdf_url' => $faker->boolean(30) ? 'https://example.com/invoices/'.$number.'.pdf' : null,
                ]
            );
        }
    }
}

