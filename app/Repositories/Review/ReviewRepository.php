<?php
namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    function getModel()
    {
        return Review::class;
    }
    public function all($request)
    {
        // $reviews = $this->model->select('*');
        return $this->model->latest()->paginate(5);
    }
    public function changeStatus($id,$data){
        $object = $this->model->find($id);
        return $object->update($id,$data);

    }
    public function getTrash()
    {
        return  $this->model->onlyTrashed()->get();
    }
    public function restore($id){
        return  $this->model->withTrashed()->where('id', $id)->restore();
    }
    public function forceDelete($id)
    {
        return  $this->model->withTrashed()->where('id', $id)->forceDelete();

    }
    public function searchReview($name){
        $reviews =  $this->model::where('content', 'like', '%' . $name . '%')
        ->orWhere('vote',$name)
        ->orWhere('product_id',$name)
        ->orWhere('customer_id',$name);
        if(Route::currentRouteName() =='review.searchKey'){
            return  $reviews   ->get();
          }
          return  $reviews   ->paginate(8);
    }
}
