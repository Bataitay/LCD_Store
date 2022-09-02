<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface{
    public function all($request);
    public function addAvatar($data);
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);
}
