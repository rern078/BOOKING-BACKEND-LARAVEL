<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\RatePlan;
use Illuminate\Database\Seeder;

class RatePlanSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        if ($properties->isEmpty()) {
            return;
        }

        $templates = [
            ['name' => 'Standard Rate', 'code' => 'STD', 'is_refundable' => true],
            ['name' => 'Non‑Refundable', 'code' => 'NR', 'is_refundable' => false],
            ['name' => 'Weekly Saver', 'code' => 'WEEK', 'is_refundable' => true],
            ['name' => 'Advance Purchase', 'code' => 'ADV', 'is_refundable' => false],
        ];

        foreach ($properties as $p) {
            foreach ($templates as $t) {
                RatePlan::query()->updateOrCreate(
                    ['property_id' => $p->id, 'code' => $t['code']],
                    [
                        'name' => $t['name'],
                        'description' => $t['name'].' (sample).',
                        'is_refundable' => $t['is_refundable'],
                        'min_nights' => 1,
                        'max_nights' => null,
                        'cancellation_hours' => $t['is_refundable'] ? 24 : null,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}

