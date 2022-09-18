<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $productService;
    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        if (Gate::denies('List_Product', 'List_Product')) {
            abort(403);
        }
        $products = $this->productService->all($request);
        $categories = Category::all();
        $params = [
            'products' => $products,
            'categories' => $categories,
        ];

        return view('back-end.product.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('Add_Product', 'Add_Product')) {
            abort(403);
        }
        $categories = Category::get();
        $brands = Brand::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
        ];

        return view('back-end.product.add', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if (Gate::denies('Add_Product', 'Add_Product')) {
            abort(403);
        }
        try {
            $this->productService->create($request);
            $notification = array(
                'message' => 'Added product successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.index')->with($notification);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Added product faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        if (Gate::denies('Show_Product', 'Show_Product')) {
            abort(403);
        }
        $product = $this->productService->find($id);
        return view('back-end.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Edit_Product', 'Edit_Product')) {
            abort(403);
        }
        $product = $this->productService->find($id);
        $categories = Category::get();
        $brands = Brand::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
        ];

        return view('back-end.product.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        if (Gate::denies('Edit_Product', 'Edit_Product')) {
            abort(403);
        }
        try {
            $data = $request->all();
            $this->productService->update($id, $data);
            $notification = array(
                'message' => 'Edited product successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.index')->with($notification);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Edited product faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Delete_Product', 'Delete_Product')) {
            abort(403);
        }
        $product = $this->productService->delete($id);
        return response()->json($product);
    }
    public function getTrashed()
    {
        $products = $this->productService->getTrashed();
        return view('back-end.product.softDelete', compact('products'));
    }
    public function restore($id)
    {
        $this->productService->restore($id);
        $notification = array(
            'message' => 'Restore product successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.getTrashed')->with($notification);
    }
    public function force_destroy($id)
    {
        try {

        $product = $this->productService->force_destroy($id);
        return response()->json($product);

        }catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Deleted product faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function showStatus($id){

        $product = Product::findOrFail($id);
        $product->status = '1';
        if ($product->save()) {
            return redirect()->back();
        }
    }
    public function hideStatus($id){

        $product = Product::findOrFail($id);
        $product->status = '0';
        if ($product->save()) {
            return redirect()->back();
        }
    }

}
