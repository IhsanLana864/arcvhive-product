<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb shadow-sm p-3 mb-4 rounded" style="background-color: #f8f9fa;">
                <!-- Dashboard Link -->
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-success">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <!-- Orders Link -->
                <li class="breadcrumb-item">
                    <a href="{{ route('orders.index') }}" class="text-decoration-none text-primary">
                        <i class="fas fa-shopping-cart me-2"></i> Orders
                    </a>
                </li>
                <!-- Current Page -->
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    <i class="fas fa-file-invoice me-2"></i> Detail Order
                </li>
            </ol>
        </nav>

        <h2 class="mb-4">Detail Order</h2>

        <!-- Informasi Order -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Informasi Order
            </div>
            <div class="card-body">
                <p><strong>ID Order:</strong> {{ $order->id }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $order->user->name }}</p>
                <p><strong>Email Pelanggan:</strong> {{ $order->user->email }}</p>
                <p><strong>Total Harga:</strong> {{ 'Rp ' . number_format($order->total_price, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Detail Item dalam Order -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                Produk dalam Order
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->orderItems->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada item dalam order ini.</td>
                            </tr>
                        @else
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
                                    <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ 'Rp ' . number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Order
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
