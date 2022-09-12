<?php
namespace App\Repositories\Api;

abstract class BaseRepository implements RepositoryInterface{
    protected $model;

    function __construct()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();


}
