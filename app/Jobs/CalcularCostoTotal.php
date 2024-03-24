<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalcularCostoTotal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Calculamos el costo total
	$orders = Order::all();

	$total_cost = 0;
	$total_orders = $orders->count();

	// Recorremos las ordenes y sus respectivas relaciones
	foreach ($orders AS $order)
	{
		foreach ($order->order_line AS $orderLine)
		{
			$total_cost += $orderLine->qty * $orderLine->product->cost;
		}
	}
	print_r($total_cost, $total_orders);

        // Guardamos en la tabla executed el costo total
	$request = Request::create('/api/executed/create', 'POST', ['total_orders' => $total_orders, 'total_cost' => $total_cost]);
	app()->handle($request);
	
    }
}
