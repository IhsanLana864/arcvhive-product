<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Order</title>
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
                <i class="fas fa-list me-2"></i> Daftar Order
            </li>
        </ol>
    </nav>

        <h2 class="mb-4">Daftar Order</h2>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ 'Rp ' . number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <!-- Tautan untuk melihat detail order -->
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <!-- Tombol untuk menghapus order -->
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus order ini?');">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Menampilkan link pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation example">
                {{ $orders->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
