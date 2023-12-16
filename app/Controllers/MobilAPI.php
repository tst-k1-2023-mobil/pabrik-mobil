<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Mobil;
class MobilAPI extends ResourceController{
    public function index($id=false){
        $model = model(Mobil::class);
        $data = $model->getDataMobil($id);
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
