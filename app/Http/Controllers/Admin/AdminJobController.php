<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = DB::table('jobs')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.system.jobs.index', compact('jobs'));
    }
}
