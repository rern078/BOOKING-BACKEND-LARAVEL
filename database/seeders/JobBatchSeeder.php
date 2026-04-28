<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobBatchSeeder extends Seeder
{
  public function run(): void
  {
    for ($i = 1; $i <= 5; $i++) {
      DB::table('job_batches')->updateOrInsert(
        ['name' => 'Sample Batch ' . $i],
        [
          'id' => (string) Str::uuid(),
          'total_jobs' => 10 + $i,
          'pending_jobs' => max(0, 5 - $i),
          'failed_jobs' => $i % 3,
          'failed_job_ids' => json_encode($i % 3 ? [$i, $i + 10] : []),
          'options' => json_encode([
            'queue' => ['default', 'emails', 'reports'][($i - 1) % 3],
            'allowFailures' => true,
          ]),
          'cancelled_at' => $i === 5 ? now()->subHour()->timestamp : null,
          'created_at' => now()->subHours($i)->timestamp,
          'finished_at' => $i <= 3 ? now()->subMinutes($i * 10)->timestamp : null,
        ]
      );
    }
  }
}
