<?php
namespace App\Services\Banner;

use App\Services\ServiceInterface;

interface BannerServiceInterface extends ServiceInterface{
    function updateStatus($id, $status);
}