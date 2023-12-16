<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        session()->set('user','0');
        return view('login');
    }

    public function login()
    {
        if ($_POST['email'] == getenv('admin.email') && $_POST['password'] == getenv('admin.password')) {
            session()->start();
            session()->set('user','1');
            return redirect()->to('/admin');
        } else {
            session()->set('user','0');
            return redirect()->to('/login?invalid');
        }
    }
}