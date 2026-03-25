@extends('admin.layout')

@section('page_title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        {{-- İstatistik Kartları --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Toplam Satış</p>
                    <p class="text-xl font-bold text-slate-800 truncate">{{ number_format($stats['total_sales'], 0, ',', '.') }} ₺</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary-dark/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Toplam Sipariş</p>
                    <p class="text-xl font-bold text-slate-800">{{ $stats['total_orders'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Bekleyen Sipariş</p>
                    <p class="text-xl font-bold text-amber-600">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Toplam Müşteri</p>
                    <p class="text-xl font-bold text-slate-800">{{ $stats['total_users'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-gold/20 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M6 12h12M6 17h8"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Toplam Ürün</p>
                    <p class="text-xl font-bold text-slate-800">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        {{-- Grafikler --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-800 mb-4">Satış Performansı</h3>
                <div class="flex gap-2 mb-4">
                    <button type="button" onclick="switchSalesChart(7)" id="chart-7-btn" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-primary-dark text-white">7 Gün</button>
                    <button type="button" onclick="switchSalesChart(30)" id="chart-30-btn" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-slate-200 text-slate-600 hover:bg-slate-300">30 Gün</button>
                </div>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-800 mb-4">Kategori Bazlı Satış</h3>
                <div class="h-64 flex items-center justify-center">
                    @if(!empty($stats['category_sales']['data']) && array_sum($stats['category_sales']['data']) > 0)
                        <canvas id="categoryChart"></canvas>
                    @else
                        <p class="text-slate-400 text-sm">Henüz satış verisi yok</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-800 mb-4">Aylık Sipariş Sayısı (Son 6 Ay)</h3>
                <div class="h-56">
                    <canvas id="monthlyOrdersChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Veri Panelleri --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            {{-- Son Siparişler --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-slate-800">Son Siparişler</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs text-primary-dark hover:underline font-medium">Tümünü Gör →</a>
                </div>
                <div class="overflow-x-auto max-h-72 overflow-y-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50/80 sticky top-0">
                            <tr>
                                <th class="text-left px-4 py-2 text-xs font-medium text-slate-600">Sipariş</th>
                                <th class="text-left px-4 py-2 text-xs font-medium text-slate-600">Müşteri</th>
                                <th class="text-right px-4 py-2 text-xs font-medium text-slate-600">Toplam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['recent_orders'] as $order)
                                <tr class="border-t border-slate-100 hover:bg-slate-50/50">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-dark font-medium hover:underline">{{ $order->order_number }}</a>
                                    </td>
                                    <td class="px-4 py-2 text-slate-700">{{ Str::limit($order->user->name ?? '-', 15) }}</td>
                                    <td class="px-4 py-2 text-right font-medium">{{ number_format($order->total, 0, ',', '.') }} ₺</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-4 py-8 text-center text-slate-400 text-sm">Henüz sipariş yok</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- En Çok Satan Ürünler --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-slate-800">En Çok Satan Ürünler</h3>
                    <a href="{{ route('admin.products.index') }}" class="text-xs text-primary-dark hover:underline font-medium">Tümünü Gör →</a>
                </div>
                <div class="overflow-x-auto max-h-72 overflow-y-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50/80 sticky top-0">
                            <tr>
                                <th class="text-left px-4 py-2 text-xs font-medium text-slate-600">Ürün</th>
                                <th class="text-right px-4 py-2 text-xs font-medium text-slate-600">Satış</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['best_selling_products'] as $item)
                                <tr class="border-t border-slate-100 hover:bg-slate-50/50">
                                    <td class="px-4 py-2 text-slate-700">{{ Str::limit($item->product->name ?? 'Silinmiş ürün', 25) }}</td>
                                    <td class="px-4 py-2 text-right font-medium">{{ $item->total_qty }} adet</td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="px-4 py-8 text-center text-slate-400 text-sm">Henüz satış yok</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Düşük Stok Uyarısı --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                        Stok Uyarısı
                        @if($stats['low_stock_products']->isNotEmpty())
                            <span class="inline-flex items-center rounded-full bg-red-500/20 text-red-700 px-2 py-0.5 text-[10px] font-bold">{{ $stats['low_stock_products']->count() }} ürün</span>
                        @endif
                    </h3>
                    <a href="{{ route('admin.products.index') }}" class="text-xs text-primary-dark hover:underline font-medium">Tümünü Gör →</a>
                </div>
                <div class="overflow-x-auto max-h-72 overflow-y-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50/80 sticky top-0">
                            <tr>
                                <th class="text-left px-4 py-2 text-xs font-medium text-slate-600">Ürün</th>
                                <th class="text-right px-4 py-2 text-xs font-medium text-slate-600">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['low_stock_products'] as $product)
                                <tr class="border-t border-slate-100 {{ $product->stock <= 3 ? 'bg-red-50' : 'hover:bg-amber-50/50' }}">
                                    <td class="px-4 py-2 text-slate-700">{{ Str::limit($product->name, 22) }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <span class="font-bold {{ $product->stock <= 3 ? 'text-red-600' : 'text-amber-600' }}">{{ $product->stock }} adet</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="px-4 py-8 text-center text-slate-400 text-sm">Tüm stoklar yeterli</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Son Kayıt Olan Kullanıcılar --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-slate-800">Son Kayıt Olanlar</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-primary-dark hover:underline font-medium">Tümünü Gör →</a>
                </div>
                <div class="p-4 space-y-3 max-h-72 overflow-y-auto">
                    @forelse($stats['recent_users'] as $user)
                        <div class="flex items-center gap-3 py-2 border-b border-slate-100 last:border-0">
                            <div class="w-9 h-9 rounded-full bg-primary-dark/10 flex items-center justify-center text-primary-dark font-semibold text-sm shrink-0">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-slate-800 truncate">{{ $user->name ?? 'İsimsiz' }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                            </div>
                            <span class="text-[10px] text-slate-400 shrink-0">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="py-8 text-center text-slate-400 text-sm">Henüz kullanıcı yok</p>
                    @endforelse
                </div>
            </div>

            {{-- Son İletişim Mesajları --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                        İletişim Mesajları
                        @if($stats['unread_contact_messages'] > 0)
                            <span class="inline-flex items-center rounded-full bg-amber-500/20 text-amber-700 px-2 py-0.5 text-[10px] font-bold">{{ $stats['unread_contact_messages'] }} okunmamış</span>
                        @endif
                    </h3>
                    <a href="{{ route('admin.contact-messages.index') }}" class="text-xs text-primary-dark hover:underline font-medium">Tümünü Gör →</a>
                </div>
                <div class="p-4 space-y-3 max-h-72 overflow-y-auto">
                    @forelse($stats['recent_contact_messages'] as $msg)
                        <a href="{{ route('admin.contact-messages.show', $msg) }}" class="block py-2 border-b border-slate-100 last:border-0 hover:bg-slate-50 rounded-lg px-2 -mx-2 transition {{ !$msg->is_read ? 'bg-primary-dark/5' : '' }}">
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $msg->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Str::limit($msg->subject, 35) }}</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">{{ $msg->created_at->format('d.m.Y H:i') }}</p>
                        </a>
                    @empty
                        <p class="py-8 text-center text-slate-400 text-sm">Henüz mesaj yok</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salesData7 = @json($stats['sales_chart_7']);
            const salesData30 = @json($stats['sales_chart_30']);
            const monthlyData = @json($stats['monthly_orders']);
            const categoryData = @json($stats['category_sales']);

            const chartColors = {
                primary: 'rgb(11, 61, 46)',
                primaryLight: 'rgba(11, 61, 46, 0.1)',
                emerald: 'rgb(16, 185, 129)',
                emeraldLight: 'rgba(16, 185, 129, 0.2)',
                palette: ['#0b3d2e', '#0d9488', '#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#d4af37', '#f59e0b']
            };

            let salesChart = new Chart(document.getElementById('salesChart'), {
                type: 'line',
                data: {
                    labels: salesData7.labels,
                    datasets: [{
                        label: 'Satış (₺)',
                        data: salesData7.data,
                        borderColor: chartColors.primary,
                        backgroundColor: chartColors.emeraldLight,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            function switchSalesChart(days) {
                const data = days === 7 ? salesData7 : salesData30;
                salesChart.data.labels = data.labels;
                salesChart.data.datasets[0].data = data.data;
                salesChart.update();
                document.getElementById('chart-7-btn').className = days === 7
                    ? 'px-3 py-1.5 text-xs font-medium rounded-lg bg-primary-dark text-white'
                    : 'px-3 py-1.5 text-xs font-medium rounded-lg bg-slate-200 text-slate-600 hover:bg-slate-300';
                document.getElementById('chart-30-btn').className = days === 30
                    ? 'px-3 py-1.5 text-xs font-medium rounded-lg bg-primary-dark text-white'
                    : 'px-3 py-1.5 text-xs font-medium rounded-lg bg-slate-200 text-slate-600 hover:bg-slate-300';
            }
            window.switchSalesChart = switchSalesChart;

            new Chart(document.getElementById('monthlyOrdersChart'), {
                type: 'bar',
                data: {
                    labels: monthlyData.labels,
                    datasets: [{
                        label: 'Sipariş Sayısı',
                        data: monthlyData.data,
                        backgroundColor: chartColors.emeraldLight,
                        borderColor: chartColors.emerald,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            @if(!empty($stats['category_sales']['data']) && array_sum($stats['category_sales']['data']) > 0)
            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: categoryData.labels,
                    datasets: [{
                        data: categoryData.data,
                        backgroundColor: chartColors.palette,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
            @endif
        });
    </script>
@endsection
