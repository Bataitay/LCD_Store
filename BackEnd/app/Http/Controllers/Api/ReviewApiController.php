<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Review\ReviewServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReviewApiController extends Controller
{
    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function index(Request $request)
    {

        try {
            $reviews =  $this->reviewService->all($request);
            $statusCode = 200;
            return response()->json($reviews, $statusCode);
        } catch (\Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            $reviews = [];
            $statusCode = 500;
            return response()->json($reviews, $statusCode);
        }
    }
    public function store(Request $request)
    {
        try {
            $review =  $this->reviewService->create($request->all());
            $statusCode = 200;
            return response()->json($review, $statusCode);
        } catch (\Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            $statusCode = 500;
            $review =  [];
            return response()->json($review, $statusCode);
        }
    }
    public function update($id, Request $request)
    {
        try {
            $newReview =  $request->all();
            $this->reviewService->update($id, $newReview);
            $statusCode = 200;
            return response()->json($newReview, $statusCode);
        } catch (\Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            $statusCode = 500;
            $newReview =  [];
            return response()->json($newReview, $statusCode);
        }
    }
    public function destroy($id)
    {
        try {
            $review =  $this->reviewService->find($id);
            $this->reviewService->delete($id);
            $statusCode = 200;
            return response()->json($review, $statusCode);
        } catch (\Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            $statusCode = 500;
            $newReview =  [];
            return response()->json($newReview, $statusCode);
        }
    }
}
