<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {

        $data['programName'] = 'Admin Pabrik';
        $data['serverName'] = 'DB';

        return view('admin',$data);
    }
}