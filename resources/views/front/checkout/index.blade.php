@extends('layouts.front')

@section('title', 'Ödeme - ' . config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Ödeme</h1>
    <form action="{{ route('checkout.store') }}" method="post" class="grid md:grid-cols-3 gap-8">
        @csrf
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-slate-800 mb-4">Teslimat Adresi</h3>
                @if($addresses->isNotEmpty())
                    @foreach($addresses as $addr)
                        <label class="flex items-start gap-3 p-3 border rounded-lg cursor-pointer mb-2 hover:border-primary">
                            <input type="radio" name="address_id" value="{{ $addr->id }}" {{ $addr->is_default ? 'checked' : '' }}>
                            <div>
                                <p class="font-medium">{{ $addr->full_name }}</p>
                                <p class="text-sm text-slate-500">{{ $addr->full_address }}</p>
                                <p class="text-sm text-slate-500">{{ $addr->phone }}</p>
                            </div>
                        </label>
                    @endforeach
                @endif
                <p class="text-sm text-slate-600 mt-2">Yeni adres girin:</p>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" placeholder="Ad Soyad" required class="rounded-lg border border-slate-200 px-3 py-2">
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="Telefon" required class="rounded-lg border border-slate-200 px-3 py-2">
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="E-posta" required class="rounded-lg border border-slate-200 px-3 py-2">
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="İl" required class="rounded-lg border border-slate-200 px-3 py-2">
                    <input type="text" name="district" value="{{ old('district') }}" placeholder="İlçe" required class="rounded-lg border border-slate-200 px-3 py-2">
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="Posta Kodu" class="rounded-lg border border-slate-200 px-3 py-2 md:col-span-2">
                    <textarea name="address" rows="2" placeholder="Açık adres" required class="rounded-lg border border-slate-200 px-3 py-2 md:col-span-2">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-slate-800 mb-4">Ödeme Yöntemi</h3>
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer mb-2"><input type="radio" name="payment_method" value="cash_on_delivery" checked> Kapıda Ödeme</label>
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer mb-2"><input type="radio" name="payment_method" value="credit_card"> Kredi Kartı</label>
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer"><input type="radio" name="payment_method" value="bank_transfer"> Havale / EFT</label>
                <textarea name="notes" rows="2" placeholder="Sipariş notu (isteğe bağlı)" class="mt-4 w-full rounded-lg border border-slate-200 px-3 py-2"></textarea>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h3 class="font-semibold text-slate-800 mb-4">Sipariş Özeti</h3>
                <div class="space-y-2 text-slate-600">
                    <div class="flex justify-between"><span>Ara Toplam</span><span>{{ number_format($subtotal, 2, ',', '.') }} ₺</span></div>
                    <div class="flex justify-between"><span>Kargo</span><span>{{ number_format($shippingCost, 2, ',', '.') }} ₺</span></div>
                    @if($discount > 0)
                        <div class="flex justify-between text-green-600"><span>İndirim</span><span>-{{ number_format($discount, 2, ',', '.') }} ₺</span></div>
                    @endif
                </div>
                <div class="flex justify-between font-bold text-slate-800 mt-4 pt-4 border-t">
                    <span>Toplam</span><span>{{ number_format($total, 2, ',', '.') }} ₺</span>
                </div>
                <button type="submit" class="mt-6 w-full py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark">Siparişi Tamamla</button>
            </div>
        </div>
    </form>
@endsection
