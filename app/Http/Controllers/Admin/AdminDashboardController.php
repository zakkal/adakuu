<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $paidOrders = Order::where('order_status', 'PAID')->count();
        $processingOrders = Order::where('order_status', 'PROCESSING')->count();
        $completedOrders = Order::where('order_status', 'COMPLETED')->count();

        $successStatuses = ['PAID', 'PROCESSING', 'COMPLETED'];

        $omzetKotor = Order::whereIn('order_status', $successStatuses)->sum('total_amount');

        $totalCostPrice = Order::whereIn('order_status', $successStatuses)
            ->join('packages', 'orders.package_id', '=', 'packages.id')
            ->sum('packages.cost_price');

        $omzetBersih = $omzetKotor - $totalCostPrice;

        $totalProducts = Product::count();

        // Monthly sales data for chart (last 12 months)
        $monthlySales = Order::whereIn('order_status', $successStatuses)
            ->where('created_at', '>=', now()->subMonths(12)->startOfMonth())
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_amount) as revenue, COUNT(*) as order_count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyCost = Order::whereIn('order_status', $successStatuses)
            ->where('orders.created_at', '>=', now()->subMonths(12)->startOfMonth())
            ->join('packages', 'orders.package_id', '=', 'packages.id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m') as month, SUM(packages.cost_price) as total_cost")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $chartLabels = $monthlySales->pluck('month')->map(function ($m) use ($monthNames) {
            $parts = explode('-', $m);

            return $monthNames[(int) $parts[1] - 1];
        });
        $chartRevenue = $monthlySales->pluck('revenue');
        $chartProfit = $monthlySales->map(function ($item) use ($monthlyCost) {
            $cost = $monthlyCost->get($item->month)?->total_cost ?? 0;

            return $item->revenue - $cost;
        });
        $chartOrderCount = $monthlySales->pluck('order_count');

        $recentOrders = Order::with('package.product')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'paidOrders', 'processingOrders', 'completedOrders',
            'omzetKotor', 'omzetBersih', 'totalProducts',
            'chartLabels', 'chartRevenue', 'chartProfit', 'chartOrderCount',
            'recentOrders'
        ));
    }
}
