@php
    $current = Route::currentRouteName();
    $menuItems = [
        ['route' => 'account.index', 'label' => 'Dashboard', 'icon' => 'dashboard'],
        ['route' => 'account.orders.index', 'label' => 'Siparişlerim', 'icon' => 'orders'],
        ['route' => 'account.favorites.index', 'label' => 'Favorilerim', 'icon' => 'favorites'],
        ['route' => 'account.addresses.index', 'label' => 'Adreslerim', 'icon' => 'addresses'],
        ['route' => 'account.profile', 'label' => 'Hesap Bilgilerim', 'icon' => 'profile'],
        ['route' => 'account.password', 'label' => 'Şifre Değiştir', 'icon' => 'password'],
    ];
@endphp
<aside id="account-sidebar" class="fixed lg:sticky top-16 left-0 z-30 w-72 h-[calc(100vh-4rem)] lg:h-auto bg-white rounded-r-2xl lg:rounded-2xl shadow-lg lg:shadow-sm border border-slate-100 -translate-x-full lg:translate-x-0 transition-transform duration-200 overflow-y-auto">
    <div class="p-6 border-b border-slate-100">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-primary-dark text-cream flex items-center justify-center text-xl font-bold flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                <p class="text-sm text-slate-500 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
    <nav class="p-4 space-y-1">
        @foreach($menuItems as $item)
            <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ ($current === $item['route'] || str_starts_with($current, str_replace('.index', '', $item['route']) . '.')) ? 'bg-primary-dark/10 text-primary-dark' : 'text-slate-600 hover:bg-slate-50' }}">
                @if($item['icon'] === 'dashboard')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                @elseif($item['icon'] === 'orders')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                @elseif($item['icon'] === 'favorites')
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                @elseif($item['icon'] === 'addresses')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                @elseif($item['icon'] === 'profile')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                @else
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                @endif
                {{ $item['label'] }}
            </a>
        @endforeach
        <hr class="my-4 border-slate-100">
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Çıkış Yap
            </button>
        </form>
    </nav>
</aside>
