<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();
        $bookingsToday = Booking::whereDate('starts_at', $today)->count();
        $revenue = Invoice::where('status', 'paid')->sum('total');
        $unpaid = Invoice::where('status', 'unpaid')->count();
        $recent = Booking::with('service')->latest()->take(8)->get();
        return view('admin.dashboard', compact('bookingsToday','revenue','unpaid','recent'));
    }
}
