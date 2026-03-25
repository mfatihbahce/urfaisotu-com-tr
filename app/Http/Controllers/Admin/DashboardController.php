<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $completedStatuses = [Order::STATUS_PAID, Order::STATUS_PREPARING, Order::STATUS_SHIPPED, Order::STATUS_DELIVERED];

        $stats = [
            'total_sales' => Order::whereIn('status', $completedStatuses)->sum('total'),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'recent_orders' => Order::with('user')->latest()->limit(8)->get(),
            'recent_contact_messages' => ContactMessage::latest()->limit(5)->get(),
            'unread_contact_messages' => ContactMessage::where('is_read', false)->count(),
            'recent_users' => User::latest()->limit(5)->get(),
            'low_stock_threshold' => 10,
        ];

        $stats['low_stock_products'] = Product::where('stock', '<=', $stats['low_stock_threshold'])
            ->where('stock', '>=', 0)
            ->with('category')
            ->orderBy('stock')
            ->limit(8)
            ->get();

        $stats['best_selling_products'] = OrderItem::select('order_items.product_id', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.status', $completedStatuses)
            ->groupBy('order_items.product_id')
            ->orderByDesc('total_qty')
            ->limit(8)
            ->get()
            ->load('product');

        $stats['sales_chart_7'] = $this->getSalesChartData(7);
        $stats['sales_chart_30'] = $this->getSalesChartData(30);
        $stats['monthly_orders'] = $this->getMonthlyOrdersData(6);
        $stats['category_sales'] = $this->getCategorySalesData();

        return view('admin.dashboard', compact('stats'));
    }

    protected function getSalesChartData(int $days): array
    {
        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d.m');
            $data[] = (float) Order::whereIn('status', [Order::STATUS_PAID, Order::STATUS_PREPARING, Order::STATUS_SHIPPED, Order::STATUS_DELIVERED])
                ->whereDate('created_at', $date)
                ->sum('total');
        }
        return ['labels' => $labels, 'data' => $data];
    }

    protected function getMonthlyOrdersData(int $months): array
    {
        $labels = [];
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->translatedFormat('M Y');
            $data[] = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }
        return ['labels' => $labels, 'data' => $data];
    }

    protected function getCategorySalesData(): array
    {
        $items = OrderItem::select('products.category_id', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.status', [Order::STATUS_PAID, Order::STATUS_PREPARING, Order::STATUS_SHIPPED, Order::STATUS_DELIVERED])
            ->whereNotNull('products.category_id')
            ->groupBy('products.category_id')
            ->get();

        $labels = [];
        $data = [];
        foreach ($items as $item) {
            $cat = Category::find($item->category_id);
            $labels[] = $cat?->name ?? 'Bilinmeyen';
            $data[] = (int) $item->total_qty;
        }
        return ['labels' => $labels, 'data' => $data];
    }
}
