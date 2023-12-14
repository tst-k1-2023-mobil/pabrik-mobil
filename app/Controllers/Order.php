<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Assembly;

class Order extends ResourceController{
    public function create(){
        $model = model(Assembly::class);
        $mobilId = $this->request->getJsonVar('mobilId');
        return $this->response->setStatusCode(201)->setJSON($model->order($mobilId));
    }
}