@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">لوحة الإدارة</h1>
  <div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="p-4 rounded border bg-white dark:bg-slate-900"><div class="text-slate-500">حجوزات اليوم</div><div class="text-2xl font-bold">{{ $bookingsToday }}</div></div>
    <div class="p-4 rounded border bg-white dark:bg-slate-900"><div class="text-slate-500">إجمالي الإيرادات</div><div class="text-2xl font-bold">${{ number_format($revenue,2) }}</div></div>
    <div class="p-4 rounded border bg-white dark:bg-slate-900"><div class="text-slate-500">فواتير غير مدفوعة</div><div class="text-2xl font-bold">{{ $unpaid }}</div></div>
  </div>
  <div class="bg-white dark:bg-slate-900 rounded border">
    <div class="p-4 font-semibold">أحدث الحجوزات</div>
    <table class="min-w-full text-right">
      <thead class="bg-slate-100 dark:bg-slate-800"><tr><th class="p-3">الخدمة</th><th class="p-3">العميل</th><th class="p-3">الوقت</th><th class="p-3">الحالة</th></tr></thead>
      <tbody>
        @foreach($recent as $b)
        <tr class="border-b border-slate-200 dark:border-slate-800">
          <td class="p-3">{{ $b->service->title }}</td>
          <td class="p-3">{{ $b->client_name }}</td>
          <td class="p-3">{{ $b->starts_at->format('Y-m-d H:i') }}</td>
          <td class="p-3">{{ $b->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
