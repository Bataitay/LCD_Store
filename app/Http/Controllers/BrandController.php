<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\Brand\BrandService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
       $params=[
        'brands' => $brands
       ];
       return  view('back-end.brand.index',$params);

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

             $this->brandService->create($request->all());
            $notification = array(
                'message' => 'Added successFully',
                'alert-type' => 'success'
            );
            return redirect()->route("brand.index")->with($notification);
    } catch (Exception $e) {
        Log::error('errors'.$e->getMessage().' getLine'.$e->getLine());
        $notification = array(
            'message' => 'Added errors',
            'alert-type' => 'error');
            return redirect()->route("brand.index")->with($notification);
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
        try {
              $brand = $this->brandService->find($id);
       $params=[
        'brand'=> $brand
       ];
        return view('back-end.brand.edit',$params);
        } catch (Exception $e) {
            Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $this->brandService->update($id,$request->all());
        }catch (Exception $e) {
            Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $id= $request->id;
            $brand =$this->brandService->find($id);
            $brand->delete();
            DB::commit();
            $messages='Deleted successfully.'.$brand->name;
            return response()->json([
                'messages' =>$messages,
                'status' => 1
        ],200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine());
            $messages='Deleted errors!!!please try again.';
            return response()->json(['messages' =>$messages,
            'status' => 0
        ],200);
            }
    }

    public function getTrash()
    {
        try {
            $brands = $this->brandService->getTrash();
     $params=[
      'brands'=> $brands
     ];
     dd($brands);
      return view('back-end.brand.softDelete',$params);
      } catch (Exception $e) {
          Log::error('errors'.$e->getMessage().'getLine'.$e->getLine());
          abort(403);
     }
    }
}
