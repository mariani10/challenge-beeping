<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Order;
use App\Models\Executed;

class OrderList extends Component
{
    public function render()
    {
        $orders = Order::all();
        $lastOrder = Executed::latest()->first();

        return view('livewire.order-list', [
            'orders' => $orders,
            'lastOrder' => $lastOrder ,
        ]);
    }
}
