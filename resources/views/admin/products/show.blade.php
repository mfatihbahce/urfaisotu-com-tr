@extends('admin.layout')

@section('page_title', $product->name)

@section('content')
    <div class="mb-4"><a href="{{ route('admin.products.index') }}" class="text-primary-dark hover:underline">← Ürünlere Dön</a></div>
    <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
        <h2 class="text-xl font-semibold mb-4">{{ $product->name }}</h2>
        <p class="text-slate-600">SKU: {{ $product->sku }} | Kategori: {{ $product->category->name }}</p>
        <p class="mt-2">Fiyat: {{ number_format($product->price, 2, ',', '.') }} ₺ @if($product->sale_price)| İndirimli: {{ number_format($product->sale_price, 2, ',', '.') }} ₺@endif</p>
        <p class="mt-2">Stok: {{ $product->stock }}</p>

        @if($product->variants->isNotEmpty())
            <div class="mt-4">
                <h3 class="font-medium text-slate-800 mb-2">Seçenekler</h3>
                <table class="w-full text-sm border border-slate-200 rounded-lg overflow-hidden">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-3 py-2 text-left">Ad</th>
                            <th class="px-3 py-2 text-left">SKU</th>
                            <th class="px-3 py-2 text-right">Fiyat</th>
                            <th class="px-3 py-2 text-right">İndirimli</th>
                            <th class="px-3 py-2 text-right">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->variants as $v)
                            <tr class="border-t border-slate-200">
                                <td class="px-3 py-2">{{ $v->name }}</td>
                                <td class="px-3 py-2">{{ $v->sku ?? '-' }}</td>
                                <td class="px-3 py-2 text-right">{{ number_format($v->price, 2, ',', '.') }} ₺</td>
                                <td class="px-3 py-2 text-right">{{ $v->sale_price ? number_format($v->sale_price, 2, ',', '.') . ' ₺' : '-' }}</td>
                                <td class="px-3 py-2 text-right">{{ $v->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('admin.products.edit', $product) }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-lg">Düzenle</a>
    </div>
@endsection
