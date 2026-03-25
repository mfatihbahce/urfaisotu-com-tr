<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Şifre Onayı</h2>
        <p class="text-slate-500 text-sm mb-6">Devam etmek için şifrenizi girin.</p>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Şifre</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-primary focus:ring-2 focus:ring-primary/20 transition">
                @error('password')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition">
                Onayla
            </button>
        </form>
    </div>
</x-guest-layout>
