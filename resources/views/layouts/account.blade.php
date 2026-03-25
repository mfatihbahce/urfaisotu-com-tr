<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hesabım') - {{ config('app.name') }}</title>
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
    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <button type="button" id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <a href="{{ route('home') }}" class="text-xl font-bold text-primary-dark">IstanbulSpice</a>
                </div>
                <nav class="hidden md:flex gap-6">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-primary">Anasayfa</a>
                    <a href="{{ route('products.index') }}" class="text-slate-600 hover:text-primary">Ürünler</a>
                    <a href="{{ route('contact.index') }}" class="text-slate-600 hover:text-primary">İletişim</a>
                </nav>
                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-1 px-3 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Sepet
                        @if(isset($cartItemCount) && $cartItemCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-amber text-white text-xs rounded-full flex items-center justify-center">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-4"><div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg text-sm">{{ session('success') }}</div></div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-4"><div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg text-sm">{{ session('error') }}</div></div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            @include('layouts.partials.account-sidebar')

            <main class="flex-1 min-w-0">
                @yield('content')
            </main>
        </div>
    </div>

    <footer class="bg-slate-800 text-slate-300 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center text-sm">&copy; {{ date('Y') }} IstanbulSpice. Tüm hakları saklıdır.</div>
        </div>
    </footer>

    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-20 lg:hidden hidden" onclick="closeSidebar()"></div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('account-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
            backdrop.classList.toggle('hidden');
        }
        function closeSidebar() {
            document.getElementById('account-sidebar').classList.add('-translate-x-full');
            document.getElementById('account-sidebar').classList.remove('translate-x-0');
            document.getElementById('sidebar-backdrop').classList.add('hidden');
        }
        document.getElementById('sidebar-toggle')?.addEventListener('click', toggleSidebar);
        document.querySelectorAll('#account-sidebar a').forEach(function(link) {
            link.addEventListener('click', function() { if (window.innerWidth < 1024) closeSidebar(); });
        });
    </script>
</body>
</html>
