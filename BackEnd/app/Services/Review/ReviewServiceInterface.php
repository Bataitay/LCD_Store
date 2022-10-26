<?php
namespace App\Services\Review;

use App\Services\ServiceInterface;

interface ReviewServiceInterface extends ServiceInterface
{
    public function changeStatus($id,$data);
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchReview($name);
    public function answer($data);
    public function getReview($id);
}
