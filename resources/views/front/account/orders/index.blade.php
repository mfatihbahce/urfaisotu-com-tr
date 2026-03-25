@extends('layouts.account')

@section('title', 'Siparişlerim')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary-dark">Siparişlerim</h1>
        <p class="text-slate-500 mt-1">Tüm siparişlerinizi görüntüleyin</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6">
            @if($orders->isEmpty())
                <div class="text-center py-16">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-cream flex items-center justify-center text-primary-dark/40">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <p class="text-slate-500">Henüz siparişiniz yok.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-xl text-sm font-medium">Alışverişe Başla</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-y border-slate-100">
                                <th class="text-left py-3 px-6 font-medium text-slate-600">Sipariş No</th>
                                <th class="text-left py-3 px-6 font-medium text-slate-600">Tarih</th>
                                <th class="text-left py-3 px-6 font-medium text-slate-600">Durum</th>
                                <th class="text-right py-3 px-6 font-medium text-slate-600">Toplam</th>
                                <th class="text-right py-3 px-6 font-medium text-slate-600"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="py-4 px-6 font-medium text-slate-800">{{ $order->order_number }}</td>
                                    <td class="py-4 px-6 text-slate-600">{{ $order->created_at->format('d.m.Y') }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium
                                            @if($order->status === 'delivered') bg-green-100 text-green-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-amber-100 text-amber-800
                                            @endif">{{ $order->status_label }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right font-semibold text-primary-dark">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('account.orders.show', $order) }}" class="px-4 py-2 bg-primary-dark text-white rounded-lg text-sm font-medium hover:bg-primary-dark/90">Detay</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $orders->links() }}</div>
            @endif
        </div>
    </div>
@endsection
