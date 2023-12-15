<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('user') == '1') {return redirect()->to('/admin');}
        return redirect()->to('/login');
    }
}
