<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()
            ->with('booking')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }
}

