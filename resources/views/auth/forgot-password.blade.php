<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Şifremi Unuttum</h2>
        <p class="text-slate-500 text-sm mb-6">E-posta adresinizi girin, size şifre sıfırlama bağlantısı göndereceğiz.</p>

        @if (session('status'))
            <div class="mb-4 px-4 py-3 bg-green-50 text-green-800 rounded-lg text-sm">{{ session('status') }}</div>
        @endif
        @if ($errors->has('email'))
            <div class="mb-4 px-4 py-3 bg-red-50 text-red-800 rounded-lg text-sm">{{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">E-posta</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                       placeholder="ornek@email.com">
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition shadow-lg shadow-primary/25">
                Şifre Sıfırlama Bağlantısı Gönder
            </button>
        </form>

        <a href="{{ route('login') }}" class="mt-6 flex items-center justify-center gap-2 text-sm text-slate-500 hover:text-slate-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Giriş sayfasına dön
        </a>
    </div>
</x-guest-layout>
