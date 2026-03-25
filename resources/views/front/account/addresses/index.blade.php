@extends('layouts.account')

@section('title', 'Adreslerim')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Adreslerim</h1>
            <p class="text-slate-500 mt-1">Teslimat adreslerinizi yönetin</p>
        </div>
        <a href="{{ route('account.addresses.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-dark text-white rounded-xl font-medium hover:bg-primary-dark/90">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Adres Ekle
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        @if($addresses->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-cream flex items-center justify-center text-primary-dark/40">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <p class="text-slate-500">Kayıtlı adresiniz yok.</p>
                <a href="{{ route('account.addresses.create') }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-xl text-sm font-medium">Adres Ekle</a>
            </div>
        @else
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($addresses as $addr)
                    <div class="p-5 rounded-xl border border-slate-100 hover:border-primary-dark/20 transition-colors relative group">
                        @if($addr->is_default)
                            <span class="inline-block mb-2 px-2 py-0.5 bg-amber-100 text-amber-800 text-xs font-medium rounded">Varsayılan</span>
                        @endif
                        <p class="font-semibold text-slate-800">{{ $addr->full_name }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $addr->title }}</p>
                        <p class="text-sm text-slate-600 mt-2">{{ $addr->full_address }}</p>
                        @if($addr->phone)
                            <p class="text-xs text-slate-500 mt-1">{{ $addr->phone }}</p>
                        @endif
                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('account.addresses.edit', $addr) }}" class="text-sm text-primary-dark hover:underline font-medium">Düzenle</a>
                            <form action="{{ route('account.addresses.destroy', $addr) }}" method="post" onsubmit="return confirm('Bu adresi silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-rose-600 hover:underline font-medium">Sil</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
