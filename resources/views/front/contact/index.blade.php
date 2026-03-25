@extends('layouts.front')

@section('title', 'İletişim - ' . config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold text-slate-800 mb-6">İletişim</h1>
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-4">Bize Ulaşın</h3>
            <p class="text-slate-600">{{ \App\Models\Setting::get('contact_address') }}</p>
            <p class="text-slate-600 mt-2">{{ \App\Models\Setting::get('contact_phone') }}</p>
            <p class="text-slate-600">{{ \App\Models\Setting::get('contact_email') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-4">İletişim Formu</h3>
            <form action="{{ route('contact.store') }}" method="post" class="space-y-4">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ad Soyad" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="E-posta" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Konu" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <textarea name="message" rows="4" placeholder="Mesajınız" required class="w-full rounded-lg border border-slate-200 px-3 py-2">{{ old('message') }}</textarea>
                <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark">Gönder</button>
            </form>
        </div>
    </div>
@endsection
