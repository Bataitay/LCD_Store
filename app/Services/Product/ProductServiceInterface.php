<?php
namespace App\Services\Product;

use App\Services\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface
{
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);
}
