<?php
namespace App\Repositories;

interface RepositoryInterface{
    public function all($request);
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);



}
