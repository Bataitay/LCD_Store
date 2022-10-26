<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        if (Gate::denies('List_Category', 'List_Category')) {
            abort(403);
        }
        $categories = $this->categoryService->all($request);
        return view('back-end.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('Add_Category', 'Add_Category')) {
            abort(403);
        }
        return view('back-end.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('Add_Category', 'Add_Category')) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|unique:categories|min:6|max:255',
        ]);
        $this->categoryService->create($data);
        $notification = array(
            'message' => 'Added category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::denies('Show_Category', 'Show_Category')) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Edit_Category', 'Edit_Category')) {
            abort(403);
        }
        $category = $this->categoryService->find($id);
        return view('back-end.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Gate::denies('Edit_Category', 'Edit_Category')) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|unique:categories|min:6|max:255',
        ]);
        $this->categoryService->update( $id, $data);
        $notification = array(
            'message' => 'Edited category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Delete_Category', 'Delete_Category')) {
            abort(403);
        }
        $category = $this->categoryService->delete( $id);
        return response()->json($category);
    }
    public function getTrashed(){
        if (Gate::denies('List_Category', 'List_Category')) {
            abort(403);
        }
        $categories = $this->categoryService->getTrashed();
        return view('back-end.category.sorfDelete',compact('categories'));

    }
    public function restore($id){
        if (Gate::denies('Delete_Category', 'Delete_Category')) {
            abort(403);
        }
        $this->categoryService->restore($id);
        $notification = array(
            'message' => 'Restore category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.getTrashed')->with($notification);
    }
    public function force_destroy($id){
        if (Gate::denies('Delete_Category', 'Delete_Category')) {
            abort(403);
        }
        try {
            $category = $this->categoryService->force_destroy( $id);
            return response()->json($category);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'No delete because in category have Product',
                'alert-type' => 'error'
            );
            return redirect()->route('category.getTrashed')->with($notification);
        }
    }
}
