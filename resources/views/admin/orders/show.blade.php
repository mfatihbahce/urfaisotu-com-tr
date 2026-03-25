@extends('admin.layout')

@section('page_title', 'Sipariş ' . $order->order_number)

@section('content')
    <div class="mb-4"><a href="{{ route('admin.orders.index') }}" class="text-primary-dark hover:underline">← Siparişlere Dön</a></div>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
            <h3 class="font-semibold mb-4">Sipariş Bilgileri</h3>
            <p><strong>Sipariş No:</strong> {{ $order->order_number }}</p>
            <p><strong>Durum:</strong> {{ $order->status_label }}</p>
            <p><strong>Tarih:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Ödeme:</strong> {{ $order->payment_method }}</p>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="post" class="mt-4 flex gap-2">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-lg border px-3 py-2">
                    @foreach([\App\Models\Order::STATUS_PENDING, \App\Models\Order::STATUS_PAID, \App\Models\Order::STATUS_PREPARING, \App\Models\Order::STATUS_SHIPPED, \App\Models\Order::STATUS_DELIVERED, \App\Models\Order::STATUS_CANCELLED] as $s)
                        <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ match($s) { 'pending'=>'Beklemede', 'paid'=>'Ödeme Alındı', 'preparing'=>'Hazırlanıyor', 'shipped'=>'Kargoya Verildi', 'delivered'=>'Teslim Edildi', 'cancelled'=>'İptal', default=>$s } }}</option>
                    @endforeach
                </select>
                <input type="text" name="shipping_tracking" value="{{ $order->shipping_tracking }}" placeholder="Kargo Takip" class="rounded-lg border px-3 py-2">
                <button type="submit" class="px-4 py-2 bg-primary-dark text-white rounded-lg">Güncelle</button>
            </form>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
            <h3 class="font-semibold mb-4">Teslimat Adresi</h3>
            <p>{{ $order->full_name }}</p>
            <p>{{ $order->address }}, {{ $order->district }}, {{ $order->city }}</p>
            <p>{{ $order->phone }}</p>
        </div>
    </div>
    <div class="mt-6 bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="px-6 py-4 border-b"><h3 class="font-semibold">Sipariş Kalemleri</h3></div>
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3">Ürün</th>
                    <th class="text-right px-6 py-3">Adet</th>
                    <th class="text-right px-6 py-3">Fiyat</th>
                    <th class="text-right px-6 py-3">Toplam</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="border-b">
                        <td class="px-6 py-3">{{ $item->product_name }} @if($item->variant_name)({{ $item->variant_name }})@endif</td>
                        <td class="px-6 py-3 text-right">{{ $item->quantity }}</td>
                        <td class="px-6 py-3 text-right">{{ number_format($item->price, 2, ',', '.') }} ₺</td>
                        <td class="px-6 py-3 text-right">{{ number_format($item->total, 2, ',', '.') }} ₺</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t flex justify-end">
            <div class="text-right space-y-1">
                <p>Ara Toplam: {{ number_format($order->subtotal, 2, ',', '.') }} ₺</p>
                <p>Kargo: {{ number_format($order->shipping_cost, 2, ',', '.') }} ₺</p>
                @if($order->discount > 0)<p class="text-green-600">İndirim: -{{ number_format($order->discount, 2, ',', '.') }} ₺</p>@endif
                <p class="font-bold text-lg">Toplam: {{ number_format($order->total, 2, ',', '.') }} ₺</p>
            </div>
        </div>
    </div>
@endsection
