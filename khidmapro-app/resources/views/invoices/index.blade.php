@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">الفواتير</h1>
    <a href="{{ route('invoices.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إصدار فاتورة</a>
  </div>
  <table class="min-w-full text-right">
    <thead class="bg-slate-100 dark:bg-slate-800"><tr><th class="p-3">الرقم</th><th class="p-3">الحجز</th><th class="p-3">الإجمالي</th><th class="p-3">الحالة</th><th class="p-3">إجراءات</th></tr></thead>
    <tbody>
      @foreach($invoices as $invoice)
      <tr class="border-b border-slate-200 dark:border-slate-800">
        <td class="p-3">{{ $invoice->number }}</td>
        <td class="p-3">#{{ $invoice->booking_id }}</td>
        <td class="p-3">{{ $invoice->total }} {{ $invoice->currency }}</td>
        <td class="p-3">{{ $invoice->status }}</td>
        <td class="p-3 flex gap-2">
          <a class="underline" href="{{ route('invoices.edit', $invoice) }}">تعديل</a>
          <form method="POST" action="{{ route('invoices.destroy', $invoice) }}" onsubmit="return confirm('حذف؟');">
            @csrf @method('DELETE')
            <button class="text-red-600">حذف</button>
          </form>
        </td>
        <td class="p-3 flex gap-2">
          <form method="POST" action="{{ route('invoices.markPaid', $invoice) }}">@csrf<button class="px-3 py-1 bg-emerald-600 text-white rounded">تحديد كمدفوع</button></form>
          <form method="POST" action="{{ route('invoices.checkout', $invoice) }}">@csrf<button class="px-3 py-1 bg-indigo-600 text-white rounded">Stripe Checkout</button></form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="mt-4">{{ $invoices->links() }}</div>
</div>
@endsection
