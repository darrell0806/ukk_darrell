<?php

namespace App\Controllers;
use App\Models\M_model;
class Home extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('menu');
        echo view('footer');
    }
    public function pendaftaran()
    {
        echo view ('partial_login/header_login');
        echo view('pendaftaran');
        echo view('partial_login/footer_login');
       
	
    }
    public function aksi_tambah_user()
{
    $a = $this->request->getPost('username');
    $b = $this->request->getPost('pswd');
    $c = $this->request->getPost('email');
    $d = $this->request->getPost('nama');
    
  
    $imageName = 'default.png';

    $simpan = array(
        'username' => $a,
        'password' =>md5($b),
        'level'=>'3',
        'email' => $c,
        'nama' => $d,
        'foto' => $imageName
    );

    $model = new M_model();
    $model->simpan('user', $simpan);

    return redirect()->to('/login');
}

}
