<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,  // Pilih user secara acak
            'total_price' => 0,  // Harga total akan dihitung nanti
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']), // Status order
        ];
    }
}