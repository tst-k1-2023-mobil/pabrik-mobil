<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Mobil;
class MobilAPI extends ResourceController{
    public function index($id=false){
        if (trim($this->request->header('Authorization')) !== trim("Authorization: Bearer " . getenv('api.key')))
            return $this->response->setStatusCode(401)->setHeader('WWW-Authenticate','Bearer');
        $model = model(Mobil::class);
        $data = $model->getDataMobil($id);
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
