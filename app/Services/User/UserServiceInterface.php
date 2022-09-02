<?php
namespace App\Services\User;

use App\Services\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    public function addAvatar($data);
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);
}
