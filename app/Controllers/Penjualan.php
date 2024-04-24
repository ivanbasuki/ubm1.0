<?php
namespace App\Controllers;
use App\Models\Kalender_Model;
use App\Models\Penjualan_Model;
use App\Models\Pelanggan_Model;
use App\Models\Saham_Model;
use App\Config\Services;

class Penjualan extends BaseController{
    
    protected $PenjualanModel;
    protected $KelompokModel;
    protected $PelangganModel;
    protected $SahamModel;
    
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){

        $this->PenjualanModel = new Penjualan_Model();
        $this->KalenderModel = new Kalender_Model();
        $this->PelangganModel = new Pelanggan_Model();
        $this->SahamModel = new Saham_Model();

    }
    
    public function index(){
        $bulan=date('m');
        $tahun=date('Y');
        $penjualan = $this->PenjualanModel->listPenjualan($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Penjualan',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_penjualan' => $penjualan,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/penjualanDetail',$data);

    }

    public function Bulanan(){
        $bulan=$this->request->getVar('bulan');
        $tahun=$this->request->getVar('tahun');

        $penjualan = $this->PenjualanModel->listPenjualan($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Penjualan',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_penjualan' => $penjualan,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/penjualanDetail',$data);

    }

public function createPenjualan(){
    $validation = \Config\Services::validation();
    $data_anggota = $this->PelangganModel->listPelanggan();

    $data = [
        'title' => 'Tambah Data Penjualan',
        'validation' => \Config\Services::validation(),
        'id_anggota' => '',
        'tgl_penjualan' => '',
        'jumlah' => '',
        'data_anggota' => $data_anggota
    ];


    return view('/ub/inputPenjualan',$data);
    
}

public function delete($id)
{
    $this->PenjualanModel->delete($id);
    session()->setFlashdata('pesan','Data Penjualan berhasil dihapus.');

    return redirect()->to('/ub/penjualan');

}

public function simpanPenjualan(){
    if(!$this->validate([
        'id_anggota' => 'required',
        'tgl_penjualan' => 'required',
        'jumlah' => 'required'
        
    ])) {    

        $data_anggota = $this->PelangganModel->listPelanggan();

        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Penjualan',
            'id_anggota' => $this->request->getVar('id_anggota'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_penjualan' => $this->request->getVar('tgl_penjualan'),
            'validasi' => \Config\Services::validation(),
            'data_anggota' => $data_anggota
    
        ];
        return view('/ub/inputPenjualan',$data);
        
    }

    
    $this->PenjualanModel->save([
        'id_pelanggan' => $this->request->getVar('id_anggota'),
        'jumlah' => $this->request->getVar('jumlah'),
        'tgl_penjualan' => $this->request->getVar('tgl_penjualan')
    ]);
    session()->setFlashdata('pesan','Data Penjualan berhasil ditambahkan.');

    return redirect()->to('/ub/penjualan');
        

}


public function edit($id)
{
    $dataPenjualan = $this->PenjualanModel->getPenjualan($id); 
    $validation = \Config\Services::validation();


    $data = [
        'title' => 'Edit Data Penjualan',
        'id' => $id,
        'penjualan' => $dataPenjualan,
        'validation' => $validation
    ];   
    return view('/ub/ubahPenjualan',$data);
     
}


public function saveEdit()
    {
        $id = $this->request->getVar('id');
        $this->PenjualanModel->updatePenjualan($id, [
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_penjualan' => $this->request->getVar('tgl_penjualan')
            ]);

            session()->setFlashdata('pesan','Data Penjualan berhasil diedit.');

            return redirect()->to('/ub/penjualan');
        
    }

public function hapus($id){

    $this->PenjualanModel->hapusPenjualan($id);

    session()->setFlashdata('pesan','Data Penjualan berhasil dihapus.');

    return redirect()->to('/ub/penjualan');

}

    }
