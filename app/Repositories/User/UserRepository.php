<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use StorageImageTrait;
    function getModel()
    {
        return User::class;
    }
    public function all($request)
    {
        $search = $request->search;
        $users = $this->model->select('*');
        if ($search) {
            $users = $users->where('name', 'like', '%' . $search . '%');
        }
        return $users->orderBy('id', 'DESC')->paginate(10);
    }
    public function create($data)
    {
        $user = $this->model;
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        $user->password = $data['password'];
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        // $user->province_id = $data['province_id'];
        // $user->district_id = $data['district_id'];
        // $user->ward_id = $data['ward_id'];
        $user->save();
    }
    public function addAvatar($data)
    {
        $user = $this->model;
        $dataUploadImage = $this->storageUpload($data, 'avatar', 'employee');
        $user->avatar = $dataUploadImage['file_path'];
        $user->save();
    }

    public function update($id, $data)
    {

        $user = $this->model->find($id);
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        $user->password = $data['password'];
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->email = $data['email'];
        $user->province_id = $data['province_id'];
        $user->district_id = $data['district_id'];
        $user->ward_id = $data['ward_id'];
        $user->save();
        return $user;
    }
    public function delete($id)
    {
        $user = $this->model->find($id);
        try {
            $user->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $user;
    }
    public function getTrashed()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $user = $query->paginate(5);
        return $user;
    }
    public function restore($id)
    {
        $user = $this->model->withTrashed()->findOrFail($id);
        $user->restore();
        return $user;
    }
    public function force_destroy($id)
    {
        $user = $this->model->onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return $user;
    }
}
