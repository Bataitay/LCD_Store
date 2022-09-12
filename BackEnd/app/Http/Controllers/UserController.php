<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use App\Services\Role\RoleServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userService;
    private $roleService;
    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    public function index(Request $request)
    {
        if (Gate::denies('List_Employee', 'List_Employee')) {
            abort(403);
        }
        $users = $this->userService->all($request);
        $param = [
            'users' => $users
        ];
        return view('back-end.employee.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::denies('Add_Employee', 'Add_Employee')) {
            abort(403);
        }
        $roles = $this->roleService->all($request);
        $provinces = Province::get();
        $params = [
            'roles' => $roles,
            'provinces' => $provinces,
        ];
        return view('back-end.employee.add', $params);
    }
    public function GetDistricts(Request $request)
    {
        $province_id = $request->province_id;
        $allDistricts = District::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Ward::where('district_id', $district_id)->get();
        return response()->json($allWards);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if (Gate::denies('Add_Employee', 'Add_Employee')) {
            abort(403);
        }
        try {
            $this->userService->create($request);
            $notification = array(
                'message' => 'Added employee successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('user.index')->with($notification);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Added employee faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function addAvatar(Request $request)
    {
        if (Gate::denies('Add_Employee', 'Add_Employee')) {
            abort(403);
        }
        // dd($request->file('avatar'));
        $data = $request->file('avatar');
        $file = $this->userService->addAvatar($data);
        //   dd($file);
        return response()->json(['file' => $file], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('Show_Employee', 'Show_Employee')) {
            abort(403);
        }
        $user = $this->userService->show($id);
        return view('back-end.employee.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if (Gate::denies('Edit_Employee', 'Edit_Employee')) {
            abort(403);
        }
        $user = $this->userService->find($id);
        $provinces = Province::get();
        $districts = District::get();
        $wards = Ward::get();
        $roles = $this->roleService->all($request);
        $rolesChecked = $user->roles;
        $params = [
            'roles' => $roles,
            'user' => $user,
            'rolesChecked' => $rolesChecked,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];
        return view('back-end.employee.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, $id)
    {
        if (Gate::denies('Edit_Employee', 'Edit_Employee')) {
            abort(403);
        }
        // dd($request->file('avatar'));
        $data = $request->file('avatar');
        $file = $this->userService->updateAvatar($data, $id);
        //   dd($file);
        return response()->json(['file' => $file], 200);
    }
    public function update(Request $request, $id)
    {
        if (Gate::denies('Edit_Employee', 'Edit_Employee')) {
            abort(403);
        }
        try {
            $data = $request->all();
            $this->userService->update($id, $request);
            $notification = array(
                'message' => 'Edited employee successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('user.index')->with($notification);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Edited employee faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Delete_Employee', 'Delete_Employee')) {
            abort(403);
        }
        $user = $this->userService->delete($id);
        if ($user->id == 1) {
            abort(403);
        }
        return response()->json($user);
    }
    public function getTrashed()
    {
        if (Gate::denies('List_Employee', 'List_Employee')) {
            abort(403);
        }
        $users = $this->userService->getTrashed();
        return view('back-end.employee.sorfDelete', compact('users'));
    }
    public function restore($id)
    {
        if (Gate::denies('Delete_Employee', 'Delete_Employee')) {
            abort(403);
        }
        $this->userService->restore($id);
        $notification = array(
            'message' => 'Restore user successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.getTrashed')->with($notification);
    }
    public function force_destroy($id)
    {
        if (Gate::denies('Delete_Employee', 'Delete_Employee')) {
            abort(403);
        }
        $user = $this->userService->force_destroy($id);
        return response()->json($user);
    }
    public function login()
    {
        return view('back-end.auth.login');
    }
    public function handelLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                Session::flash('message','login failled !!!');

                return redirect()->back();
            }
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        return redirect()->route('login');
    }
    public function changePassword()
    {
        return view('back-end.employee.changePassword');
    }
    public function updatepassword(Request $request)
    {
        $validation = $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $hashedPassword = Auth::user()->password;
        try {
            if (Hash::check($request->old_password, $hashedPassword)) {
                $users = User::find(Auth::id());
                $users->password = Hash::make($request->new_password);
                $users->save();
                $notification = array(
                    'message' => 'Change Password successFully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.index')->with($notification);
            } else {
                $notification = array(
                    'message' => 'old password false.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Change Password Faill.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
