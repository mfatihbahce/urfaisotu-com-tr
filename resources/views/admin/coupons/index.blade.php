@extends('admin.layout')

@section('page_title', 'Kupon Yönetimi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Kuponlar</h2>
        <a href="{{ route('admin.coupons.create') }}" class="px-4 py-2 bg-primary-dark text-white rounded-lg">Yeni Kupon</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3 w-[20%]">Kod</th>
                    <th class="text-left px-6 py-3 w-[15%]">Tip</th>
                    <th class="text-right px-6 py-3 w-[15%]">Değer</th>
                    <th class="text-left px-6 py-3 w-[25%]">Geçerlilik</th>
                    <th class="text-right px-6 py-3 w-[25%]">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $c)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-6 py-3 font-mono">{{ $c->code }}</td>
                        <td class="px-6 py-3">{{ $c->type == 'fixed' ? 'Sabit' : 'Yüzde' }}</td>
                        <td class="px-6 py-3 text-right">{{ $c->type == 'fixed' ? number_format($c->value, 2) . ' ₺' : '%' . $c->value }}</td>
                        <td class="px-6 py-3">{{ $c->expires_at ? $c->expires_at->format('d.m.Y') : '-' }}</td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('admin.coupons.edit', $c) }}" class="text-primary-dark hover:underline mr-2">Düzenle</a>
                            <form action="{{ route('admin.coupons.destroy', $c) }}" method="post" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
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
        <div class="p-4">{{ $coupons->links() }}</div>
    </div>
    @if($coupons->isEmpty())
        <p class="text-slate-500 text-center py-8">Henüz kupon yok.</p>
    @endif
@endsection
