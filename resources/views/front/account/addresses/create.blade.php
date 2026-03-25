@extends('layouts.account')

@section('title', 'Adres Ekle')

@section('content')
    <div class="mb-8">
        <a href="{{ route('account.addresses.index') }}" class="inline-flex items-center gap-1 text-primary-dark hover:underline mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Adreslerime Dön
        </a>
        <h1 class="text-2xl font-bold text-primary-dark">Yeni Adres Ekle</h1>
        <p class="text-slate-500 mt-1">Teslimat adresinizi ekleyin</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-2xl">
        <form action="{{ route('account.addresses.store') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Adres Başlığı *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Ev, İş vb." required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('title')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Ad Soyad *</label>
                <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('full_name')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Telefon *</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('phone')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">İl *</label>
                    <input type="text" name="city" value="{{ old('city') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                    @error('city')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">İlçe *</label>
                    <input type="text" name="district" value="{{ old('district') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                    @error('district')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Adres *</label>
                <textarea name="address" rows="3" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">{{ old('address') }}</textarea>
                @error('address')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Posta Kodu</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('postal_code')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}>
                <span class="text-sm text-slate-700">Varsayılan adres olarak ayarla</span>
            </label>
            <div class="flex gap-4 pt-2">
                <button type="submit" class="px-6 py-2.5 bg-primary-dark text-white rounded-xl font-medium hover:bg-primary-dark/90">Kaydet</button>
                <a href="{{ route('account.addresses.index') }}" class="px-6 py-2.5 border border-slate-200 rounded-xl font-medium">İptal</a>
            </div>
        </form>
    </div>
@endsection
