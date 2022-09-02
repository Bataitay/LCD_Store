<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\Brand\BrandService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $brands = $this->brandService->all();
       $param=[
        'brands' => $brands
       ];
       return  view('back-end.brand.index');

        } catch (Exception $e) {
            Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
            abort(403);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try {
            $data=$request->only('data','logo');
             $this->brandService->create($data);
            $notification = array(
                'message' => 'Added successFully',
                'alert-type' => 'success'
            );
            return redirect()->route("category.index")->with($notification);
    } catch (Exception $e) {
        Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
        $notification = array(
            'message' => 'Added successFully',
            'alert-type' => 'error');
            return redirect()->route("category.index")->with($notification);
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
             $this->brandService->find($id);
        return view('back-end.brand.show');
        } catch (Exception $e) {
            Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
            abort(403);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->brandService->find($id);
        return view('back-end.brand.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
