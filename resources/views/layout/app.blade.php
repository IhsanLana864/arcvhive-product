<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard E-Commerce')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white" id="sidebar">
            <button class="btn btn-danger btn-sm sidebar-close" id="sidebarClose">
                <i class="fas fa-times"></i>
            </button>
            <h3>Admin Panel</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('products.index') }}">
                        <i class="fas fa-box"></i> Manage Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" id="submenuToggle">
                        <i class="fas fa-cogs"></i> Settings <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="nav flex-column ms-3 collapse" id="settingsSubmenu">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">General Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Account Settings</a>
                        </li>
                    </ul>
                </li>                
            </ul>
        </div>

        <!-- Toggle Button -->
        <button class="btn btn-dark sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Content -->
        <div class="main-content" id="mainContent">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const mainContent = document.getElementById('mainContent');

            // Open sidebar
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.add('open');
                mainContent.classList.add('sidebar-open');
                sidebarToggle.style.display = 'none';
            });

            // Close sidebar
            sidebarClose.addEventListener('click', () => {
                sidebar.classList.remove('open');
                mainContent.classList.remove('sidebar-open');
                sidebarToggle.style.display = 'block';
            });
        });
    </script>
    <script>
        document.getElementById('submenuToggle').addEventListener('click', () => {
            const submenu = document.getElementById('settingsSubmenu');
            submenu.classList.toggle('show');
        });

    </script>
</body>
</html>