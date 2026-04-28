<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('jobs')->updateOrInsert(
                ['id' => $i],
                [
                    'queue' => ['default', 'emails', 'notifications', 'reports', 'sync'][($i - 1) % 5],
                    'payload' => json_encode([
                        'uuid' => fake()->uuid(),
                        'displayName' => 'App\\Jobs\\SampleJob'.$i,
                        'job' => 'Illuminate\\Queue\\CallQueuedHandler@call',
                        'maxTries' => null,
                        'timeout' => null,
                        'data' => [
                            'commandName' => 'App\\Jobs\\SampleJob'.$i,
                            'command' => 'sample payload '.$i,
                        ],
                    ], JSON_PRETTY_PRINT),
                    'attempts' => ($i - 1) % 3,
                    'reserved_at' => $i % 2 === 0 ? now()->subMinutes($i * 3)->timestamp : null,
                    'available_at' => now()->addMinutes($i)->timestamp,
                    'created_at' => now()->subMinutes($i * 5)->timestamp,
                ]
            );
        }
    }
}
