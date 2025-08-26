<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View {
        $invoices = Invoice::with('booking')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create(): View {
        $bookings = Booking::latest()->get(['id']);
        return view('invoices.create', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'status' => 'required|in:unpaid,paid,refunded',
            'issued_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
        ]);
        $validated['number'] = 'INV-'.Str::upper(Str::random(8));
        Invoice::create($validated);
        return redirect()->route('invoices.index')->with('success', 'تم إنشاء الفاتورة');
    }

    public function show(Invoice $invoice): View { return view('invoices.show', compact('invoice')); }

    public function edit(Invoice $invoice): View {
        $bookings = Booking::latest()->get(['id']);
        return view('invoices.edit', compact('invoice','bookings'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'status' => 'required|in:unpaid,paid,refunded',
            'issued_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
        ]);
        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة');
    }

    public function destroy(Invoice $invoice): RedirectResponse {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'تم حذف الفاتورة');
    }

    public function markPaid(\App\Models\Invoice $invoice): \Illuminate\Http\RedirectResponse
    {
        $invoice->update(['status' => 'paid', 'paid_at' => now()]);
        return redirect()->route('invoices.index')->with('success', 'تم وضع علامة مدفوع');
    }

    public function checkout(\App\Models\Invoice $invoice): \Illuminate\Http\RedirectResponse
    {
        // Stripe stub: in production, create a Checkout Session here
        // \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        // $session = \Stripe\Checkout\Session::create([...]);
        return redirect()->route('invoices.index')->with('success', 'تم إنشاء جلسة دفع (تجريبية)');
    }
}
