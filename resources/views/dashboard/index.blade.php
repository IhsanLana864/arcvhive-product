@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Statistik Produk -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-light">
                <div class="card-body text-center">
                    <h5>Total Products</h5>
                    <h3 class="text-primary">{{ $productCount }}</h3>
                    <p class="text-muted">Total products in the system</p>
                </div>
            </div>
        </div>

        <!-- Statistik Pesanan -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-light">
                <div class="card-body text-center">
                    <h5>Total Orders</h5>
                    <h3 class="text-success">{{ $orderCount }}</h3>
                    <p class="text-muted">Total orders placed</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan Per Hari -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5>Daily Sales (Line Graph)</h5>
                    <canvas id="lineGraph"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5>Daily Sales (Bar Graph)</h5>
                    <canvas id="barGraph"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Pesanan Terbaru -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5>Latest Orders</h5>
                    <ul class="list-group">
                        @forelse ($latestOrders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order #{{ $order->id }} - <small>{{ $order->created_at->format('d M Y') }}</small>
                                <span class="badge bg-primary text-light">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center">No recent orders available.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjualan Tertinggi -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5>Top Selling Products</h5>
                    <ul class="list-group">
                        @forelse ($topProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }} 
                                <span class="badge bg-success text-light">{{ $product->order_items_count }} sales</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center">No products sold yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var dailyLabels = @json($dailyLabels); // Label per tanggal
    var dailySales = @json($dailySales);   // Total penjualan per hari

    // Line Graph
    var lineCtx = document.getElementById('lineGraph').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Total Sales (Rp)',
                data: dailySales,
                borderColor: 'rgba(78, 115, 223, 1)',
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    });

    // Bar Graph
    var barCtx = document.getElementById('barGraph').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Total Sales (Rp)',
                data: dailySales,
                backgroundColor: 'rgba(78, 115, 223, 0.8)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    });
</script>
@endsection