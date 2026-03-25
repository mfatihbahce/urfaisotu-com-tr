@extends('admin.layout')

@section('page_title', 'Profil Ayarları')

@section('content')
    <div class="w-full space-y-8">
        {{-- Profil Bilgileri --}}
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
            <h3 class="text-lg font-semibold text-primary-dark mb-4">Profil Bilgileri</h3>
            <form action="{{ route('admin.profile.update') }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Ad Soyad *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">E-posta *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Telefon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark">
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="px-6 py-2 bg-primary-dark text-white rounded-lg hover:bg-primary-dark/90">Kaydet</button>
            </form>
        </div>

        {{-- Şifre Değiştir --}}
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
            <h3 class="text-lg font-semibold text-primary-dark mb-4">Şifre Değiştir</h3>
            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Mevcut Şifre *</label>
                        <input type="password" name="current_password" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark"
                               autocomplete="current-password">
                        @error('current_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Yeni Şifre *</label>
                        <input type="password" name="password" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark"
                               autocomplete="new-password">
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-slate-500 text-xs mt-1">En az 8 karakter olmalıdır.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Yeni Şifre (Tekrar) *</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-primary-dark focus:ring-1 focus:ring-primary-dark"
                               autocomplete="new-password">
                    </div>
                </div>
                <button type="submit" class="px-6 py-2 bg-primary-dark text-white rounded-lg hover:bg-primary-dark/90">Şifreyi Güncelle</button>
            </form>
        </div>
    </div>
@endsection
