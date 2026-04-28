<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Http\Request;

class AdminRefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::query()
            ->with('payment.booking')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.refunds.index', compact('refunds'));
    }

    public function create()
    {
        $payments = Payment::query()->with('booking')->orderByDesc('id')->limit(50)->get();

        return view('admin.refunds.create', compact('payments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'payment_id' => ['required', 'exists:payments,id'],
            'currency' => ['required', 'string', 'size:3'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,succeeded,failed'],
            'reference' => ['nullable', 'string', 'max:255', 'unique:refunds,reference'],
            'meta' => ['nullable', 'string'],
            'refunded_at' => ['nullable', 'date'],
        ]);

        $data['meta'] = filled($data['meta'] ?? null) ? ['notes' => $data['meta']] : null;
        $data['currency'] = strtoupper($data['currency']);

        Refund::create($data);

        return redirect()->route('admin.refunds.index')->with('status', 'Refund created.');
    }

    public function edit(Refund $refund)
    {
        $payments = Payment::query()->with('booking')->orderByDesc('id')->limit(50)->get();

        return view('admin.refunds.edit', compact('refund', 'payments'));
    }

    public function update(Request $request, Refund $refund)
    {
        $data = $request->validate([
            'payment_id' => ['required', 'exists:payments,id'],
            'currency' => ['required', 'string', 'size:3'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,succeeded,failed'],
            'reference' => ['nullable', 'string', 'max:255', 'unique:refunds,reference,'.$refund->id],
            'meta' => ['nullable', 'string'],
            'refunded_at' => ['nullable', 'date'],
        ]);

        $data['meta'] = filled($data['meta'] ?? null) ? ['notes' => $data['meta']] : null;
        $data['currency'] = strtoupper($data['currency']);

        $refund->update($data);

        return back()->with('status', 'Refund updated.');
    }

    public function destroy(Refund $refund)
    {
        $refund->delete();

        return redirect()->route('admin.refunds.index')->with('status', 'Refund deleted.');
    }
}
