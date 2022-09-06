<?php
namespace App\Services\Order;

use App\Services\ServiceInterface;

interface OrderServiceInterface extends ServiceInterface{
    function getAllWithPaginateLatest($request);
    function updateSingle($id);
}