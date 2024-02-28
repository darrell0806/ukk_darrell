<?php

namespace App\Controllers;
use App\Models\M_user;
use App\Models\M_model;


class User extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 ) {
            $model = new M_user();
            $on = 'user.level=level.id_level';

            if (session()->get('level') == 2) {
            // Jika user memiliki level 2 (misalnya), maka hindari menampilkan data dengan level 1
                $data['jojo'] = $model->join2WithExcludedLevel('user', 'level', $on, 1);
            } else {
            // Tampilkan semua data
                $data['jojo'] = $model->join2('user', 'level', $on);
            }

            $data['title'] = 'Data User';
            echo view('partial/header_datatable', $data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('user/view', $data);
            echo view('partial/footer_datatable');
        } else {
            return redirect()->to('login');
        }
    }


    public function reset_password($id)
    {
        if(session()->get('level')== 1) {
            $model=new M_user();
            $where=array('id_user'=>$id);
            $user=array('password'=>md5('12345'));
            $model->qedit('user', $user, $where);

            

            return redirect()->to('user');
        }else {
            return redirect()->to('login');

        }
    }
    public function tambah() {
        
        $model = new M_model();
        if (session()->get('level') == 1) {
            $data['a'] = $model->tampil('level');
        } else {
            return redirect()->to('Login');
        }
        $data['title'] = 'Tambah User';
        echo view('partial/header_datatable',$data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('user/tambah', $data);
        echo view('partial/footer_datatable');
  
}

public function aksi_tambah()
{
    if(session()->get('level')==1||  session()->get('level')==2){
    $Model= new M_user();
    $data = $this->request->getPost();
    $photo = $this->request->getFile('foto');
    $Model->insertt($data, $photo);
    return redirect()->to('/User/index/');
}else{
    return redirect()->to('Login');
}
}
public function edit($id)
{
    $userLevel = session()->get('level');
    
    if ($userLevel == 1) {
        $model = new M_user();
        $model2 = new M_Model();
        $data['a'] = $model->getById($id); // Mendapatkan data pengguna berdasarkan $id
        
        if (!$data['a']) {
            return redirect()->to('/User/index');
        }
        
        if ($userLevel == 1) {
            $data['b'] = $model2->tampil('level');
        } 
       
        $data['title'] = 'Edit User';
        echo view('partial/header_datatable',$data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('user/edit', $data);
        echo view('partial/footer_datatable');
    } else {
        return redirect()->to('Login');
    }
}


public function update($id)
{
    if(session()->get('level')==1||  session()->get('level')==2){
    $Model = new M_user();
    $data = $this->request->getPost();
    $photo = $this->request->getFile('foto');

   
    if ($photo->isValid() && ! $photo->hasMoved()) {
       
        $Model->updateP($id, $data, $photo);
    } else {
       
        $Model->update($id, $data);
    }

    return redirect()->to('/User/index');
}else{
    return redirect()->to('Login');
}
}

public function delete($id)
{
    if(session()->get('level')==1){
    $Model = new M_user();
    $Model->deletee($id);
    return redirect()->to('/User/index/');
}else{
    return redirect()->to('Login');
}
}
    

}