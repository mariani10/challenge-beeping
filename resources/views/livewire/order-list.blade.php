<div>
    <h2 class="mt-12 item-center text-center text-xl font-semibold text-gray-900 dark:text-white">Listado de Pedidos</h2>
<div class="flex justify-center">
    <table class="table-auto mt-16 mb-16 item-center justify-center text-center text-sm text-gray-500 dark:text-gray-400 ">
        <thead>
            <tr>
                <th># Referencia de Orden</th>
                <th>Nombre de Cliente</th>
                <th>Cantidad Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-b dark:border-gray-700">
                <td>{{ $order->order_ref }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->order_line->sum('qty') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="flex justify-center mt-16 mb-16 px-0 sm:items-center sm:justify-between">
	<div class="text-center text-sm sm:text-left">
		&nbsp;
	</div>

	<div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
		@isset($lastOrder)
		Pedidos: {{ $lastOrder->total_orders }} - Total: ${{ $lastOrder->total_cost }} - ({{ $lastOrder->created_at->format('d/m/Y h:i:s') }})
		@endisset
		@empty($lastOrder)
		Ejecutar horizon para mostrar total de pedidos y costo.		
		@endempty
	</div>
</div>


</div>

