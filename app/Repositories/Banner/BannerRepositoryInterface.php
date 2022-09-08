<?php
namespace App\Repositories\Banner;

use App\Repositories\RepositoryInterface;

interface BannerRepositoryInterface extends RepositoryInterface{
    function updateStatus($id, $status);
}