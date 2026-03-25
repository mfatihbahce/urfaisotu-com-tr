<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Yeni Şifre Belirle</h2>
        <p class="text-slate-500 text-sm mb-6">Yeni şifrenizi girin</p>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">E-posta</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-primary focus:ring-2 focus:ring-primary/20 transition">
                @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Yeni Şifre</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-primary focus:ring-2 focus:ring-primary/20 transition">
                @error('password')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Şifre Tekrar</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-primary focus:ring-2 focus:ring-primary/20 transition">
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition">
                Şifreyi Sıfırla
            </button>
        </form>
    </div>
</x-guest-layout>
