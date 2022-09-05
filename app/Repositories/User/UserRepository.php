<?php

namespace App\Repositories\User;

use App\Models\District;
use App\Models\User;
use App\Models\Ward;
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
            $users = $users->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        }
        return $users->orderBy('id', 'DESC')->paginate(10);
    }
    // public function GetDistricts($data)
    // {
    //     $province_id = $data['province_id'];
    //     $allDistricts = District::where('province_id', $province_id)->get();
    //     return $allDistricts;
    // }
    // public function getWards($data)
    // {
    //     // $district_id = $data['district_id'];
    //     // $allWards = Ward::where('district_id', $district_id)->get();
    //     // return $allWards;
    // }
    public function create($data)
    {
        $user = $this->model;
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        $user->password = bcrypt($data['password']);
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->province_id = $data['province_id'];
        $user->district_id = $data['district_id'];
        $user->ward_id = $data['ward_id'];
        $user->save();
        $user->roles()->attach($data->roles_id);
        return $user;
    }

    public function addAvatar($data)
    {
        // $dataUploadImage = $this->storageUpload($request, 'avatar', 'employee');
        // $user->avatar = $dataUploadImage['file_path'];
        $user = $this->model;
        $file = $data['avatar'];
        if ($file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            $path = 'storage/' . $file->store('/user', 'public');
            $user->avatar = $path;
            $user->save();
            return $user;
        }
    }

    public function show($id)
    {
        $user = $this->model->find($id);
        return $user;
    }
    public function update($id, $data)
    {

        $user = $this->model->find($id);
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        $user->password = bcrypt($data['password']);
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
