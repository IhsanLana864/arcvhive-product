<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan jumlah produk dan pesanan
        $productCount = Product::count();
        $orderCount = Order::count();

        // Mendapatkan pesanan terbaru
        $latestOrders = Order::latest()->take(5)->get();

        // Mendapatkan produk terlaris
        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        // Rentang tanggal untuk bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Ambil semua tanggal di bulan ini
        $allDates = collect();
        for ($date = $startOfMonth; $date <= $endOfMonth; $date->addDay()) {
            $allDates->push($date->format('Y-m-d'));
        }

        // Ambil data penjualan harian dari tabel order_items
        $salesData = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id') // Gabungkan dengan tabel orders
            ->select(
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_sales')
            )
            ->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('date')
            ->pluck('total_sales', 'date'); // Pluck key-value (date => total_sales)

        // Mapping data agar setiap tanggal ada (isi 0 jika tidak ada data penjualan)
        $dailySales = $allDates->map(function ($date) use ($salesData) {
            return $salesData->get($date, 0); // Jika tidak ada data, gunakan 0
        });

        // Format tanggal untuk grafik
        $dailyLabels = $allDates->map(function ($date) {
            return Carbon::parse($date)->format('d M'); // Format: '27 Nov'
        });

        return view('dashboard.index', [
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'latestOrders' => $latestOrders,
            'topProducts' => $topProducts,
            'dailyLabels' => $dailyLabels,
            'dailySales' => $dailySales,
        ]);
    }
}