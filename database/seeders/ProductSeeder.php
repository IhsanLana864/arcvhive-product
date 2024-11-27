<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $brands = ['Erigo', 'Eiger', 'Roughneck', 'Leaf', 'Shining Bright', '3Second', 'Billabong', 'The North Face', 'Adidas', 'Nike'];

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $brands[array_rand($brands)] . ' ' . $faker->word,  // Nama produk berdasarkan merek
                'description' => $faker->sentence(10),  // Deskripsi produk acak
                'price' => $faker->numberBetween(100000, 500000),  // Harga produk antara 100k dan 500k
                'stock' => $faker->numberBetween(10, 100),  // Stok produk antara 10 sampai 100
                'sales_count' => $faker->numberBetween(0, 50),  // Jumlah penjualan produk yang sudah terjual
                'created_at' => $faker->dateTimeThisYear(),  // Tanggal pembuatan produk
                'updated_at' => $faker->dateTimeThisYear(),  // Tanggal pembaruan produk
            ]);
        }
    }
}
