<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(): View {
        $services = Service::latest()->paginate(10);
        return view('services.index', compact('services'));
    }

    public function create(): View {
        return view('services.create');
    }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:15|max:1440',
            'price' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = $request->user()?->id;
        $validated['is_active'] = (bool)($request->boolean('is_active'));
        Service::create($validated);
        return redirect()->route('services.index')->with('success', 'تم إنشاء الخدمة');
    }

    public function show(Service $service): View { return view('services.show', compact('service')); }

    public function edit(Service $service): View { return view('services.edit', compact('service')); }

    public function update(Request $request, Service $service): RedirectResponse {
        $validated = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:15|max:1440',
            'price' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = (bool)($request->boolean('is_active'));
        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'تم تحديث الخدمة');
    }

    public function destroy(Service $service): RedirectResponse {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة');
    }
}
