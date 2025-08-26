@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6">
  @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
  @endif
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">{{ $title }}</h1>
    @isset($createUrl)
      <a href="{{ $createUrl }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded">إضافة</a>
    @endisset
  </div>
  <div class="bg-white dark:bg-slate-900 rounded border border-slate-200 dark:border-slate-800 overflow-x-auto">
    {{ $slot }}
  </div>
</div>
@endsection
