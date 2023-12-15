<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Mobil;
use App\Models\Assembly;

class Order extends ResourceController{
    public function create(){
        if (trim($this->request->header('Authorization')) !== trim("Authorization: Bearer " . getenv('api.key')))
            return $this->response->setStatusCode(401)->setHeader('WWW-Authenticate','Bearer');

        $mobil = model(Mobil::class);
        $assembly = model(Assembly::class);
        date_default_timezone_set("Asia/Jakarta");

        $mobilId = $this->request->getJsonVar('mobilId');
        $jumlah = $this->request->getJsonVar('jumlah');

        $readyStock = $mobil->order($mobilId,$jumlah);
        if ($readyStock < $jumlah) {
            $backOrder = $assembly->order($mobilId,$jumlah-$readyStock);
            $returnObject = [
                'backOrder' => true,
                'waitTime' => max((int) date_diff(date_create('yesterday'),date_create($backOrder['tglSelesai']))->format("%r%d"),0)
            ];
        } else {
            $returnObject = [
                'backOrder' => false,
            ];
        }

        return $this->response->setStatusCode(201)->setJSON($returnObject);
    }
}