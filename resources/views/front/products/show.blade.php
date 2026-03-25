@extends('layouts.front')

@section('title', $product->name . ' - ' . config('app.name'))
@section('meta_description', $product->meta_description ?? Str::limit(strip_tags($product->description), 160))

@section('content')
    <nav class="text-sm text-slate-500 mb-4">
        <a href="{{ route('home') }}">Anasayfa</a> / <a href="{{ route('products.index') }}">Ürünler</a> / <a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a> / {{ $product->name }}
    </nav>
    <div class="grid md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="space-y-3">
            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden flex items-center justify-center">
                @if($product->images->isNotEmpty())
                    <img id="product-main-img" src="{{ asset($product->images->first()->path) }}" alt="{{ $product->images->first()->alt ?? $product->name }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-32 h-32 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                @endif
            </div>
            @if($product->images->count() > 1)
                <div class="flex gap-2 overflow-x-auto pb-1">
                    @foreach($product->images as $img)
                        <button type="button" onclick="document.getElementById('product-main-img').src='{{ asset($img->path) }}'" class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary transition focus:border-primary focus:outline-none">
                            <img src="{{ asset($img->path) }}" alt="{{ $img->alt ?? $product->name }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="p-8">
            <h1 class="text-2xl font-bold text-slate-800">{{ $product->name }}</h1>
            <p class="text-sm text-slate-500 mt-1">SKU: {{ $product->sku }}</p>
            <div class="flex items-center gap-3 mt-4">
                <span class="text-2xl font-bold text-primary">{{ number_format($product->effective_price, 2, ',', '.') }} ₺</span>
                @if($product->sale_price)
                    <span class="text-lg text-slate-400 line-through">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                    <span class="px-2 py-0.5 bg-red-100 text-red-600 text-sm font-medium rounded">%{{ $product->discount_percent }} İndirim</span>
                @endif
            </div>
            <p class="mt-4 text-slate-600">{{ $product->description }}</p>

            @if($product->attributes && count($product->attributes) > 0)
                <div class="mt-4">
                    <h4 class="font-medium text-slate-800 mb-2">Ürün Özellikleri</h4>
                    <ul class="space-y-1 text-sm text-slate-600">
                        @foreach($product->attributes as $key => $val)
                            <li><strong>{{ $key }}:</strong> {{ $val }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cart.add') }}" method="post" class="mt-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @if($product->variants->isNotEmpty())
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Seçenek</label>
                        <select name="variant_id" required class="w-full md:w-64 rounded-lg border border-slate-200 px-3 py-2">
                            @foreach($product->variants as $v)
                                <option value="{{ $v->id }}">{{ $v->name }} - {{ number_format($v->effective_price, 2, ',', '.') }} ₺</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="flex gap-4">
                    <input type="number" name="quantity" value="1" min="1" max="99" class="w-20 rounded-lg border border-slate-200 px-3 py-2">
                    <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark">Sepete Ekle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
