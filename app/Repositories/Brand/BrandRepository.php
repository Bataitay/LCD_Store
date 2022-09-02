<?php
namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface{

    function getModel()
    {
        return Brand::class;
    }
    //
    public function create($data){
        if ($data['logo']) {
            $file = $data['logo'];
            $fileExtension = $file->getClientOriginalExtension(); //jpg,png lấy ra định dạng file và trả về
            $fileName = time(); // create file by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            // $product->image = $newFileName;// cột image gán bằng tên file mới
            $path= 'storage/images/brand/'.$newFileName;
            $data['logo']->storeAs('public/images/brand', $newFileName); //lưu file vào mục public/images với tê mới là $newFileName
            $data['logo'] = $path;

        }
        return $this->model->create($data);
    }
    public function update($id, $data){
        $object = $this->model->find($id);
        if ($data['logo']) {
            $file = $data['logo'];
            $fileExtension = $file->getClientOriginalExtension(); //jpg,png lấy ra định dạng file và trả về
            $fileName = time(); // create file by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            // $product->image = $newFileName;// cột image gán bằng tên file mới
            $path= 'storage/images/brand/'.$newFileName;
            $data['logo']->storeAs('public/images/brand', $newFileName); //lưu file vào mục public/images với tê mới là $newFileName
            $data['logo'] = $path;

        }else{
            $data['logo'] = $object->image;
        }
        return $object->update($data);
    }
    public function getTrash(){
      return $this->model->onlyTrashed()->get();
    }
}
