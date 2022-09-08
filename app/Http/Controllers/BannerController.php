<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Services\Banner\BannerServiceInterface;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

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
        return view('back-end.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request, $id, $status = null)
    {
        $this->bannerService->update($request, $id, $status);
        $notification = array(
            'message' => 'Update banner successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('banner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bannerService->delete($id);
    }
}
