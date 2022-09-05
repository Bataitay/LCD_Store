<?php

namespace App\Services\Review;

use App\Repositories\Review\ReviewRepositoryInterface;
use App\Services\BaseService;

class ReviewService extends BaseService implements ReviewServiceInterface {

    public $repository;
    public function __construct(ReviewRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;
    }
    public function changeStatus($id, $data)
    {
        return $this->repository->changeStatus($id,$data);
    }
    public function getTrash()
    {
        return $this->repository->getTrash();

    }
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }
    public function searchReview($name)
    {
        return $this->repository->searchReview($name);
    }

}
