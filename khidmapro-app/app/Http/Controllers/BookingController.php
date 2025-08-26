<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View {
        $bookings = Booking::with('service')->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create(): View {
        $services = Service::where('is_active', true)->get(['id','title']);
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:191',
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|string|max:32',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
            'notes' => 'nullable|string',
        ]);
        $validated['status'] = 'pending';
        Booking::create($validated);
        return redirect()->route('bookings.index')->with('success', 'تم إنشاء الحجز');
    }

    public function show(Booking $booking): View { return view('bookings.show', compact('booking')); }

    public function edit(Booking $booking): View {
        $services = Service::where('is_active', true)->get(['id','title']);
        return view('bookings.edit', compact('booking','services'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:191',
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|string|max:32',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
            'status' => 'required|in:pending,confirmed,completed,cancelled,no_show',
            'notes' => 'nullable|string',
        ]);
        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'تم تحديث الحجز');
    }

    public function destroy(Booking $booking): RedirectResponse {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز');
    }
}
