<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface {

    public $repository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }
    public function all($request)
    {
        return $this->repository->all($request);
    }
    public function addAvatar($data){
        
    }
    public function update($id, $data){
        return $this->repository->update($id, $data);
    }
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    public function getTrashed()
    {
        return $this->repository->getTrashed();
    }
    public function restore($id){
        return $this->repository->restore($id);
    }
    public function force_destroy($id){
        return $this->repository->force_destroy($id);
    }

}
