<?php
namespace App\Services;

interface ServiceInterface{
    public function all($request);
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
