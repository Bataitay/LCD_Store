<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface{
    function getAllWithPaginateLatest($request);
    function updateSingle($id);
}