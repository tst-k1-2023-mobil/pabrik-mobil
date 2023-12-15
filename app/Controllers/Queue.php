<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Assembly;

class Queue extends ResourceController{
    public function index(){
        if (trim($this->request->header('Authorization')) !== trim("Authorization: Bearer " . getenv('api.key')))
            return $this->response->setStatusCode(401)->setHeader('WWW-Authenticate','Bearer');
        $model = model(Assembly::class);
        date_default_timezone_set("Asia/Jakarta");
        
        $data = ['waitTime' => max((int) date_diff(date_create('yesterday'),date_create($model->getAssemblyQueue()))->format("%r%d"),0)];
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}