@extends('admin.layout')

@section('page_title', 'Ürün Yönetimi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Ürünler</h2>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-primary-dark text-white rounded-lg">Yeni Ürün</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3 w-[28%]">Ürün</th>
                    <th class="text-left px-6 py-3 w-[15%]">Kategori</th>
                    <th class="text-left px-6 py-3 w-[12%]">SKU</th>
                    <th class="text-right px-6 py-3 w-[12%]">Fiyat</th>
                    <th class="text-right px-6 py-3 w-[10%]">Stok</th>
                    <th class="text-right px-6 py-3 w-[15%]">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-6 py-3">{{ $p->name }}</td>
                        <td class="px-6 py-3">{{ $p->category->name ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $p->sku }}</td>
                        <td class="px-6 py-3 text-right">{{ number_format($p->price, 2, ',', '.') }} ₺</td>
                        <td class="px-6 py-3 text-right">{{ $p->stock }}</td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('admin.products.edit', $p) }}" class="text-primary-dark hover:underline mr-2">Düzenle</a>
                            <form action="{{ route('admin.products.destroy', $p) }}" method="post" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="p-4">{{ $products->links() }}</div>
    </div>
@endsection
