@extends('admin.layout')

@section('page_title', 'Sipariş Yönetimi')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[700px] table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3 w-[22%]">Sipariş No</th>
                    <th class="text-left px-6 py-3 w-[28%]">Müşteri</th>
                    <th class="text-left px-6 py-3 w-[20%]">Durum</th>
                    <th class="text-right px-6 py-3 w-[15%]">Toplam</th>
                    <th class="text-right px-6 py-3 w-[15%]">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-6 py-3">{{ $order->order_number }}</td>
                        <td class="px-6 py-3">{{ $order->user->name ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $order->status_label }}</td>
                        <td class="px-6 py-3 text-right">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                        <td class="px-6 py-3 text-right"><a href="{{ route('admin.orders.show', $order) }}" class="text-primary-dark hover:underline">Detay</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="p-4">{{ $orders->links() }}</div>
    </div>
@endsection
