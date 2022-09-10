<?php
namespace App\Services\User;

use App\Services\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    public function addAvatar($request);
    public function updateAvatar($request, $id);
    public function getTrashed();
    // public function GetDistricts( $data);
    // public function getWards( $data);
    public function show($id);
    public function restore($id);
    public function force_destroy($id);
}
