<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Mobil;
class MobilAPI extends ResourceController{
    public function index($id = null){
        if (trim($this->request->header('Authorization')) !== trim("Authorization: Bearer " . getenv('api_key')))
            return $this->response->setStatusCode(401)->setHeader('WWW-Authenticate','Bearer');
        $model = model(Mobil::class);
        $data = ($id) ? $model->getDataMobil($id) : $model->getDataMobil();
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
