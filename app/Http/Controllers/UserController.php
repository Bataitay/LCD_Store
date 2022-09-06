<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Services\Role\RoleServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

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
        $provinces = Province::get();
        $districts = District::get();
        $wards = Ward::get();
        $roles = $this->roleService->all($request);
        $user = $this->userService->find($id);
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
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->userService->update($id, $data);
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
        $user = $this->userService->delete($id);
        return response()->json($user);
    }
    public function getTrashed()
    {
        $users = $this->userService->getTrashed();
        return view('back-end.employee.sorfDelete', compact('users'));
    }
    public function restore($id)
    {
        $this->userService->restore($id);
        $notification = array(
            'message' => 'Restore user successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.getTrashed')->with($notification);
    }
    public function force_destroy($id)
    {
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
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
        $notification = array(
            'message' => 'The provided credentials do not match our records.',
            'alert-type' => 'error'
        );
        return back()->with($notification);
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
}
