@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">الحجوزات</h1>
    <a href="{{ route('bookings.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إضافة حجز</a>
  </div>
  <table class="min-w-full text-right">
    <thead class="bg-slate-100 dark:bg-slate-800"><tr><th class="p-3">الخدمة</th><th class="p-3">العميل</th><th class="p-3">الوقت</th><th class="p-3">الحالة</th><th class="p-3">إجراءات</th></tr></thead>
    <tbody>
      @foreach($bookings as $booking)
      <tr class="border-b border-slate-200 dark:border-slate-800">
        <td class="p-3">{{ $booking->service->title }}</td>
        <td class="p-3">{{ $booking->client_name }}</td>
        <td class="p-3">{{ $booking->starts_at->format('Y-m-d H:i') }}</td>
        <td class="p-3">{{ $booking->status }}</td>
        <td class="p-3 flex gap-2">
          <a class="underline" href="{{ route('bookings.edit', $booking) }}">تعديل</a>
          <form method="POST" action="{{ route('bookings.destroy', $booking) }}" onsubmit="return confirm('حذف؟');">
            @csrf @method('DELETE')
            <button class="text-red-600">حذف</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="mt-4">{{ $bookings->links() }}</div>
</div>
@endsection
