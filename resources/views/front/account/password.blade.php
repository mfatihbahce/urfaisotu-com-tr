@extends('layouts.account')

@section('title', 'Şifre Değiştir')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary-dark">Şifre Değiştir</h1>
        <p class="text-slate-500 mt-1">Hesap güvenliğiniz için güçlü bir şifre kullanın</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-2xl">
        <form action="{{ route('account.password.update') }}" method="post" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Mevcut Şifre *</label>
                <input type="password" name="current_password" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5" autocomplete="current-password">
                @error('current_password')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Yeni Şifre *</label>
                <input type="password" name="password" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5" autocomplete="new-password">
                @error('password')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">En az 8 karakter</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Yeni Şifre (Tekrar) *</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5" autocomplete="new-password">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary-dark text-white rounded-xl font-medium hover:bg-primary-dark/90">Şifreyi Güncelle</button>
        </form>
    </div>
@endsection
