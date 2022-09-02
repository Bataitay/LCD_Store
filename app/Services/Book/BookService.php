<?php
namespace App\Services\Book;

use App\Repositories\Book\BookRepositoryInterface;
use App\Services\Book\BookServiceInterface;
use App\Services\BaseService;

class BookService extends BaseService implements BookServiceInterface{
    public $repository;

    function __construct(BookRepositoryInterface $bookRepositoryInterface)
    {
        $this->repository = $bookRepositoryInterface;
    }
}