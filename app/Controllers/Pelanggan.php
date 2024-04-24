<?php
namespace App\Controllers;
use App\Models\SahamKK_Model;
use App\Models\Kelompok_Model;
use App\Models\Saham_Model;
use App\Models\Pelanggan_Model;
use App\Config\Services;

class Pelanggan extends BaseController{
    
    protected $PelangganModel;
    protected $KelompokModel;
    protected $SahamModel;
    
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){

        $this->PelangganModel = new Pelanggan_Model();
        $this->KelompokModel = new Kelompok_Model();
        $this->SahamModel = new Saham_Model();
    }
    
    public function index(){
        $pelanggan = $this->PelangganModel->listPelanggan();

        $data = [
          'title' => 'Daftar Pelanggan',
          'data_pelanggan' => $pelanggan  
        ];
        return view('ub/pelangganDetail',$data);

    }


public function createPelanggan(){
    $validation = \Config\Services::validation();
    $errors = $validation->listErrors();
    $data_kelompok = $this->KelompokModel->getDataKelompok();
    $data_anggota = $this->SahamModel->listAnggota();

    $data = [
        'title' => 'Tambah Data KK',
        'validation' => \Config\Services::validation(),
        'nama_pelanggan' => '',
        'hp' => '',
        'data_kelompok' => $data_kelompok,
        'data_anggota' => $data_anggota

    ];


    return view('/ub/inputPelanggan',$data);
    
}

public function delete($id)
{
    $this->PelangganModel->delete($id);
    session()->setFlashdata('pesan','Data Pelanggan berhasil dihapus.');

    return redirect()->to('/ub/pelanggan');

}

public function simpanPelanggan(){
    if(!$this->validate([
        'nama_pelanggan' => 'required',
        'id_kelompok' => 'required'
    ])) {    

        $data_kelompok = $this->KelompokModel->getDataKelompok();
        $data_anggota = $this->SahamModel->listAnggota();
    
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Pelanggan',
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'hp' => $this->request->getVar('hp'),
            'id_anggota' => $this->request->getVar('id'),
            'id_kelompok' => $this->request->getVar('id_kelompok'),
            'validasi' => \Config\Services::validation(),
            'data_kelompok' => $data_kelompok,
            'data_anggota' => $data_anggota
    
        ];
        return view('/ub/inputPelanggan',$data);
        
    }

    
    $this->PelangganModel->save([
        'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
        'hp' => $this->request->getVar('hp'),
        'id_anggota' => $this->request->getVar('id'),
        'id_kelompok' => $this->request->getVar('id_kelompok')
    ]);
    session()->setFlashdata('pesan','Data Pelanggan berhasil ditambahkan.');

    return redirect()->to('/ub/pelanggan');
        

}


public function editPelanggan($id)
{
    $dataPelanggan = $this->PelangganModel->getPelanggan($id); 
    $data_kelompok = $this->KelompokModel->getDataKelompok();

    $data = [
        'title' => 'Edit Data Pelanggan',
        'pelanggan' => $dataPelanggan,
        'data_kelompok' => $data_kelompok
    ];   
    return view('/ub/ubahPelanggan',$data);

}


public function saveEdit()
    {
        $id = $this->request->getVar('id');
        $this->PelangganModel->updatePelanggan($id, [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'hp' => $this->request->getVar('hp'),
            'id_kelompok' => $this->request->getVar('id_kelompok')
            ]);

            session()->setFlashdata('pesan','Data Pelanggan berhasil diedit.');

            return redirect()->to('/ub/pelanggan');
        
    }

public function hapus($id){

    $this->PelangganModel->hapusPelanggan($id);

    session()->setFlashdata('pesan','Data Pelanggan berhasil dihapus.');

    return redirect()->to('/ub/pelanggan');

}

    }
