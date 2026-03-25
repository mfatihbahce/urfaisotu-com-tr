@extends('layouts.account')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary-dark">Dashboard</h1>
        <p class="text-slate-500 mt-1">Hesap özetinize hoş geldiniz</p>
    </div>

    {{-- İstatistik kartları --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary-dark/10 flex items-center justify-center text-primary-dark">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $totalOrders }}</p>
                <p class="text-sm text-slate-500">Toplam Sipariş</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $pendingOrders }}</p>
                <p class="text-sm text-slate-500">Bekleyen</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $completedOrders }}</p>
                <p class="text-sm text-slate-500">Tamamlanan</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $favoritesCount }}</p>
                <p class="text-sm text-slate-500">Favori Ürün</p>
            </div>
        </div>
    </div>

    {{-- Son siparişler --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Son Siparişler</h2>
            <a href="{{ route('account.orders.index') }}" class="text-primary-dark hover:underline text-sm font-medium">Tümünü Gör</a>
        </div>
        <div class="p-6">
            @if($orders->isEmpty())
                <div class="text-center py-12 text-slate-500">
                    <p>Henüz siparişiniz yok.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-xl text-sm font-medium">Alışverişe Başla</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-y border-slate-100">
                                <th class="text-left py-3 px-4 font-medium text-slate-600">Sipariş No</th>
                                <th class="text-left py-3 px-4 font-medium text-slate-600">Tarih</th>
                                <th class="text-left py-3 px-4 font-medium text-slate-600">Durum</th>
                                <th class="text-right py-3 px-4 font-medium text-slate-600">Toplam</th>
                                <th class="text-right py-3 px-4 font-medium text-slate-600"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="py-4 px-4 font-medium">{{ $order->order_number }}</td>
                                    <td class="py-4 px-4">{{ $order->created_at->format('d.m.Y') }}</td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium
                                            @if($order->status === 'delivered') bg-green-100 text-green-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-amber-100 text-amber-800
                                            @endif">{{ $order->status_label }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-right font-semibold text-primary-dark">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                                    <td class="py-4 px-4 text-right">
                                        <a href="{{ route('account.orders.show', $order) }}" class="text-primary-dark hover:underline font-medium">Detay</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
