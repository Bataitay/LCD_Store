<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface{
    public function all($request);
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);

}
