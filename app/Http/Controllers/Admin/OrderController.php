<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::select('orders.*', 'users.name as customerName', 'pizzas.pizza_name')
            ->orderBy('orders.order_id', 'desc')
            ->leftJoin('users', 'users.id', 'orders.customer_id')
            ->leftJoin('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
            ->paginate(9);
        // dd($orders->toArray());
        return view('admin.order.list')->with('order', $orders);
    }

    public function orderSearch(Request $request)
    {
        $orders = Order::select('orders.*', 'users.name as customerName', 'pizzas.pizza_name')
            ->orderBy('orders.order_id', 'desc')
            ->leftJoin('users', 'users.id', 'orders.customer_id')
            ->leftJoin('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
            ->orWhere('users.name', 'like', '%' . $request->searchData . '%')
            ->orWhere('pizzas.pizza_name', 'like', '%' . $request->searchData . '%')
            ->paginate(9);
        $orders->appends($request->all());
        return view('admin.order.list')->with('order', $orders);
    }
}