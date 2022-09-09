<?php
namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Route;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    function getModel()
    {
        return Customer::class;
    }

    public function all($request)
    {
        return  $this->model->latest()->paginate(8);
    }

    public function changeStatus($id,$data){
        $object = $this->model->find($id);
        return $object->update($id,$data);

    }
    public function getTrash()
    {
        return  $this->model->onlyTrashed()->paginate(8);
    }
    public function restore($id){
        return  $this->model->withTrashed()->where('id', $id)->restore();
    }
    public function forceDelete($id)
    {
        return  $this->model->withTrashed()->where('id', $id)->forceDelete();

    }
    public function searchCustomer($name){
       $customer = $this->model::where('name', 'like', '%' . $name . '%')
                            ->orWhere('phone', 'like', '%' . $name . '%')
                            ->orWhere('email', 'like', '%' . $name . '%')
                            ->orWhere('provider', 'like', '%' . $name . '%')
                            ->orWhere('provider_id', 'like', '%' . $name . '%');
        if(Route::currentRouteName() =='customer.searchKey'){
          return  $customer   ->get();
        }
        return  $customer   ->paginate(8);
    }
}
