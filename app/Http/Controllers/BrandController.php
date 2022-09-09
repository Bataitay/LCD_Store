<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\Brand\BrandServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        try {
            $brands = $this->brandService->all($request);
            $params = [
                'brands' => $brands
            ];
            return  view('back-end.brand.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }

    public function create()
    {
        return view('back-end.brand.create');
    }

    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->brandService->create($request->all());
            $notification = array(
                'message' => 'Added successFully',
                'alert-type' => 'success'
            );
            DB::commit();
            return redirect()->route("brand.index")->with($notification);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Added errors',
                'alert-type' => 'error'
            );
            return redirect()->route("brand.index")->with($notification);
        }
    }

    public function show($id)
    {
        try {
           $brand = $this->brandService->find($id);
           $params=[
            'brand' => $brand
           ];
            return view('back-end.brand.show',$params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }

    public function edit($id)
    {
        try {
            $brand = $this->brandService->find($id);
            $params = [
                'brand' => $brand
            ];
            return view('back-end.brand.edit', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }

    public function update($id, UpdateBrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->brandService->update($id, $request->all());
            DB::commit();
            $notification = array(
                'message' => 'Update successFully',
                'alert-type' => 'success'
            );
            return redirect()->route("brand.index")->with($notification);
        } catch (Exception $e) {
            Db::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Update errors',
                'alert-type' => 'error'
            );
            return redirect()->route("brand.index")->with($notification);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $brand = $this->brandService->find($id);
            $brand->delete();
            DB::commit();
            $messages = 'Deleted successfully.' . $brand->name;
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 200);
        }
    }

    public function getTrash()
    {
        try {
            $brands = $this->brandService->getTrash();
            $params = [
                'brands' => $brands
            ];
            return view('back-end.brand.softDelete', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }

    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->brandService->restore($id);
            DB::commit();
            $messages = 'Restore successfully.';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 200);
        }
    }

    public function forceDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->brandService->forceDelete($id);
            DB::commit();
            $messages = 'Force delete successfully!!';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Force Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 200);
        }
    }

    public function searchByName(Request $request)
    {
        $brands=[];
        try {
                   $keyword = $request->input('keyword');
        $brands = $this->brandService->searchBrand($keyword);
        return response()->json($brands,200);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            return response()->json($brands,500);
        }

    }
    public function searchBrand(Request $request)
    {
        $brands=[];
        try {
            $keySearch=$request->keySearch;
            $brands =$this->brandService->searchBrand($keySearch);
        $params = [
            'brands' => $brands
        ];
        return  view('back-end.brand.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            return response()->json(['brands' => $brands],500);
        }

    }
}
