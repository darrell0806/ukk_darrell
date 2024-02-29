<?php

namespace App\Controllers;

use App\Models\M_model;


class diagram extends BaseController
{

    public function index()
    {
      


            echo view('partial/header_datatable');
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('diagram');
            echo view('partial/footer_datatable');
      
    }
}