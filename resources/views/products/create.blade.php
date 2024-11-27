<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
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
            background-color: #28a745;
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
            background-color: #28a745;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #218838;
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
            border-color: #28a745;
        }
        .floating-label input:focus + label, .floating-label textarea:focus + label,
        .floating-label input:not(:placeholder-shown) + label,
        .floating-label textarea:not(:placeholder-shown) + label {
            top: -10px;
            left: 14px;
            font-size: 12px;
            color: #28a745;
        }
    </style>
</head>
<body>

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px; padding: 10px 20px;">
            <!-- Dashboard Link -->
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-success d-flex align-items-center">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <!-- Product Link -->
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}" class="text-decoration-none text-primary d-flex align-items-center">
                    <i class="fas fa-box me-2"></i> Product
                </a>
            </li>
            <!-- Current Page (Create) -->
            <li class="breadcrumb-item active text-muted" aria-current="page">
                <i class="fas fa-plus me-2"></i> Create
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card Container -->
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3>Create New Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <!-- Product Name -->
                            <div class="floating-label">
                                <input type="text" class="form-control" id="name" name="name" required placeholder=" " />
                                <label for="name">Product Name</label>
                            </div>

                            <!-- Product Price -->
                            <div class="floating-label">
                                <input type="number" class="form-control" id="price" name="price" required placeholder=" " />
                                <label for="price">Price</label>
                            </div>

                            <!-- Product Stock -->
                            <div class="floating-label">
                                <input type="number" class="form-control" id="stock" name="stock" required placeholder=" " />
                                <label for="stock">Stock</label>
                            </div>

                            <!-- Product Description -->
                            <div class="floating-label">
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder=" "></textarea>
                                <label for="description">Description</label>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-custom">Save Product</button>
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
        // Memastikan label terangkat jika input memiliki nilai saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll(".floating-label input, .floating-label textarea");
            inputs.forEach(input => {
                if (input.value.trim() !== "") {
                    input.classList.add("not-empty");
                }
                input.addEventListener("input", () => {
                    if (input.value.trim() !== "") {
                        input.classList.add("not-empty");
                    } else {
                        input.classList.remove("not-empty");
                    }
                });
            });
        });
    </script>
</body>
</html>