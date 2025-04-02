<<<<<<< HEAD
# Dashboard E-Commerce

Dashboard E-Commerce adalah template berbasis PHP Laravel 11 yang dirancang untuk mengelola data dalam sebuah sistem E-Commerce. Template ini memberikan fitur utama seperti CRUD (Create, Read, Update, Delete), statistik produk dan pesanan, grafik penjualan, serta manajemen pesanan dan produk. Proyek ini dirancang khusus untuk administrator dalam mengelola sistem E-Commerce dengan antarmuka yang responsif dan user-friendly.

---

## 📋 Fitur Utama

- **Dashboard Statistik**: 
  - Total Produk.
  - Total Pesanan.
  - Pesanan Terbaru.
  - Produk Terlaris.
- **Grafik Penjualan**:
  - *Line Chart* dan *Bar Chart* untuk data penjualan harian.
- **Manajemen Produk**:
  - CRUD Produk (Tambah, Edit, Lihat, Hapus).
- **Manajemen Pesanan**:
  - CRUD Pesanan.
  - Menambahkan item pesanan.
- **Template Responsif**: Desain responsif untuk tampilan desktop dan perangkat mobile.

---

## 📂 Struktur Proyek

```plaintext
├── app
│   ├── Http
│   │   └── Controllers
│   │       ├── DashboardController.php
│   │       ├── OrderController.php
│   │       └── ProductController.php
├── database
│   ├── factories
│   ├── migrations
│   ├── seeders
│   │   ├── OrderSeeder.php
│   │   └── ProductSeeder.php
├── public
├── resources
│   └── views
│       ├── dashboard
│       │   └── index.blade.php
│       ├── orders
│       └── products
├── routes
│   └── web.php
└── ...
```

---

## ⚙️ Requirements
Sebelum menginstal dan menjalankan proyek ini, pastikan Anda memenuhi persyaratan berikut:
- **PHP**: Minimal versi 8.1
- **Composer**: Versi terbaru
- **Laravel**: Versi 11
- **Database**: MySQL 5.7+ 

---

## 📖 Dokumentasi
### 1. Penjelasan Fitur
**a. Dashboard Statistik**
- Menampilkan total produk, total pesanan, pesanan terbaru, dan produk terlaris.
- Memanfaatkan query database untuk menghitung jumlah produk dan pesanan.

**b. Grafik Penjualan**
- Menggunakan Chart.js untuk menampilkan grafik berbentuk garis dan batang berdasarkan data dari tabel orders dan order_items.

**c. Manajemen Produk**
- CRUD produk dilakukan melalui tabel products.
- Fitur mencakup:
  - Tambah produk baru dengan informasi lengkap.
  - Edit produk yang sudah ada.
  - Hapus produk yang tidak diperlukan.
  - Lihat daftar produk.

**d. Manajemen Pesanan**
- CRUD pesanan dilakukan melalui tabel orders.
- Fitur mencakup:
  - Melihat Detail pesanan
  - Hapus Pesanan

### 2. Langkah Instalasi
Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

**a. Clone Repository**
Clone repository ini ke direktori lokal Anda.
```bash
git clone https://github.com/yezkyy/dashboard-ecommerce.git
cd dashboard-ecommerce
```

**b. Install Dependencies**
Instal semua dependensi PHP menggunakan Composer.
```bash
Instal semua dependensi PHP menggunakan Composer.
```

**c. Buat File Konfigurasi**
Duplikat file .env.example menjadi .env dan sesuaikan konfigurasi database Anda:
```bash
cp .env.example .env
```
Kemudian buka file .env dan atur konfigurasi database seperti berikut:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```
Gantilah _DB_USERNAME_ dan _DB_PASSWORD_ dengan kredensial yang sesuai jika diperlukan.

**d. Generate App Key**
Generate key aplikasi Laravel.
```bash
php artisan key:generate
```

**e. Migrasi dan Seeder Database**
Jalankan migrasi untuk membuat tabel database, lalu jalankan seeder untuk mengisi data awal.
```bash
php artisan migrate --seed
```

**f. Jalankan Server**
Jalankan server lokal Laravel.
```bash
php artisan serve
```
Akses proyek pada browser Anda melalui:
```
http://localhost:8000
```
=======
# arcvhive-product
Dashboard E-Commerce adalah template berbasis PHP Laravel 11 yang dirancang untuk membantu administrator dalam mengelola sistem e-commerce. Template ini menyediakan fitur utama seperti CRUD (Create, Read, Update, Delete) untuk produk dan pesanan, statistik produk dan pesanan, serta grafik penjualan. 
>>>>>>> 15e42aea419d4cf0c17b8912694bf2108fce87bc
