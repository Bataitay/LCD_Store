<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class DashBoardServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $totalSales  =  Order::pluck('order_total_price')->sum();
        $totalOrders  =  Order::pluck('order_total_price')->count();
        $totalCustomer  =  Customer::pluck('id')->count();

        $params = [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'totalCustomer' => $totalCustomer,
        ];

        return view('back-end.dashboard.index', $params);
    }
}
