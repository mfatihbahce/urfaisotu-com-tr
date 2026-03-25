@extends('admin.layout')

@section('page_title', 'Kupon ' . $coupon->code)

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-cream p-6">
        <p><strong>Kod:</strong> {{ $coupon->code }}</p>
        <p><strong>Tip:</strong> {{ $coupon->type }}</p>
        <p><strong>Değer:</strong> {{ $coupon->value }}</p>
        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="inline-block mt-4 px-4 py-2 bg-primary-dark text-white rounded-lg">Düzenle</a>
    </div>
@endsection
