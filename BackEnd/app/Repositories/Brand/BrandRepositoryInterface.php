<?php
namespace App\Repositories\Brand;

use App\Repositories\RepositoryInterface;

interface BrandRepositoryInterface extends RepositoryInterface{
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchBrand($name);
  



}
