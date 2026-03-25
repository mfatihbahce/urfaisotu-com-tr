@extends('admin.layout')

@section('page_title', 'Yeni Kupon')

@section('content')
    <form action="{{ route('admin.coupons.store') }}" method="post" class="w-full space-y-4">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Kupon Kodu *</label>
                <input type="text" name="code" value="{{ old('code') }}" required class="w-full rounded-lg border px-3 py-2" placeholder="HOSGELDIN">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Tip</label>
                    <select name="type" class="w-full rounded-lg border px-3 py-2">
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Sabit Tutar</option>
                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Yüzde</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Değer *</label>
                    <input type="number" name="value" step="0.01" value="{{ old('value') }}" required class="w-full rounded-lg border px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Min. Sipariş Tutarı</label>
                <input type="number" name="min_order_amount" step="0.01" value="{{ old('min_order_amount') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
            </div>
        </div>
        <button type="submit" class="px-6 py-2 bg-primary-dark text-white rounded-lg">Kaydet</button>
    </form>
@endsection
