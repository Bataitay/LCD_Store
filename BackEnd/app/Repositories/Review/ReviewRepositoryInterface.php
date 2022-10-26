<?php
namespace App\Repositories\Review;

use App\Repositories\RepositoryInterface;

interface ReviewRepositoryInterface extends RepositoryInterface{
    public function changeStatus($id,$data);
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchReview($name);
    public function answer($data);
    public function getReview($id);
}
