<?php
namespace App\Services\Brand;

use App\Services\ServiceInterface;

interface BrandServiceInterface extends ServiceInterface
{
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchBrand($name);


}
