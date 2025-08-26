@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">تعديل منتج</h1>
  <form method="POST" action="{{ route('products.update', $product) }}">@method('PUT')@csrf
<div class="grid gap-4">
  <label>الاسم<input class="w-full border p-2 rounded" name="name" value="{{ old('name', $product->name ?? '') }}" required></label>
  <label>الوصف<textarea class="w-full border p-2 rounded" name="description">{{ old('description', $product->description ?? '') }}</textarea></label>
  <label>السعر<input type="number" step="0.01" class="w-full border p-2 rounded" name="price" value="{{ old('price', $product->price ?? 0) }}" required></label>
  <label>سعر التخفيض<input type="number" step="0.01" class="w-full border p-2 rounded" name="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}"></label>
  <label>وقت بداية التخفيض<input type="datetime-local" class="w-full border p-2 rounded" name="sale_starts_at" value="{{ old('sale_starts_at') }}"></label>
  <label>وقت نهاية التخفيض<input type="datetime-local" class="w-full border p-2 rounded" name="sale_ends_at" value="{{ old('sale_ends_at') }}"></label>
  <label>SKU<input class="w-full border p-2 rounded" name="sku" value="{{ old('sku', $product->sku ?? '') }}"></label>
  <label>المخزون<input type="number" class="w-full border p-2 rounded" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required></label>
  <label class="flex items-center gap-2"><input type="checkbox" name="is_active" {{ old('is_active', ($product->is_active ?? true)) ? 'checked' : '' }}> نشط</label>
  <button class="px-4 py-2 bg-emerald-600 text-white rounded">حفظ</button>
</div>
</form>
</div>
@endsection
