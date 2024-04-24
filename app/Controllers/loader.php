<?php
namespace App\Controllers;
use App\Config\Services;

class loader extends BaseController{
    
    protected $request;
    public $validation;
    
    
    public function index(){
        
        $data = [
          'title' => 'Loader'  
        ];
        return view('ub/loader',$data);

    }


 

public function delete($id)
{
    $this->tipeSahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/uploadtipeSaham');

}



    }
