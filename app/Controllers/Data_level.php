<?php

namespace App\Controllers;
use App\Models\M_level;

class Data_level extends BaseController
{
    public function index()
    {
       if(session()->get('level')== 1) {
        $model=new M_level();
        $data['jojo']=$model->tampil('level');
        $data['title']='Data Level';

        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('data_level/view', $data);
        echo view('partial/footer_datatable');
    }else {
        return redirect()->to('login');
    }
}

public function create()
{
    if(session()->get('level')== 1) {
        $model=new M_level();
        $data['jojo']=$model->tampil('level');
        $data['title']='Data Level';
        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('data_level/create', $data); 
        echo view('partial/footer_datatable');
    }else {
        return redirect()->to('login');
    }
}

public function aksi_create()
{ 
    if(session()->get('level')== 1) {
        $a= $this->request->getPost('level');
        date_default_timezone_set('Asia/Jakarta');

        //Yang ditambah ke user
        $data1=array(
            'nama_level'=>$a,
        );
        $model=new M_level();
        $model->simpan('level', $data1);
        echo view('partial/header_datatable');
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('partial/footer_datatable');
        return redirect()->to('data_level');
    }else {
        return redirect()->to('login');
    }
}
public function edit($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_level();
        $where=array('id_level'=>$id);
        $data['jojo']=$model->getWhere('level',$where);
        $data['level']=$model->tampil('level');
        $data['title']='Data Level';
        echo view('partial/header_datatable', $data);
        echo view('partial/side_menu');
        echo view('partial/top_menu');
        echo view('data_level/edit',$data);
        echo view('partial/footer_datatable');    
    }else {
        return redirect()->to('home');
    }
}

public function aksi_edit()
{ 
    if(session()->get('level')== 1) {
     $a= $this->request->getPost('level');
     $id= $this->request->getPost('id');
     date_default_timezone_set('Asia/Jakarta');

    //Yang ditambah ke user
     $where=array('id_level'=>$id);
     $data1=array(
        'nama_level'=>$a,
        'updated_at'=>date('Y-m-d H:i:s')
    );
     $model=new M_level();
     $model->qedit('level', $data1, $where);
     return redirect()->to('data_level');

 }else {
    return redirect()->to('login');
}
}

public function delete($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_level();
        $where=array('id_level'=>$id);

        $data=array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );

        $model->qedit('level', $data, $where);
        return redirect()->to('data_level');
    }else {
        return redirect()->to('login');
    }
}

}