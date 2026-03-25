@extends('admin.layout')

@section('page_title', 'Site Ayarları')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="post" class="w-full">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Site Adı</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">İletişim E-posta</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">İletişim Telefon</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Ücretsiz Kargo Eşiği (₺)</label>
                <input type="number" name="free_shipping_threshold" step="0.01" value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold'] ?? '') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Varsayılan Kargo Ücreti (₺)</label>
                <input type="number" name="shipping_base_rate" step="0.01" value="{{ old('shipping_base_rate', $settings['shipping_base_rate'] ?? '') }}" class="w-full rounded-lg border px-3 py-2">
            </div>
        </div>
        <button type="submit" class="mt-4 px-6 py-2 bg-primary-dark text-white rounded-lg">Kaydet</button>
    </form>
@endsection
