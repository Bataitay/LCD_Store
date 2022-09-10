<?php
namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface{
    protected $model;

    function __construct()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    public function all($request){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }

    public function create($data){
        

        return $this->model->create($data);
    }

    public function update($id, $data){
        $object = $this->model->find($id);
        return $object->update($data);
    }

    public function delete($id){
        $object = $this->model->find($id);
        return $object->delete();
    }
}
