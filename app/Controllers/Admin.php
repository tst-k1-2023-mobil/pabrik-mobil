<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        if (session()->get('user') != '1') return redirect()->to('/login');
        
        $data['programName'] = 'Admin Pabrik';
        $data['serverName'] = 'DB';

        return view('admin',$data);
    }
}