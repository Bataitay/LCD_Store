<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\BaseService;

class CategoryService extends BaseService implements CategoryServiceInterface {

    public $repository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }


}
