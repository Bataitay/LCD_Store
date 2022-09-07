<?php
namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use App\Traits\StorageImageTrait;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface{
    use StorageImageTrait;
    function getModel(){
        return Banner::class;
    }
    function create($request){
        $image = $this->storageUpload($request, 'banner', 'banner');
        $banner = $this->model->create([
            'url' => $request->path,
            'status' => 0,
            'image' => $image,
        ]);
    }
}