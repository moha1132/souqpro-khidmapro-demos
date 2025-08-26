@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">إضافة حجز</h1>
  <form method="POST" action="{{ route('bookings.store') }}">@csrf
<div class="grid gap-4">
  <label>الخدمة<select class="w-full border p-2 rounded" name="service_id">@foreach($services as $s)<option value="{{ $s->id }}" @selected(old('service_id', $booking->service_id ?? '')==$s->id)>{{ $s->title }}</option>@endforeach</select></label>
  <label>اسم العميل<input class="w-full border p-2 rounded" name="client_name" value="{{ old('client_name', $booking->client_name ?? '') }}" required></label>
  <label>بريد العميل<input type="email" class="w-full border p-2 rounded" name="client_email" value="{{ old('client_email', $booking->client_email ?? '') }}"></label>
  <label>هاتف العميل<input class="w-full border p-2 rounded" name="client_phone" value="{{ old('client_phone', $booking->client_phone ?? '') }}"></label>
  <label>وقت البداية<input type="datetime-local" class="w-full border p-2 rounded" name="starts_at" value="{{ old('starts_at') }}" required></label>
  <label>وقت النهاية<input type="datetime-local" class="w-full border p-2 rounded" name="ends_at" value="{{ old('ends_at') }}" required></label>
  <label>ملاحظات<textarea class="w-full border p-2 rounded" name="notes">{{ old('notes', $booking->notes ?? '') }}</textarea></label>
  <button class="px-4 py-2 bg-emerald-600 text-white rounded">حفظ</button>
</div>
</form>
</div>
@endsection
