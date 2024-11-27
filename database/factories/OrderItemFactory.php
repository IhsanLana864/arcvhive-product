<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Ambil semua produk dari database
        $products = Product::all();

        // Tanggal mulai (30 hari lalu) hingga hari ini
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        // Loop per hari untuk membuat pesanan
        while ($startDate->lte($endDate)) {
            // Buat jumlah pesanan per hari secara random (1–5 pesanan per hari)
            $dailyOrders = rand(1, 5);

            for ($i = 0; $i < $dailyOrders; $i++) {
                // Buat pesanan baru
                $order = Order::create([
                    'user_id' => rand(1, 10), // Asumsikan user_id 1–10 ada di database
                    'total_price' => 0, // Akan dihitung setelah item ditambahkan
                    'created_at' => $startDate->copy()->setTime(rand(0, 23), rand(0, 59), rand(0, 59)), // Waktu acak dalam hari itu
                    'updated_at' => $startDate->copy(),
                ]);

                // Pilih 1–10 produk secara acak
                $selectedProducts = $products->random(rand(1, 10));

                foreach ($selectedProducts as $product) {
                    // Tambahkan item ke dalam pesanan
                    $order->orderItems()->create([
                        'product_id' => $product->id,
                        'quantity' => rand(1, 5), // Random jumlah produk
                        'price' => $product->price, // Harga produk dari database
                    ]);
                }

                // Hitung total harga pesanan
                $totalPrice = $order->orderItems->sum(function ($item) {
                    return $item->quantity * $item->price;
                });

                // Perbarui total harga di pesanan
                $order->total_price = $totalPrice;
                $order->save();
            }

            // Pindah ke hari berikutnya
            $startDate->addDay();
        }
    }
}
