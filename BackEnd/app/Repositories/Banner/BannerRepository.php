<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\File;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface {
    use StorageImageTrait;
    function getModel() {
        return Banner::class;
    }
    function create($request) {
        $image = $this->storageUpload($request, 'banner', 'banner');
        $banner = $this->model->create([
            'url' => $request->path,
            'status' => 0,
            'image' => $image,
        ]);
    }
    function update($request, $id) {
        $banner = $this->model->find($id);
        $banner->url = $request->path;
        if ($request->banner != null) {
            File::delete($banner->image);
            $image = $this->storageUpload($request, 'banner', 'banner');
            $banner->image = $image;
        }
        $banner->save();
        return $banner;
    }
    function updateStatus($id, $status) {
        $banner = $this->model->find($id);
        if($status){
            $banner->status = 0;
        }else{           
            $banner->status = 1;
        }
        $banner->save();
        return $banner;
    }
    function delete($id) {
        $banner = $this->model->find($id);
        File::delete($banner->image);
        $banner->delete();
    }
}
