<?php

namespace App\Http\Controllers;

use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userService;
    public function __construct(UserServiceInterface $userService){
        $this->userService = $userService;
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
    public function create()
    {
        return view('back-end.employee.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->userService->create($data);
        $notification = array(
            'message' => 'Added employee successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')->with($notification);
    }
    public function addAvatar(Request $request){
        $data = $request->avatar;
        dd($data);
        $this->userService->addAvatar($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
