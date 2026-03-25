@extends('layouts.front')

@section('title', $category->name . ' - ' . config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold text-slate-800 mb-6">{{ $category->name }}</h1>
    @if($category->description)
        <p class="text-slate-600 mb-6">{{ $category->description }}</p>
    @endif
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p class="col-span-full text-slate-500 text-center py-12">Bu kategoride ürün bulunamadı.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
@endsection
