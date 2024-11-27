<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
        .breadcrumb {
            background-color: #f4f7fc;
            padding-left: 0;
        }
        .card-header {
            background-color: #ffc107;
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ccc;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-custom {
            background-color: #ffc107;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #e0a800;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .floating-label input, .floating-label textarea {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .floating-label label {
            position: absolute;
            top: 12px;
            left: 14px;
            font-size: 16px;
            transition: 0.2s ease all;
            color: #6c757d;
        }
        .floating-label input:focus, .floating-label textarea:focus {
            border-color: #ffc107;
        }
        .floating-label input:focus + label, 
        .floating-label textarea:focus + label,
        .floating-label input.has-value + label, 
        .floating-label textarea.has-value + label {
            top: -10px;
            left: 14px;
            font-size: 12px;
            color: #ffc107;
        }
    </style>
</head>
<body>

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px; padding: 10px 20px;">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-success d-flex align-items-center">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}" class="text-decoration-none text-primary d-flex align-items-center">
                    <i class="fas fa-box me-2"></i> Product
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                <i class="fas fa-edit me-2"></i> Edit
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3>Edit Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Product Name -->
                            <div class="floating-label">
                                <input type="text" class="form-control" id="name" name="name" required placeholder=" " value="{{ old('name', $product->name) }}" />
                                <label for="name">Product Name</label>
                            </div>

                            <!-- Product Price -->
                            <div class="floating-label">
                                <input type="number" class="form-control" id="price" name="price" required placeholder=" " value="{{ old('price', $product->price) }}" />
                                <label for="price">Price</label>
                            </div>

                            <!-- Product Stock -->
                            <div class="floating-label">
                                <input type="number" class="form-control" id="stock" name="stock" required placeholder=" " value="{{ old('stock', $product->stock) }}" />
                                <label for="stock">Stock</label>
                            </div>

                            <!-- Product Description -->
                            <div class="floating-label">
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder=" ">{{ old('description', $product->description) }}</textarea>
                                <label for="description">Description</label>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-custom">Update Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.floating-label input, .floating-label textarea');

            // Periksa setiap input apakah sudah memiliki nilai
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    input.classList.add('has-value');
                }

                // Tambahkan kelas 'has-value' saat pengguna mengetik
                input.addEventListener('input', () => {
                    if (input.value.trim() !== '') {
                        input.classList.add('has-value');
                    } else {
                        input.classList.remove('has-value');
                    }
                });

                // Tambahkan kelas 'has-value' saat input kehilangan fokus
                input.addEventListener('blur', () => {
                    if (input.value.trim() !== '') {
                        input.classList.add('has-value');
                    }
                });
            });
        });
    </script>
</body>
</html>
