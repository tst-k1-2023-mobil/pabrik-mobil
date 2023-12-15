<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Assembly;

class Order extends ResourceController{
    public function create(){
        if (trim($this->request->header('Authorization')) !== trim("Authorization: Bearer " . getenv('api.key')))
            return $this->response->setStatusCode(401)->setHeader('WWW-Authenticate','Bearer');
        $model = model(Assembly::class);
        $mobilId = $this->request->getJsonVar('mobilId');
        return $this->response->setStatusCode(201)->setJSON($model->order($mobilId));
    }
}