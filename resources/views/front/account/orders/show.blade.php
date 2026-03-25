@extends('layouts.account')

@section('title', 'Sipariş ' . $order->order_number)

@section('content')
    <div class="mb-6">
        <a href="{{ route('account.orders.index') }}" class="inline-flex items-center gap-1 text-primary-dark hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Siparişlerime Dön
        </a>
    </div>

    <h1 class="text-2xl font-bold text-primary-dark mb-6">Sipariş {{ $order->order_number }}</h1>

    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-semibold text-slate-800 mb-4">Sipariş Bilgileri</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt class="text-slate-500">Durum</dt><dd><span class="px-2.5 py-1 rounded-lg text-xs font-medium
                    @if($order->status === 'delivered') bg-green-100 text-green-800
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-amber-100 text-amber-800
                    @endif">{{ $order->status_label }}</span></dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Tarih</dt><dd>{{ $order->created_at->format('d.m.Y H:i') }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Ödeme</dt><dd>{{ $order->payment_method ?? '-' }}</dd></div>
            </dl>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-semibold text-slate-800 mb-4">Teslimat Adresi</h3>
            <p class="font-medium">{{ $order->full_name }}</p>
            <p class="text-slate-600 text-sm mt-1">{{ $order->address }}, {{ $order->district }}, {{ $order->city }}</p>
            <p class="text-slate-500 text-sm mt-1">{{ $order->phone }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100"><h3 class="font-semibold text-slate-800">Sipariş Kalemleri</h3></div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 font-medium text-slate-600">Ürün</th>
                        <th class="text-right px-6 py-3 font-medium text-slate-600">Adet</th>
                        <th class="text-right px-6 py-3 font-medium text-slate-600">Fiyat</th>
                        <th class="text-right px-6 py-3 font-medium text-slate-600">Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b border-slate-100">
                            <td class="px-6 py-4">{{ $item->product_name }} @if($item->variant_name)({{ $item->variant_name }})@endif</td>
                            <td class="px-6 py-4 text-right">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format($item->price, 2, ',', '.') }} ₺</td>
                            <td class="px-6 py-4 text-right font-medium">{{ number_format($item->total, 2, ',', '.') }} ₺</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t bg-slate-50/50">
            <div class="max-w-xs ml-auto space-y-1 text-sm">
                <div class="flex justify-between"><span class="text-slate-600">Ara Toplam</span><span>{{ number_format($order->subtotal, 2, ',', '.') }} ₺</span></div>
                <div class="flex justify-between"><span class="text-slate-600">Kargo</span><span>{{ number_format($order->shipping_cost, 2, ',', '.') }} ₺</span></div>
                @if($order->discount > 0)
                    <div class="flex justify-between text-green-600"><span>İndirim</span><span>-{{ number_format($order->discount, 2, ',', '.') }} ₺</span></div>
                @endif
                <div class="flex justify-between font-bold text-lg text-primary-dark pt-2"><span>Toplam</span><span>{{ number_format($order->total, 2, ',', '.') }} ₺</span></div>
            </div>
        </div>
    </div>
@endsection
