<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\Brand\BrandApiServiceInterface;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    protected $brandService;

    public function __construct(BrandApiServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }
    public function index(Request $request)
    {
      $brands = $this->brandService->all($request);
      return response()->json($brands,200);
    }
    public function store(Request $request)
    {
        $data= $request->all();
        $brand =  $this->brandService->create($data);
        return response()->json($brand,200);
    }
    public function show($id)
    {
        $brand =  $this->brandService->find($id);
        return response()->json($brand,200);
    }
    public function update($id,Request $request)
    {
        $data= $request->all();
        $brand =  $this->brandService->update($id, $data);
        return response()->json($brand,200);
    }
    public function destroy($id)
    {
        $brand =  $this->brandService->find($id);
        $brand = $brand->delete();
        return response()->json($brand,200);
    }
}
