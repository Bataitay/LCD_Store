<?php

namespace App\Http\Controllers;

use App\Services\Review\ReviewServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Request $request)
    {
        if (Gate::denies('List_Review', 'List_Review')) {
            abort(403);
        }
        $reviews =  $this->reviewService->all($request);
        $params = ['reviews' => $reviews];
        return view('back-end.review.index', $params);
    }

    public function create()
    {
        if (Gate::denies('Add_Review', 'Add_Review')) {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Gate::denies('Add_Review', 'Add_Review')) {
            abort(403);
        }
    }

    public function show($id)
    {
        if (Gate::denies('Show_Review', 'Show_Review')) {
            abort(403);
        }
        $review =  $this->reviewService->find($id);
        $params = ['review' => $review];
        return view('back-end.review.show', $params);
    }

    public function edit($id)
    {
        if (Gate::denies('Edit_Review', 'Edit_Review')) {
            abort(403);
        }
        $review =  $this->reviewService->find($id);
        $params = ['review' => $review];
        return view('back-end.review.show', $params);
    }

    public function update($id, Request $request)
    {
        if (Gate::denies('Edit_Review', 'Edit_Review')) {
            abort(403);
        }
        try {
            $newReview =  $this->reviewService->find($id)->toArray();
            $newReview['status'] = $request->status;
            $this->reviewService->update($id, $newReview);
            $notification = array(
                'message' => 'Update successfully',
                'alert-type' => 'success'
            );
            return redirect()->route("review.show", $id)->with($notification);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Update errors',
                'alert-type' => 'error'
            );
            return redirect()->route("review.show", $id)->with($notification);
        }
    }

    public function destroy(Request $request)
    {
        if (Gate::denies('Delete_Review', 'Delete_Review')) {
            abort(403);
        }
        try {
            DB::beginTransaction();
            $id = $request->id;
            $brand = $this->reviewService->find($id);
            $brand->delete();
            DB::commit();
            $messages = 'Deleted successfully.' . $brand->name;
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . '.Line________' . $e->getLine() . ' .File ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function changeStatus($id)
    {
        if (Gate::denies('Edit_Review', 'Edit_Review')) {
            abort(403);
        }
        try {
            DB::beginTransaction();
            $review =  $this->reviewService->find($id)->toArray();
            if ($review['status'] != 1) {
                $review['status'] = 1;
            } else {
                $review['status'] = 0;
            }
            $this->reviewService->update($id, $review);
            DB::commit();
            $notification = array(
                'message' => 'Update successfully',
                'alert-type' => 'success'
            );
            return redirect()->route("review.index")->with($notification);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Added errors',
                'alert-type' => 'error'
            );
            return redirect()->route("review.index")->with($notification);
        }
    }
    public function getTrash()
    {
        if (Gate::denies('List_Review', 'List_Review')) {
            abort(403);
        }
        try {
            $reviews = $this->reviewService->getTrash();
            $params = ['reviews' => $reviews];
            return view('back-end.review.softDelete', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }
    public function restore(Request $request)
    {
        if (Gate::denies('Delete_Review', 'Delete_Review')) {
            abort(403);
        }
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->reviewService->restore($id);
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
            ], 500);
        }
    }

    public function forceDelete(Request $request)
    {
        if (Gate::denies('Delete_Review', 'Delete_Review')) {
            abort(403);
        }
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->reviewService->forceDelete($id);
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
            ], 500);
        }
    }

    public function searchByName(Request $request)
    {
        $keyword = $request->input('keyword');
        $reviews = $this->reviewService->searchReview($keyword);
        return response()->json($reviews);
    }

    public function searchReview(Request $request)
    {
        try {
            $keySearch = $request->keySearch;
            $reviews = $this->reviewService->searchReview($keySearch);
            $params = [
                'reviews' => $reviews
            ];
            return  view('back-end.review.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(404);
        }
    }


}
