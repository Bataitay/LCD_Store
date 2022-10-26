<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    function getModel(){
        return Order::class;
    }
    function getAllWithPaginateLatest($request){
        $orders = $this->model->latest()->paginate(10);
        if(isset($request->search)){
            $orders = $this->model
            ->where('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search.'%')
            ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
            ->paginate(10);
        }
        return $orders;
    }
    function updateSingle($id){
        $order = $this->model->find($id);
        $order->update(['status' => 1]);
        return $order;
    }
}