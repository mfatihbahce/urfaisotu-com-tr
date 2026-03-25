@extends('admin.layout')

@section('page_title', 'Yeni Kategori')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post" class="w-full space-y-4">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Üst Kategori</label>
                <select name="parent_id" class="w-full rounded-lg border px-3 py-2">
                    <option value="">Yok</option>
                    @foreach($parentCategories as $c)
                        <option value="{{ $c->id }}" {{ old('parent_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Ad *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Açıklama</label>
                <textarea name="description" rows="2" class="w-full rounded-lg border px-3 py-2">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
            </div>
        </div>
        <button type="submit" class="px-6 py-2 bg-primary-dark text-white rounded-lg">Kaydet</button>
    </form>
@endsection
