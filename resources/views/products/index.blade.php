@extends('layout.app')

@section('title', 'Manage Products')

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb shadow-sm p-3 mb-4 rounded" style="background-color: #f8f9fa;">
            <!-- Dashboard Link -->
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-success">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <!-- Product Link -->
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}" class="text-decoration-none text-primary">
                    <i class="fas fa-box me-2"></i> Product
                </a>
            </li>
            <!-- Current Page (Manage) -->
            <li class="breadcrumb-item active text-muted" aria-current="page">
                <i class="fas fa-cogs me-2"></i> Manage
            </li>
        </ol>
    </nav>

    <h1 class="mb-4 text-center">Product List</h1>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Add New Product Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle me-2"></i> Add New Product
        </a>
        <!-- Search Functionality (optional) -->
        <form class="d-flex" method="GET" action="{{ route('products.index') }}">
            <input type="text" class="form-control" name="search" placeholder="Search products" value="{{ request('search') }}">
            <button class="btn btn-primary ms-2" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <!-- Table to Display Products -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->formatted_price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Tombol Delete yang membuka Modal -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                data-action="{{ route('products.destroy', $product->id) }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to permanently delete this product?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection