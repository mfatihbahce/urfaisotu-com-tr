@extends('layouts.front')

@section('title', 'Sepetim - ' . config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Sepetim</h1>
    @if($cart->items->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <p class="text-slate-600 mb-4">Sepetiniz boş.</p>
            <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark">Alışverişe Başla</a>
        </div>
    @else
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-4">
                @foreach($cart->items as $item)
                    <div class="bg-white rounded-xl shadow-sm p-4 flex gap-4">
                        <div class="w-20 h-20 bg-slate-100 rounded-lg flex-shrink-0 flex items-center justify-center text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-slate-800">{{ $item->product->name }}</h3>
                            @if($item->productVariant)
                                <p class="text-sm text-slate-500">{{ $item->productVariant->name }}</p>
                            @endif
                            <p class="text-primary font-semibold">{{ number_format($item->price, 2, ',', '.') }} ₺</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.update') }}" method="post" class="flex items-center gap-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99" class="w-14 rounded border border-slate-200 px-2 py-1 text-sm" onchange="this.form.submit()">
                            </form>
                            <form action="{{ route('cart.remove') }}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Kaldır">&times;</button>
                            </form>
                        </div>
                        <div class="text-right font-semibold">{{ number_format($item->quantity * $item->price, 2, ',', '.') }} ₺</div>
                    </div>
                @endforeach
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h3 class="font-semibold text-slate-800 mb-4">Sipariş Özeti</h3>
                    <div class="space-y-2 text-slate-600">
                        <div class="flex justify-between"><span>Ara Toplam</span><span>{{ number_format($cart->subtotal, 2, ',', '.') }} ₺</span></div>
                    </div>
                    <p class="text-sm text-slate-500 mt-4">Kargo ve indirim ödeme sayfasında hesaplanacaktır.</p>
                    <a href="{{ route('checkout.index') }}" class="mt-6 block w-full py-3 bg-primary text-white text-center font-semibold rounded-lg hover:bg-primary-dark">Ödemeye Geç</a>
                    @guest
                        <p class="text-xs text-slate-500 mt-2">Ödeme için <a href="{{ route('login') }}" class="text-primary underline">giriş yapın</a></p>
                    @endguest
                </div>
            </div>
        </div>
    @endif
@endsection
