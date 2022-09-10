<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface{
    public function all($request);
    public function addAvatar($request);
    public function updateAvatar($request, $id);
    // public function GetDistricts( $data);
    // public function getWards( $data);
    public function getTrashed();
    public function restore($id);
    public function show($id);
    public function force_destroy($id);

}
