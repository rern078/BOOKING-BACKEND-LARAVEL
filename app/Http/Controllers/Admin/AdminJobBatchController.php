<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminJobBatchController extends Controller
{
    public function index()
    {
        $batches = DB::table('job_batches')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.system.job-batches.index', compact('batches'));
    }
}
