<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

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
    public function index()
    {
        $categories = $this->categoryService->all();
        return view('back-end.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $data = $request->all();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        // $data = $request->all();
        // $this->categoryService->update( $id, $data);
        // $notification = array(
        //     'message' => 'Edited category successfully',
        //     'alert-type' => 'success'
        // );
        // return redirect()->route('category.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
