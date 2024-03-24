<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(20)
            ->create()
            ->each(function ($order) {
                $order->order_line()->saveMany(OrderLine::factory()->count(1)->make());
            });
	}
}
