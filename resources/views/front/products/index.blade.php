@extends('layouts.front')

@section('title', 'Ürünler - ' . config('app.name'))

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <aside class="md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-4 sticky top-24">
                <h3 class="font-semibold text-slate-800 mb-3">Kategoriler</h3>
                <ul class="space-y-1">
                    <li><a href="{{ route('products.index') }}" class="block py-1 text-slate-600 hover:text-primary {{ !request('category') ? 'font-medium text-primary' : '' }}">Tümü</a></li>
                    @foreach($categories as $cat)
                        <li><a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="block py-1 text-slate-600 hover:text-primary {{ request('category') == $cat->slug ? 'font-medium text-primary' : '' }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
                <form method="get" class="mt-4">
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Ara..." class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                    <button type="submit" class="mt-2 w-full py-2 bg-red-700 text-white rounded-lg text-sm font-medium hover:bg-red-800 transition-colors">Ara</button>
                </form>
            </div>
        </aside>
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-slate-800 mb-6">Ürünler</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="col-span-full text-slate-500 text-center py-12">Ürün bulunamadı.</p>
                @endforelse
            </div>
            <div class="mt-6">{{ $products->withQueryString()->links() }}</div>
        </div>
    </div>
@endsection
