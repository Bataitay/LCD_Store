<?php
namespace App\Services\Customer;

use App\Services\ServiceInterface;

interface CustomerServiceInterface extends ServiceInterface
{
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchCustomer($name);


}
