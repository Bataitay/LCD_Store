<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{

    function getModel()
    {
        return Category::class;
    }
    public function all($request)
    {
        $search = $request->search;
        $categories = $this->model->select('*');
        if ($search) {
            $categories = $categories->where('name', 'like', '%' . $search . '%');
        }
        return $categories->orderBy('id','DESC')->paginate(10);
    }
    public function update($id, $data){

        $category = $this->model->find($id);
        $category->name = $data['name'];
        $category->save();
        return $category;
    }
    public function delete($id){
        $category = $this->model->find($id);
        try {
            $category->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $category;
    }
    public function getTrashed(){
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $category = $query->paginate(5);
        return $category;
    }
    public function restore($id){
        $category = $this->model->withTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }
    public function force_destroy($id){
        $category = $this->model->onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return $category;
    }


}
