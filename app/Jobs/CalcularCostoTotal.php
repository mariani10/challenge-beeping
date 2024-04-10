<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderLine;
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
	$resultado = OrderLine::with(['product', 'order'])
		->get()
		->reduce(function ($carry, $orderLine) 
		{
        		// Miramos order y order line para ver si ya lo habiamos contado
			if (!isset($carry['orders'][$orderLine->order_id])) 
			{
            			// Si no ha sido contada, incrementar el contador de órdenes
				$carry['total_orders']++;

				// Marcar la orden como contada para evitar contarla nuevamente
				$carry['orders'][$orderLine->order_id] = true;
			}
			$carry['total_cost'] += $orderLine->qty * $orderLine->product->cost;
			return $carry;
    		}, ['total_orders' => 0, 'total_cost' => 0]);

	/*$resultado = OrderLine::with(['product', 'order'])
    		->withCount('order')
    		->get()
    		->reduce(function ($carry, $orderLine) {
			$carry['total_orders'] += $orderLine->order_count;
			$carry['total_cost'] += $orderLine->qty * $orderLine->product->cost;
			return $carry;
		}, ['total_orders' => 0, 'total_cost' => 0]);
	*/


        // Guardamos en la tabla executed el costo total
	$request = Request::create('/api/executed/create', 'POST', $resultado);
	app()->handle($request);
	
    }
}
