<?php
namespace App\Repositories\Banner;

use App\Repositories\RepositoryInterface;

interface BannerRepositoryInterface extends RepositoryInterface{
    function update($request, $id, $status = null);
}