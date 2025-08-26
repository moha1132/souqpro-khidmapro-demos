@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">المنتجات</h1>
    <a href="{{ route('products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إضافة منتج</a>
  </div>
  <table class="min-w-full text-right">
    <thead class="bg-slate-100 dark:bg-slate-800"><tr><th class="p-3">الاسم</th><th class="p-3">السعر</th><th class="p-3">المخزون</th><th class="p-3">الحالة</th><th class="p-3">إجراءات</th></tr></thead>
    <tbody>
    @foreach($products as $product)
      <tr class="border-b border-slate-200 dark:border-slate-800">
        <td class="p-3">{{ $product->name }}</td>
        <td class="p-3">{{ $product->price }}</td>
        <td class="p-3">{{ $product->stock }}</td>
        <td class="p-3">{{ $product->is_active ? 'نشط' : 'متوقف' }}</td>
        <td class="p-3 flex gap-2">
          <a class="underline" href="{{ route('products.edit', $product) }}">تعديل</a>
          <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('حذف؟');">
            @csrf @method('DELETE')
            <button class="text-red-600">حذف</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div class="mt-4">{{ $products->links() }}</div>
</div>
@endsection
