<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data['programName'] = 'Admin Pabrik';
        $data['serverName'] = 'DB';

        if (isset($_POST["logout"])) {
            session()->set('user','0');
            return view('admin',$data);
        }

        if (isset($_POST['email'])) {
            if ($_POST['email'] == getenv('admin.email') && $_POST['password'] == getenv('admin.password')) {
                session()->start();
                session()->set('token',rand(1, 1e6));
                session()->set('user','1');
                $_POST['auth'] = [];
                return view('admin',$data);
            } else {
                session()->set('user','0');
                return redirect()->to('/?invalidLogin');
            }
        }

        if (session()->get('user') == '1') return view('admin',$data);
        return view('login');
        

        
    }
}