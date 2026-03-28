<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'IstanbulSpice - Doğal ve premium baharatlar')">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#0d9488', dark: '#0b3d2e', light: '#14b8a6' },
                        amber: { DEFAULT: '#d4af37', dark: '#b8941f' },
                        cream: '#f5f1e8',
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-slate-50 text-slate-800">
    @php($isHomePage = request()->routeIs('home'))
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <button type="button" id="mobile-menu-btn" class="md:hidden p-2 -ml-2 rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Menüyü aç">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <a href="{{ route('home') }}" class="text-xl font-bold {{ $isHomePage ? 'text-red-700' : 'text-primary-dark' }}">IstanbulSpice</a>
                </div>
                <nav class="hidden md:flex gap-6">
                    <a href="{{ route('home') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Anasayfa</a>
                    <a href="{{ route('products.index') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Ürünler</a>
                    <a href="{{ route('contact.index') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">İletişim</a>
                </nav>
                <div class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-1 px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span class="hidden sm:inline">Sepet</span>
                        @if(isset($cartItemCount) && $cartItemCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-amber text-white text-xs rounded-full flex items-center justify-center">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                    <div class="hidden md:flex items-center gap-4">
                        @auth
                            <a href="{{ route('account.index') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Hesabım</a>
                            <form method="post" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Çıkış</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Giriş</a>
                            <a href="{{ route('register') }}" class="text-slate-600 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Kayıt</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Mobil hamburger menü --}}
        <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 right-0 bg-white border-t border-slate-200 shadow-lg py-4">
            <nav class="px-4 space-y-1">
                <a href="{{ route('home') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Anasayfa</a>
                <a href="{{ route('products.index') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Ürünler</a>
                <a href="{{ route('contact.index') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">İletişim</a>
                <hr class="my-2 border-slate-200">
                @auth
                    <a href="{{ route('account.index') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Hesabım</a>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Çıkış</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Giriş</a>
                    <a href="{{ route('register') }}" class="block py-3 px-4 rounded-lg text-slate-600 hover:bg-slate-50 {{ $isHomePage ? 'hover:text-red-600' : 'hover:text-primary' }}">Kayıt</a>
                @endauth
            </nav>
        </div>
    </header>
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        document.querySelectorAll('#mobile-menu a').forEach(function(link) {
            link.addEventListener('click', function() { document.getElementById('mobile-menu').classList.add('hidden'); });
        });
    </script>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg">{{ session('success') }}</div></div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg">{{ session('error') }}</div></div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        @yield('content')
    </main>

    @php($footerPhone = \App\Models\Setting::get('contact_phone', '-'))
    @php($footerEmail = \App\Models\Setting::get('contact_email', '-'))
    <footer class="bg-slate-900 text-slate-400 mt-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-14 pb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
                <div class="lg:col-span-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-xl font-bold tracking-tight text-white">
                        <span class="text-red-500">Istanbul</span><span class="text-slate-100">Spice</span>
                    </a>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 max-w-sm">
                        Doğal ve premium baharatlar. İstanbul'dan dünyaya; seçilmiş ürünler, güvenli alışveriş ve hızlı teslimat.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-700/80 bg-slate-800/50 px-3 py-1 text-xs text-slate-300">Güvenli ödeme</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-700/80 bg-slate-800/50 px-3 py-1 text-xs text-slate-300">SSL ile korunur</span>
                    </div>
                    <div class="mt-6 flex items-center gap-2">
                        <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/80 text-slate-400 transition hover:border-red-500/40 hover:text-red-400 hover:bg-slate-800" aria-label="Instagram" title="Instagram">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/80 text-slate-400 transition hover:border-red-500/40 hover:text-red-400 hover:bg-slate-800" aria-label="Facebook" title="Facebook">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">Keşfet</p>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                Anasayfa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                Ürünler
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                İletişim
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">Hesap</p>
                    <ul class="space-y-3 text-sm">
                        @auth
                            <li>
                                <a href="{{ route('account.index') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                    <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Hesabım
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                    <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Giriş
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                    <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Kayıt ol
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white">
                                <svg class="h-3.5 w-3.5 text-red-500/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                Sepetim
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">İletişim</p>
                    <ul class="space-y-4 text-sm">
                        <li class="flex gap-3">
                            <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-slate-700 bg-slate-800 text-red-400" aria-hidden="true">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-slate-500">Telefon</p>
                                @if(($footerPhone ?? '-') !== '-')
                                    <a href="tel:{{ preg_replace('/\s+/', '', $footerPhone) }}" class="text-slate-200 font-medium hover:text-white transition">{{ $footerPhone }}</a>
                                @else
                                    <span class="text-slate-200 font-medium">—</span>
                                @endif
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-slate-700 bg-slate-800 text-red-400" aria-hidden="true">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-slate-500">E-posta</p>
                                @if(($footerEmail ?? '-') !== '-')
                                    <a href="mailto:{{ $footerEmail }}" class="text-slate-200 font-medium hover:text-white transition break-all">{{ $footerEmail }}</a>
                                @else
                                    <span class="text-slate-200 font-medium">—</span>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 flex flex-col gap-4 border-t border-slate-800 pt-8 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-center text-xs text-slate-500 sm:text-left">
                    &copy; {{ date('Y') }} IstanbulSpice. Tüm hakları saklıdır.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs text-slate-500 sm:justify-end">
                    <a href="{{ route('contact.index') }}" class="transition hover:text-slate-300">KVKK &amp; gizlilik</a>
                    <a href="{{ route('contact.index') }}" class="transition hover:text-slate-300">Mesafeli satış</a>
                    <a href="{{ route('contact.index') }}" class="transition hover:text-slate-300">İade &amp; değişim</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
