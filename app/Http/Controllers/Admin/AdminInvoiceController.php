<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::query()
            ->with('booking.property')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        return view('admin.invoices.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'number' => ['required', 'string', 'max:50', 'unique:invoices,number'],
            'currency' => ['required', 'string', 'size:3'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax_total' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'issued_at' => ['nullable', 'date'],
            'due_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'status' => ['required', 'in:draft,issued,paid,void'],
            'pdf_url' => ['nullable', 'string', 'max:255'],
        ]);

        Invoice::create($data);

        return redirect()->route('admin.invoices.index')->with('status', 'Invoice created.');
    }

    public function edit(Invoice $invoice)
    {
        $bookings = Booking::query()->orderByDesc('id')->limit(50)->get();
        return view('admin.invoices.edit', compact('invoice', 'bookings'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'number' => ['required', 'string', 'max:50', 'unique:invoices,number,'.$invoice->id],
            'currency' => ['required', 'string', 'size:3'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax_total' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'issued_at' => ['nullable', 'date'],
            'due_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'status' => ['required', 'in:draft,issued,paid,void'],
            'pdf_url' => ['nullable', 'string', 'max:255'],
        ]);

        $invoice->update($data);

        return back()->with('status', 'Invoice updated.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('status', 'Invoice deleted.');
    }
}

