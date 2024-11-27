<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Rentang waktu untuk tanggal acak (1 bulan terakhir)
        $startDate = Carbon::now()->subMonth(); 
        $endDate = Carbon::now();
        // Membuat 150 order
        Order::factory(150)->create()->each(function ($order) use ($faker, $startDate, $endDate) {
        $randomDate = Carbon::now()->subDays(rand(0, 30))->setTime(rand(0, 23), rand(0, 59), rand(0, 59));
        $order->created_at = $randomDate;
        $order->updated_at = $randomDate;
        $order->save();

            // Ambil semua produk yang ada
            $products = Product::all();

            // Pilih secara acak produk yang akan dimasukkan ke dalam order (1 sampai 10 produk per order)
            $selectedProducts = $products->random(rand(1, 10)); 
            foreach ($selectedProducts as $product) {
                // Tambahkan produk ke dalam order
                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => rand(1, 10),  // Random jumlah produk
                    'price' => $product->price, // Menggunakan harga produk dari database
                ]);
            }

            // Hitung total harga untuk order ini
            $totalPrice = $order->orderItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            // Update kolom status dengan nilai yang valid
            $order->status = $faker->randomElement(['pending', 'completed', 'failed', 'canceled']);
            $order->created_at = $faker->dateTimeBetween($startDate, $endDate); 
            $order->total_price = $totalPrice;
            $order->save();
        });
    }
}