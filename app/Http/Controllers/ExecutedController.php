<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Executed;

class ExecutedController extends Controller
{
	public function create(Request $request)
	{
        	$executed = new Executed();
		$executed->total_orders = $request->input('total_orders');
        	$executed->total_cost = $request->input('total_cost');
        	
        	$executed->save();

        	return response()->json(['message' => 'Totales guardados con éxito'], 201);
    }
}
