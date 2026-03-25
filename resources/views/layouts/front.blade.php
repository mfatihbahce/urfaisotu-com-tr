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

    <footer class="bg-slate-800 text-slate-300 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white font-semibold mb-2">IstanbulSpice</h3>
                    <p class="text-sm">Doğal ve premium baharatlar. İstanbul'dan dünyaya.</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-2">Hızlı Linkler</h3>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Anasayfa</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white">Ürünler</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-white">İletişim</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-2">İletişim</h3>
                    <p class="text-sm">{{ \App\Models\Setting::get('contact_phone', '-') }}</p>
                    <p class="text-sm">{{ \App\Models\Setting::get('contact_email', '-') }}</p>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-8 pt-6 text-center text-sm">
                &copy; {{ date('Y') }} IstanbulSpice. Tüm hakları saklıdır.
            </div>
        </div>
    </footer>
</body>
</html>
