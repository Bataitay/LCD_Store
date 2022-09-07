<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    function getModel(){
        return Order::class;
    }
    function getAllWithPaginateLatest($request){
        $orders = $this->model->latest()->paginate(1);
        if(isset($request->search)){
            $orders = $this->model
            ->select('*', 'orders.id as id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->where('orders.id', 'LIKE', '%'.$request->search.'%')
            ->orWhere('customers.name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('customers.id', 'LIKE', '%'.$request->search.'%')
            ->paginate(1);
        }
        return $orders;
    }
    function updateSingle($id){
        $order = $this->model->find($id);
        $order->update(['status' => 1]);
        return $order;
    }
}