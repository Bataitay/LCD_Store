<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    function getModel(){
        return Order::class;
    }
    function getAllWithPaginateLatest($request){
        $orders = $this->model->latest()->paginate(2);
        if(isset($request->search)){
            $orders = $this->model->where('id', 'LIKE', '%'.request()->search.'%')
            ->orWhere('address', 'LIKE', '%'.request()->search.'%')
            ->orWhere('customer_id', 'LIKE', '%'.request()->search.'%')
            ->paginate(2);
        }
        return $orders;
    }
    function updateSingle($id){
        $order = $this->model->find($id);
        $order->update(['status' => 1]);
        return $order;
    }
}