<?php

namespace App\Controllers;
use App\Models\M_login;

class Login extends BaseController
{

   protected function isLoggedIn()
   {
        return session()->has('id');
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('dashboard');
        }

        $data['title']='Login';
        echo view ('partial_login/header_login', $data);
        echo view('login/view');
        echo view('partial_login/footer_login');
    }

    public function aksi_login()
    {
        $u=$this->request->getPost('username');
        $p=$this->request->getPost('password');


        $model= new M_login();
        $data=array(
            'username'=>$u,
            'password'=>$p

        );
        $cek=$model->getLoginWithPassword('user', $u, $p);
        if ($cek !== null) {
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            session()->set('level', $cek['level']);
            return redirect()->to('dashboard');
        }else {
            // Tambahkan peringatan username atau password salah
            session()->setFlashdata('error', ' Username atau password Anda salah');
            return redirect()->to('login');
        }
    }

    public function log_out()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}