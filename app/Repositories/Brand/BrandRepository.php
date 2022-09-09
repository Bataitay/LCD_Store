<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isNull;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{

    function getModel()
    {
        return Brand::class;
    }

    public function all($request)
    {
        return $this->model->latest()->paginate(8);
    }
    public function create($data)
    {
        if ($data['logo']) {
            $file = $data['logo'];
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time(); // create file name by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/images/brand/' . $newFileName;
            $data['logo']->storeAs('public/images/brand', $newFileName); //save file in public/images/brand with newname is newFileName
            $data['logo'] = $path;
        }
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        $object = $this->model->find($id);
        // dd(!empty($data['logo']));
        if (!empty($data['logo'])) {
            $file = $data['logo'];
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time(); // create file by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/images/brand/' . $newFileName;
            $data['logo']->storeAs('public/images/brand', $newFileName);// save file in public/images/brand with newname is newFileName
            $data['logo'] = $path;
        } else {
            $data['logo'] = $object->logo;
        }
        return $object->update($data);
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
    public function searchBrand($name){
        $brands =  $this->model::where('name', 'like', '%' . $name . '%')
        ->orWhere('logo', 'like', '%' . $name . '%');
        if(Route::currentRouteName() =='brand.searchKey'){
            return  $brands->get();
          }
          return  $brands->paginate(8);
    }


}
