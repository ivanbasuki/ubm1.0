<?php
namespace App\Controllers;
use App\Models\Config_Model;
use App\Config\Services;

class Config extends BaseController{
    
    
    public function __construct(){
		$this->ConfigModel = new Config_Model();
		
    }
    

	    public function index(){
        $dataconfig = $this->ConfigModel->listConfig();
        $dataketua = $this->ConfigModel->getConfig('NAMA_UB');
		
        $data = [
          'title' => 'Konfigurasi Sistem',
          'data_config' => $dataconfig,
		  'data_ketua' => $dataketua 	
        ];
        return view('ub/configDetail',$data);

    }
	

	
	

public function tambahConfig(){

    $data = [
        'title' => 'Tambah Config',
		'id' => '',
		'kode' => '',
		'nama_kode' => ''
		
    ];
	
    return view('ub/inputConfig',$data);
}




public function simpanConfig(){
    $validation = \Config\Services::validation();

    if(!$this->validate([
        'kode' => 'required',
		'nama_kode' => 'required'
		
    ])) {    

    
    $data = [
	'title' => 'Input Konfigurasi',
	'nama_kode' => $this->request->getVar('nama_kode'),
	'kode' => $this->request->getVar('kode'),
        'validation' => $validation ];
    
        return view('ub/inputConfig',$data);

    }

    
    $this->ConfigModel->insertConfig([
        'kode' => $this->request->getPost('kode'),
		'nama_kode' => $this->request->getPost('nama_kode')
        
    ]);
    session()->setFlashdata('pesan','Data Konfigurasi ditambahkan.');

    return redirect()->to('ub/listConfig');
        

}




public function editConfig($id){
    $dataconfig = $this->ConfigModel->listConfig($id);

    $data = [
        'title' => 'Edit Konfigurasi',
		'id' => $id,
		'data_config' => $dataconfig      

    ];
	
    if(empty($data['data_config']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan '.$id);

    }
	
    return view('ub/editConfig',$data);
}



public function deleteConfig($id)
{
    $this->ConfigModel->delete($id);
    session()->setFlashdata('pesan','Data Config berhasil dihapus.');

    return redirect()->to('/ub/listConfig');

}






public function simpanEditConfig()
    {
        $id = $this->request->getPost('id');
        $this->ConfigModel->updateConfig($id, [
            'kode' => $this->request->getPost('kode'),
            'nama_kode' => $this->request->getPost('nama_kode')
            
            ]);

            session()->setFlashdata('pesan','Data berhasil diedit.');

            return redirect()->to('/ub/listConfig');
        
    }



    }
