@extends('admin.layout')

@section('page_title', 'İletişim Mesajları')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="bg-slate-50 border-b">
                        <th class="text-left px-6 py-3 text-xs font-medium text-slate-600">Tarih</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-slate-600">Ad</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-slate-600">E-posta</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-slate-600">Konu</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-slate-600">Mesaj</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-slate-600">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="border-b hover:bg-slate-50 {{ !$msg->is_read ? 'bg-primary-dark/5' : '' }}">
                            <td class="px-6 py-3 text-sm text-slate-600">{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-3 text-sm text-slate-700">{{ $msg->name }}</td>
                            <td class="px-6 py-3 text-sm">
                                <a href="mailto:{{ $msg->email }}" class="text-primary-dark hover:underline">{{ $msg->email }}</a>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-700">{{ Str::limit($msg->subject, 40) }}</td>
                            <td class="px-6 py-3 text-sm text-slate-600 max-w-xs">{{ Str::limit($msg->message, 60) }}</td>
                            <td class="px-6 py-3 text-right">
                                <a href="{{ route('admin.contact-messages.show', $msg) }}" class="text-primary-dark hover:underline text-sm mr-3">Detay</a>
                                <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="post" class="inline" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-slate-500">Henüz iletişim mesajı yok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $messages->links() }}</div>
    </div>
@endsection
