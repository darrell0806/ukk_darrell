<?php

namespace App\Controllers;
use App\Models\M_pelanggan;

class Pelanggan extends BaseController
{
    public function index()
    {
        if(session()->get('level')== 1|| session()->get('level') == 2) {
            $model=new M_pelanggan();
            $data['jojo']=$model->tampil('pelanggan');

            $data['title']='Data Pelanggan';
            $data['desc']='Anda dapat melihat Data Pelanggan di Menu ini.';

            echo view('partial/header_datatable', $data);
            echo view('partial/side_menu');
            echo view('partial/top_menu', $data);
            echo view('pelanggan/view', $data);
            echo view('partial/footer_datatable');
        }else {
            return redirect()->to('/');

        }
    }

    public function create()
    {
        if (session()->get('level') == 1|| session()->get('level') == 2) {
            $model=new M_pelanggan();

            $data['title']='Data Pelanggan';
            $data['desc']='Anda dapat tambah Data Pelanggan di Menu ini.'; 
            $data['subtitle'] = 'Tambah Data Pelanggan';

            echo view('partial/header_datatable', $data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('pelanggan/create', $data);
            echo view('partial/footer_datatable');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
{ 
    if (session()->get('level') == 1 || session()->get('level') == 2) {
        $a = $this->request->getPost('nama_pelanggan');
        $b = $this->request->getPost('alamat');
        $c = $this->request->getPost('no_telepon');

        // Validasi apakah nomor telepon sudah ada di database
        $model = new M_pelanggan();
        if ($model->isNoTeleponExists($c)) {
            // Jika nomor telepon sudah ada, tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Nomor telepon sudah ada di database.');
        }

        // Jika nomor telepon belum ada, lanjutkan menyimpan data
        // Data yang akan disimpan
        $data1 = array(
            'NamaPelanggan' => $a,
            'Alamat' => $b,
            'NomorTelepon' => $c
        );

        // Simpan data ke dalam database
        $model->simpan('pelanggan', $data1);

        // Set flash data untuk sukses
        session()->setFlashdata('message', 'Data pelanggan berhasil disimpan.');

        return redirect()->to('pelanggan');
    } else {
        return redirect()->to('/');
    }
}

    

    public function edit($id)
    { 
        if (session()->get('level') == 1|| session()->get('level') == 2) {
            $model=new M_pelanggan();
            $where=array('PelangganID'=>$id);
            $data['jojo']=$model->getWhere('pelanggan',$where);

            $data['title'] = 'Data Pelanggan';
            $data['desc'] = 'Anda dapat mengedit Data Pelanggan di Menu ini.';      
            $data['subtitle'] = 'Edit Data Pelanggan';  

            echo view('partial/header_datatable', $data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('pelanggan/edit', $data);
            echo view('partial/footer_datatable');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1|| session()->get('level') == 2) {
            $a = $this->request->getPost('nama_pelanggan');
            $b = $this->request->getPost('alamat');
            $c = $this->request->getPost('no_telepon');
            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'NamaPelanggan' => $a,
                'Alamat' => $b,
                'NomorTelepon' => $c,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            // Simpan data ke dalam database
            $model = new M_pelanggan();
            $where=array('PelangganID'=>$id);
            $model->qedit('pelanggan', $data1, $where);

            return redirect()->to('pelanggan');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if(session()->get('level')== 1|| session()->get('level') == 2) {
            $model=new M_pelanggan();
            $model->deletee($id);
            return redirect()->to('pelanggan');
        }else {
            return redirect()->to('/');
        }
    }

}