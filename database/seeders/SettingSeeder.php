<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'key' => 'site.name',
                'group' => 'site',
                'type' => 'string',
                'description' => 'Public site name',
                'value' => ['value' => 'Chamrern Booking'],
            ],
            [
                'key' => 'site.support_email',
                'group' => 'site',
                'type' => 'string',
                'description' => 'Support contact email',
                'value' => ['value' => 'support@example.com'],
            ],
            [
                'key' => 'booking.default_currency',
                'group' => 'booking',
                'type' => 'string',
                'description' => 'Default currency when property has none',
                'value' => ['value' => 'USD'],
            ],
            [
                'key' => 'booking.tax_rate',
                'group' => 'booking',
                'type' => 'number',
                'description' => 'Default tax rate percent',
                'value' => ['value' => 10.0],
            ],
            [
                'key' => 'features.reviews_enabled',
                'group' => 'features',
                'type' => 'boolean',
                'description' => 'Enable/disable reviews module',
                'value' => ['value' => true],
            ],
        ];

        foreach ($rows as $row) {
            Setting::query()->updateOrCreate(
                ['key' => $row['key']],
                [
                    'group' => $row['group'],
                    'type' => $row['type'],
                    'description' => $row['description'],
                    'value' => $row['value'],
                ]
            );
        }
    }
}

