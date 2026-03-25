@extends('layouts.account')

@section('title', 'Hesap Bilgilerim')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary-dark">Hesap Bilgilerim</h1>
        <p class="text-slate-500 mt-1">Ad, e-posta ve telefon bilgilerinizi güncelleyin</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-2xl">
        <form action="{{ route('account.profile.update') }}" method="post" class="space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Ad Soyad *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('name')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">E-posta *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('email')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Telefon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('phone')<p class="text-rose-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary-dark text-white rounded-xl font-medium hover:bg-primary-dark/90">Kaydet</button>
        </form>
    </div>
@endsection
