<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserOrders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;

    public function __construct(UserOrders $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user->store()->exists()) {
            flash('Você deve criar sua loja para cadastrar produtos e receber pedidos')->warning();
            return redirect()->route('stores.index');
        }

        $orders = $user->store->orders()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

}
