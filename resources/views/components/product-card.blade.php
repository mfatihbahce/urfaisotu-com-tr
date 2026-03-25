@props(['product', 'accent' => 'red'])

@php
    // Kart içi "vurgular" (Sepete Ekle, hover aksiyonları) için renk modu.
    $isRedAccent = $accent === 'red';
@endphp

<article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:-translate-y-1 flex flex-col">
    <a href="{{ route('products.show', $product->slug) }}" class="block flex-1 flex flex-col">
        {{-- Görsel alanı 1:1 oran --}}
        <div class="relative aspect-square bg-cream overflow-hidden">
            @if($product->mainImage)
                <img
                    src="{{ asset($product->mainImage->path) }}"
                    alt="{{ $product->mainImage->alt ?? $product->name }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                >
            @else
                <div class="w-full h-full flex items-center justify-center bg-slate-100">
                    <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                    </svg>
                </div>
            @endif

            {{-- İndirim etiketi --}}
            @if($product->sale_price && $product->discount_percent)
                <span class="absolute top-3 left-3 px-2.5 py-1 bg-amber text-white text-xs font-bold rounded-lg shadow">
                    %{{ $product->discount_percent }} İndirim
                </span>
            @endif

            {{-- Hover aksiyon ikonları --}}
            <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <a href="{{ route('products.show', $product->slug) }}" title="Hızlı Görüntüle" class="w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-slate-700 shadow-md hover:text-white transition-colors {{ $isRedAccent ? 'hover:bg-red-600' : 'hover:bg-primary' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </a>
                @auth
                    @php $inFavorites = auth()->user()->favorites->contains('id', $product->id); @endphp
                    @if($inFavorites)
                        <form action="{{ route('favorites.remove') }}" method="post" class="inline" onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" title="Favorilerden Kaldır" class="w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-rose-500 shadow-md hover:bg-rose-500 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.add') }}" method="post" class="inline" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" title="Favorilere Ekle" class="w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-slate-700 shadow-md hover:bg-rose-500 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" title="Favorilere eklemek için giriş yapın" class="w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-slate-700 shadow-md hover:bg-rose-500 hover:text-white transition-colors" onclick="event.stopPropagation()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>

        {{-- İçerik --}}
        <div class="p-4 flex-1 flex flex-col">
            @if($product->category)
                <p class="text-xs {{ $isRedAccent ? 'text-red-700' : 'text-primary-dark' }} font-medium uppercase tracking-wide mb-1">{{ $product->category->name }}</p>
            @endif
            <h3 class="font-semibold text-slate-800 {{ $isRedAccent ? 'group-hover:text-red-700' : 'group-hover:text-primary-dark' }} transition-colors line-clamp-2 min-h-[2.5rem]">{{ $product->name }}</h3>
            @if($product->description)
                <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ Str::limit(strip_tags($product->description), 60) }}</p>
            @endif

            {{-- Fiyat --}}
            <div class="mt-3 flex items-center gap-2 flex-wrap">
                <span class="text-lg font-bold {{ $isRedAccent ? 'text-red-700' : 'text-primary-dark' }}">{{ number_format($product->effective_price, 2, ',', '.') }} ₺</span>
                @if($product->sale_price)
                    <span class="text-sm text-slate-400 line-through">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                @endif
            </div>
        </div>
    </a>

    {{-- Sepete Ekle butonu --}}
    <div class="p-4 pt-0">
        <form action="{{ route('cart.add') }}" method="post" class="mt-0">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            @if($product->variants->isNotEmpty())
                <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id }}">
            @endif
            <button type="submit" class="w-full py-3 px-4 text-white text-center font-medium rounded-xl transition-colors duration-200 {{ $isRedAccent ? 'bg-red-700 hover:bg-red-600' : 'bg-primary-dark hover:bg-primary' }}">
                Sepete Ekle
            </button>
        </form>
    </div>
</article>
