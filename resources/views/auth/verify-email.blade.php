<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">E-posta Doğrulama</h2>
        <p class="text-slate-500 text-sm mb-6">Kayıt olduğunuz e-posta adresine gönderilen bağlantıya tıklayarak hesabınızı doğrulayın.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 px-4 py-3 bg-green-50 text-green-800 rounded-lg text-sm">
                Yeni doğrulama bağlantısı e-posta adresinize gönderildi.
            </div>
        @endif

        <div class="flex flex-col sm:flex-row gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition">
                    Doğrulama E-postası Gönder
                </button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-slate-500 hover:text-slate-700 text-sm font-medium">
                    Çıkış Yap
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
