<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Giriş Yap</h2>
        <p class="text-slate-500 text-sm mb-6">Hesabınıza giriş yapın veya admin paneline erişin</p>

        @if (session('status'))
            <div class="mb-4 px-4 py-3 bg-green-50 text-green-800 rounded-lg text-sm">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">E-posta</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                       placeholder="ornek@email.com">
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Şifre</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                       placeholder="••••••••">
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="remember"
                           class="rounded border-slate-300 text-primary focus:ring-primary/50">
                    <span class="ml-2 text-sm text-slate-600">Beni hatırla</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary-dark font-medium">
                        Şifremi unuttum
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition shadow-lg shadow-primary/25">
                Giriş Yap
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Hesabınız yok mu?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-primary-dark">Kayıt olun</a>
        </p>

        <a href="{{ route('home') }}" class="mt-4 flex items-center justify-center gap-2 text-sm text-slate-500 hover:text-slate-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Ana sayfaya dön
        </a>
    </div>
</x-guest-layout>
