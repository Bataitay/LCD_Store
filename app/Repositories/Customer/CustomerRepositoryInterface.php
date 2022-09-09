<?php
namespace App\Repositories\Customer;

use App\Repositories\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface{
    public function changeStatus($id,$data);
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchCustomer($name);

}
