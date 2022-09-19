<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $byQuabtitys = DB::table('order_details')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.*, count(order_details.product_id) totalByQuan')
            ->groupBy('order_details.product_id')
            ->orderBy('totalByQuan', 'desc')
            ->take(10)
            ->get();

        $byRevenues = DB::table('order_details')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.*, sum( order_details.product_price * order_details.product_quantity ) totalbyRevenue')
            ->groupBy('order_details.product_id')
            ->orderBy('totalbyRevenue', 'desc')
            ->take(10)
            ->get();
        $customerByingSellings = DB::table('orders')
            ->selectRaw('orders.*, sum(order_total_price) cusByingSelling')
            ->groupBy('name')
            ->orderBy('cusByingSelling', 'desc')
            ->take(10)
            ->get();

        // $rateSales = Order::query()
        //     ->select('id')
        //     ->addSelect(['old_orders' => Order::selectRaw('sum( orders.order_total_price) as total ')
        //     ->whereDate('created_at', '<', now()->subDays(1))])
        //     ->addSelect(['new_orders' => Order::selectRaw('sum( orders.order_total_price) as total ')
        //         ->whereDate('created_at', '>=', now()->subDays(1))
        //         ])
        //     ->first();
        // $rateTotalSale = ($rateSales->new_orders - $rateSales->old_orders) * 100 / $rateSales->old_orders;

        // $rateOrder = Order::query()
        //     ->select('id')
        //     ->addSelect(['old_orders' => Order::selectRaw('count( orders.id) as countOrders ')
        //     ->whereDate('created_at', '<', now()->subDays(1))])
        //     ->addSelect(['new_orders' => Order::selectRaw('count( orders.id) as countOrders ')
        //         ->whereDate('created_at', '>=', now()->subDays(1))
        //         ])
        //     ->first();
        // $rateTotalOrder = ($rateOrder->new_orders - $rateOrder->old_orders) * 100 / $rateOrder->old_orders;

        $params = [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'totalCustomer' => $totalCustomer,
            'byQuabtitys' => $byQuabtitys,
            'byRevenues' => $byRevenues,
            'customerByingSellings' => $customerByingSellings,
            // 'rateTotalSale' => $rateTotalSale,
            // 'rateTotalOrder' => $rateTotalOrder,
        ];

        return view('back-end.dashboard.index', $params);
    }
}
