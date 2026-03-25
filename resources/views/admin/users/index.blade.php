@extends('admin.layout')

@section('page_title', 'Kullanıcı Yönetimi')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-cream overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[500px] table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="text-left px-6 py-3 w-[30%]">Ad</th>
                    <th class="text-left px-6 py-3 w-[45%]">E-posta</th>
                    <th class="text-left px-6 py-3 w-[25%]">Kayıt</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-6 py-3">{{ $u->name }}</td>
                        <td class="px-6 py-3">{{ $u->email }}</td>
                        <td class="px-6 py-3">{{ $u->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="p-4">{{ $users->links() }}</div>
    </div>
@endsection
