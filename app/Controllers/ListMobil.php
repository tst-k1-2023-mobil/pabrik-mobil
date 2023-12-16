<?php

namespace App\Controllers;
use App\Models\Mobil;

class Listmobil extends BaseController
{
    public function index(): string
    {
        $mobilModel = new Mobil();
        $mobil = $mobilModel->getDataMobil();
        $data = [ 
            "mobil" => $mobil
        ];
        return view('listmobil',$data);
    }
}