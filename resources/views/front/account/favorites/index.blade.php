@extends('layouts.account')

@section('title', 'Favorilerim')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary-dark">Favorilerim</h1>
        <p class="text-slate-500 mt-1">Favori ürünleriniz</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        @if($favorites->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-rose-50 flex items-center justify-center text-rose-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <p class="text-slate-500">Favori ürününüz yok.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-xl text-sm font-medium">Ürünleri Keşfet</a>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @foreach($favorites as $product)
                    <div class="group relative bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-lg transition-all">
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            <div class="aspect-square bg-cream overflow-hidden">
                                @if($product->mainImage)
                                    <img src="{{ asset($product->mainImage->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                        <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="font-medium text-slate-800 group-hover:text-primary-dark truncate">{{ $product->name }}</h3>
                                <p class="text-primary-dark font-semibold text-sm mt-1">{{ number_format($product->effective_price, 2, ',', '.') }} ₺</p>
                            </div>
                        </a>
                        <form action="{{ route('favorites.remove') }}" method="post" class="absolute top-2 right-2 z-10">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" title="Favorilerden Kaldır" class="w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-rose-600 shadow-md hover:bg-rose-500 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </form>
                        <div class="px-3 pb-3">
                            <form action="{{ route('cart.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                @if($product->variants->isNotEmpty())
                                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id }}">
                                @endif
                                <button type="submit" class="w-full py-2 px-3 bg-primary-dark text-white text-center text-sm font-medium rounded-lg hover:bg-primary transition-colors">Sepete Ekle</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
