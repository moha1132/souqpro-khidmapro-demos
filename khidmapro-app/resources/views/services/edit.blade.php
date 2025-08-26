@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">تعديل خدمة</h1>
  <form method="POST" action="{{ route('services.update', $service) }}">@method('PUT')@csrf
<div class="grid gap-4">
  <label>العنوان<input class="w-full border p-2 rounded" name="title" value="{{ old('title', $service->title ?? '') }}" required></label>
  <label>الوصف<textarea class="w-full border p-2 rounded" name="description">{{ old('description', $service->description ?? '') }}</textarea></label>
  <label>المدة بالدقائق<input type="number" class="w-full border p-2 rounded" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes ?? 60) }}" required></label>
  <label>السعر<input type="number" step="0.01" class="w-full border p-2 rounded" name="price" value="{{ old('price', $service->price ?? 0) }}" required></label>
  <label>الوديعة<input type="number" step="0.01" class="w-full border p-2 rounded" name="deposit_amount" value="{{ old('deposit_amount', $service->deposit_amount ?? 0) }}"></label>
  <label class="flex items-center gap-2"><input type="checkbox" name="is_active" {{ old('is_active', ($service->is_active ?? true)) ? 'checked' : '' }}> نشط</label>
  <button class="px-4 py-2 bg-emerald-600 text-white rounded">حفظ</button>
</div>
</form>
</div>
@endsection
