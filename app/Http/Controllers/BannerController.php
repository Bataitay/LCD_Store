<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Models\Banner;
use App\Services\Banner\BannerServiceInterface;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BannerController extends Controller
{
    protected $bannerService;
    function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('List_Banner', 'List_Banner')) {
            abort(403);
        }
        $banners = $this->bannerService->all($request);
        $params = [
            'banners' => $banners,
        ];
        return view('back-end.banner.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('Add_Banner', 'Add_Banner')) {
            abort(403);
        }
        return view('back-end.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        if (Gate::denies('Add_Banner', 'Add_Banner')) {
            abort(403);
        }
        $this->bannerService->create($request);
        $notification = array(
            'message' => 'Added banner successfully',
            'alert-type' => 'success'
        );
        $params = [
            'notification' => $notification
        ];
        return redirect()->route('banner.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        if (Gate::denies('Show_Banner', 'Show_Banner')) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
            abort(403);
        }
        $banner = $this->bannerService->find($id);
        $params = [
            'banner' => $banner,
        ];
        return view('back-end.banner.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, $id, $status = null)
    {
        if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
            abort(403);
        }
        $this->bannerService->update($request, $id, $status);
        $notification = array(
            'message' => 'Update banner successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('banner.index')->with($notification);
    }
    public function updateStatus($id, $status)
    {
        if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
            abort(403);
        }
        $this->bannerService->updateStatus($id, $status);
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Delete_Banner', 'Delete_Banner')) {
            abort(403);
        }
        $this->bannerService->delete($id);
    }
}
