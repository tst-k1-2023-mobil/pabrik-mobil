<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Assembly;

class Queue extends ResourceController{
    public function index(){
        $model = model(Assembly::class);
        $data = ['queueLength' => max((int) date_diff(date_create('yesterday'),date_create($model->getAssemblyQueue()))->format("%r%d"),0)];
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}