<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Mobil;
class MobilAPI extends ResourceController{
    public function index(){
        $model = model(Mobil::class);
        $data = $model->getDataMobil();
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
