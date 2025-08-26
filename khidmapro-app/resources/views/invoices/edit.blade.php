@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">تعديل فاتورة</h1>
  <form method="POST" action="{{ route('invoices.update', $invoice) }}">@method('PUT')@csrf
<div class="grid gap-4">
  <label>الحجز<select class="w-full border p-2 rounded" name="booking_id">@foreach($bookings as $b)<option value="{{ $b->id }}" @selected(old('booking_id', $invoice->booking_id ?? '')==$b->id)>#{{ $b->id }}</option>@endforeach</select></label>
  <label>المجموع<input type="number" step="0.01" class="w-full border p-2 rounded" name="subtotal" value="{{ old('subtotal', $invoice->subtotal ?? 0) }}" required></label>
  <label>الخصم<input type="number" step="0.01" class="w-full border p-2 rounded" name="discount" value="{{ old('discount', $invoice->discount ?? 0) }}"></label>
  <label>الضريبة<input type="number" step="0.01" class="w-full border p-2 rounded" name="tax" value="{{ old('tax', $invoice->tax ?? 0) }}"></label>
  <label>الإجمالي<input type="number" step="0.01" class="w-full border p-2 rounded" name="total" value="{{ old('total', $invoice->total ?? 0) }}" required></label>
  <label>العملة<input class="w-full border p-2 rounded" name="currency" value="{{ old('currency', $invoice->currency ?? 'USD') }}" required></label>
  <label>الحالة<select class="w-full border p-2 rounded" name="status">@foreach(['unpaid','paid','refunded'] as $st)<option value="{{ $st }}" @selected(old('status', $invoice->status ?? 'unpaid')==$st)>{{ $st }}</option>@endforeach</select></label>
  <label>تاريخ الإصدار<input type="datetime-local" class="w-full border p-2 rounded" name="issued_at" value="{{ old('issued_at') }}"></label>
  <label>تاريخ الدفع<input type="datetime-local" class="w-full border p-2 rounded" name="paid_at" value="{{ old('paid_at') }}"></label>
  <button class="px-4 py-2 bg-emerald-600 text-white rounded">حفظ</button>
</div>
</form>
</div>
@endsection
