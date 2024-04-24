<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Config\Services;

class User extends BaseController{
    
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->UserModel = new UserModel();
    }
    
    public function index(){
        $dataUser = $this->UserModel->listUser();
        
        $data = [
          'title' => 'Daftar User',
          'data_user' => $dataUser  
        ];
        return view('ub/UserDetail',$data);

    }
	
	
public function tambahUser(){

    $data = [
        'title' => 'Register User'
    ];
	
    return view('ub/register',$data);
}

public function gantiPassword(){

    $data = [
        'title' => 'Ganti Password',
		
    ];
	
    return view('ub/register',$data);
}



    }
