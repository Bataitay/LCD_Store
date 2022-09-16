<?php
namespace App\Repositories\Api\Brand;

use App\Repositories\RepositoryInterface;

interface BrandApiRepositoryInterface extends RepositoryInterface{
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchBrand($name);




}
