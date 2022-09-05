<?php
namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    function getModel()
    {
        return Review::class;
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
        return  $this->model::where('content', 'like', '%' . $name . '%')->get();
    }
}
