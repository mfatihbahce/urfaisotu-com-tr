<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - IstanbulSpice')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { dark: '#0b3d2e' },
                        gold: '#d4af37',
                        cream: '#f5f1e8',
                    },
                },
            },
        };
    </script>
</head>
@php
    $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
<body class="bg-cream text-slate-900">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside
            id="admin-sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-primary-dark text-cream flex flex-col transform md:transform-none -translate-x-full md:translate-x-0 transition-transform duration-200"
        >
            <div class="px-5 py-4 border-b border-white/10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gold flex items-center justify-center text-primary-dark font-bold">
                    IS
                </div>
                <div>
                    <div class="text-sm font-semibold tracking-wide">IstanbulSpice</div>
                    <div class="text-[11px] text-cream/70">E-Ticaret Yönetimi</div>
                </div>
            </div>

            <nav class="flex-1 px-3 py-4 text-sm space-y-1 overflow-y-auto">
                @php
                    $linkClasses = 'flex items-center gap-3 px-3 py-2.5 rounded-lg transition';
                    $iconClasses = 'w-5 h-5';
                @endphp

                <a href="{{ route('admin.index') }}"
                   class="{{ $linkClasses }} {{ $routeName === 'admin.index' ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l9-9 9 9M4.5 10.5V21h5.25v-4.5h4.5V21H19.5V10.5" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.products') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 7h12M6 12h12M6 17h8" />
                    </svg>
                    <span>Ürünler</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.categories') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h7v7H4V6zm9 5h7v7h-7v-7zM4 15h7v3H4v-3zm9-9h7v3h-7V6z" />
                    </svg>
                    <span>Kategoriler</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.orders') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Siparişler</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.users') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Kullanıcılar</span>
                </a>

                <a href="{{ route('admin.coupons.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.coupons') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Kuponlar</span>
                </a>

                <a href="{{ route('admin.contact-messages.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.contact-messages') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>İletişim Mesajları</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.settings') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM4.5 12a7.5 7.5 0 0 1 .08-1.08L3 9l2-3 2.08.42A7.5 7.5 0 0 1 9 5l1-2h4l1 2a7.5 7.5 0 0 1 1.92.42L19 6l2 3-1.58 1.92c.05.36.08.72.08 1.08s-.03.72-.08 1.08L21 15l-2 3-2.08-.42A7.5 7.5 0 0 1 15 19l-1 2h-4l-1-2a7.5 7.5 0 0 1-1.92-.42L5 18l-2-3 1.58-1.92A7.5 7.5 0 0 1 4.5 12z" />
                    </svg>
                    <span>Site Ayarları</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}"
                   class="{{ $linkClasses }} {{ str_starts_with($routeName, 'admin.profile') ? 'bg-cream text-primary-dark font-semibold' : 'text-cream/80 hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profil Ayarları</span>
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-white/10 text-[11px] flex items-center justify-between">
                <div class="text-cream/60">
                    Giriş yapan:<br>
                    <span class="font-semibold text-cream">{{ auth()->user()->name ?? auth()->user()->email }}</span>
                </div>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-cream text-primary-dark text-xs font-semibold hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17l5-5-5-5M20 12H9m4 7H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h8" />
                        </svg>
                        Çıkış
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1 md:ml-64">
            {{-- Top navbar --}}
            <header class="sticky top-0 z-30 bg-cream/95 backdrop-blur border-b border-cream">
                <div class="px-4 sm:px-6 py-3 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-full border border-primary-dark/20 text-primary-dark"
                            onclick="document.getElementById('admin-sidebar').classList.toggle('-translate-x-full')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                        </button>
                        <div>
                            <div class="text-sm font-semibold text-primary-dark">
                                @yield('page_title', 'Dashboard')
                            </div>
                            <div class="text-[11px] text-slate-500">
                                IstanbulSpice e-ticaret yönetim paneli
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-full border border-primary-dark/20 text-primary-dark text-xs font-medium hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Siteyi Görüntüle
                        </a>
                        <div class="flex items-center gap-2">
                            <div class="text-right hidden sm:block">
                                <div class="text-xs font-semibold text-primary-dark">
                                    {{ auth()->user()->name ?? auth()->user()->email }}
                                </div>
                                <div class="text-[11px] text-slate-500">Admin</div>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-primary-dark text-cream flex items-center justify-center text-xs font-semibold">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="px-4 sm:px-6 py-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-xl bg-primary-dark/10 border border-primary-dark/20 text-primary-dark text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
