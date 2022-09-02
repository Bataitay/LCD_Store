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
    public function all()
    {
        return $this->repository->all();
    }
    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }
}
