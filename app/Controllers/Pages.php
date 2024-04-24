<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        //echo view('Layout/header');
        echo view('Pages/home');
        //echo view('Layout/footer');
        
    }

public function contact()
    {
        echo view('Layout/header');
        echo view('contact');
        echo view('Layout/footer');
        
    }
    


}
