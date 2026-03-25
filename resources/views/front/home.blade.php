@extends('layouts.front')

@section('title', 'Anasayfa - ' . config('app.name'))

@section('content')
    <section class="bg-gradient-to-r from-red-700 to-red-500 rounded-2xl p-8 md:p-12 text-white mb-12">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">İstanbul'dan Dünyaya Baharat Yolculuğu</h1>
        <p class="text-lg text-white/90 mb-6">Doğal ve premium baharatlarla mutfaklarınıza lezzet katın.</p>
        <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-white text-red-700 font-semibold rounded-lg hover:bg-slate-100">Ürünleri Keşfet</a>
    </section>

    @if($featured->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Öne Çıkan Ürünler</h2>
                <div class="hidden md:flex items-center gap-2">
                    <button type="button" id="featured-prev" aria-label="Sol" class="w-10 h-10 rounded-full bg-white shadow border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" id="featured-next" aria-label="Sağ" class="w-10 h-10 rounded-full bg-white shadow border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-6">
                <div id="featured-carousel" class="flex overflow-x-auto gap-4 px-4 sm:px-6 pb-2 snap-x snap-mandatory scroll-smooth" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach($featured as $product)
                        <div class="flex-shrink-0 w-[180px] sm:w-[200px] lg:w-[240px] snap-start">
                            <x-product-card :product="$product" accent="red" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($categories->isNotEmpty())
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Kategoriler</h2>
                <div class="hidden md:flex items-center gap-2">
                    <button type="button" id="categories-prev" aria-label="Sol" class="w-10 h-10 rounded-full bg-white shadow border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" id="categories-next" aria-label="Sağ" class="w-10 h-10 rounded-full bg-white shadow border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
            <div class="relative -mx-4 sm:-mx-6 px-4 sm:px-6">
                <div id="categories-carousel" class="flex overflow-x-auto gap-4 pb-2 snap-x snap-mandatory scroll-smooth" style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach($categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}" class="flex-shrink-0 w-[calc(20%-1rem)] min-w-[130px] sm:min-w-[150px] lg:min-w-[180px] snap-start bg-white rounded-xl shadow-sm p-5 sm:p-6 text-center hover:shadow-md hover:border-red-500 transition border-2 border-transparent">
                            <h3 class="font-semibold text-slate-800">{{ $cat->name }}</h3>
                            <p class="text-sm text-slate-500 mt-2">{{ $cat->products_count ?? $cat->products->count() }} ürün</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section>
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Yeni Ürünler</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" accent="red" />
            @empty
                <p class="col-span-full text-slate-500 text-center py-12">Henüz ürün bulunmuyor.</p>
            @endforelse
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-red-700 text-white font-semibold rounded-xl hover:bg-red-600 transition-colors">
                Tüm Ürünleri Gör
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>

    <style>
        #featured-carousel::-webkit-scrollbar, #categories-carousel::-webkit-scrollbar { display: none; }
    </style>
    @if($featured->isNotEmpty() || $categories->isNotEmpty())
    <script>
        (function() {
            var interval = 3000;
            function autoScroll(containerId, itemWidth) {
                var el = document.getElementById(containerId);
                if (!el) return;
                var maxScroll = el.scrollWidth - el.clientWidth;
                if (maxScroll <= 0) return;
                setInterval(function() {
                    var next = el.scrollLeft + (itemWidth || 220);
                    if (next >= maxScroll) next = 0;
                    el.scrollTo({ left: next, behavior: 'smooth' });
                }, interval);
            }
            function setupNavButtons(containerId, prevBtnId, nextBtnId, scrollAmount) {
                var el = document.getElementById(containerId);
                var prevBtn = document.getElementById(prevBtnId);
                var nextBtn = document.getElementById(nextBtnId);
                if (!el || !prevBtn || !nextBtn) return;
                prevBtn.addEventListener('click', function() {
                    el.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });
                nextBtn.addEventListener('click', function() {
                    el.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });
            }
            if (document.getElementById('featured-carousel')) {
                autoScroll('featured-carousel', 220);
                setupNavButtons('featured-carousel', 'featured-prev', 'featured-next', 220);
            }
            if (document.getElementById('categories-carousel')) {
                autoScroll('categories-carousel', 180);
                setupNavButtons('categories-carousel', 'categories-prev', 'categories-next', 180);
            }
        })();
    </script>
    @endif
@endsection
