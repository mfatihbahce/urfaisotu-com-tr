@extends('admin.layout')

@section('page_title', 'Mesaj Detayı')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-primary-dark hover:underline text-sm">← İletişim Mesajlarına Dön</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Gönderen</label>
                    <p class="text-slate-800 font-medium">{{ $contactMessage->name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">E-posta</label>
                    <a href="mailto:{{ $contactMessage->email }}" class="text-primary-dark hover:underline">{{ $contactMessage->email }}</a>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Tarih</label>
                    <p class="text-slate-800">{{ $contactMessage->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Konu</label>
                    <p class="text-slate-800">{{ $contactMessage->subject }}</p>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1">Mesaj</label>
                <div class="bg-slate-50 rounded-lg p-4 text-slate-800 whitespace-pre-wrap">{{ $contactMessage->message }}</div>
            </div>
            <div class="flex gap-3 pt-4 border-t border-cream">
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ rawurlencode($contactMessage->subject) }}" class="px-4 py-2 bg-primary-dark text-white rounded-lg hover:bg-primary-dark/90 text-sm">Yanıtla</a>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="post" class="inline" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">Sil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
