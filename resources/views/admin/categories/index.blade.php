@extends('admin.layout')

@section('page_title', 'Kategori Yönetimi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Kategoriler</h2>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-primary-dark text-white rounded-lg">Yeni Kategori</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3 w-[30%]">Ad</th>
                    <th class="text-left px-6 py-3 w-[30%]">Slug</th>
                    <th class="text-left px-6 py-3 w-[25%]">Üst Kategori</th>
                    <th class="text-right px-6 py-3 w-[15%]">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-6 py-3">{{ $c->name }}</td>
                        <td class="px-6 py-3">{{ $c->slug }}</td>
                        <td class="px-6 py-3">{{ $c->parent->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('admin.categories.edit', $c) }}" class="text-primary-dark hover:underline mr-2">Düzenle</a>
                            <form action="{{ route('admin.categories.destroy', $c) }}" method="post" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
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
        <div class="p-4">{{ $categories->links() }}</div>
    </div>
@endsection
