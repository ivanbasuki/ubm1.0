<?php
namespace App\Controllers;
use App\Config\Services;
use App\Models\Nasabah_Model;
use App\Models\Produk_Model;
use App\Models\Pelanggan_Model;



class Nasabah extends BaseController{
    
    protected $NasabahModel;
    
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){

        $this->NasabahModel = new Nasabah_Model();
		$this->ProdukModel = new Produk_Model();
		$this->PelangganModel = new Pelanggan_Model();

    }
    
    public function index(){
        $nasabah = $this->NasabahModel->listNasabah();

        $data = [
          'title' => 'Daftar Nasabah Pembiayaan',
          'data_nasabah' => $nasabah 
        ];
        
         return view('ub/nasabahDetail',$data);

    }







    public function nasabahBayar(){
        $nasabah = $this->NasabahModel->listNasabah();

        $data = [
          'title' => 'Pembayaran Pembiayaan',
          'data_nasabah' => $nasabah 
        ];
        //dd($data);
         return view('ub/pembayaranKreditDetail',$data);

    }


public function createNasabah(){
    $validation = \Config\Services::validation();
	$data_produk = $this->ProdukModel->listProduk();
	$data_anggota = $this->PelangganModel->listPelanggan();
 
    $data = [
        'title' => 'Tambah Data Nasabah',
        'validation' => \Config\Services::validation(),
        'id' => '',
        'id_kredit' => '',
		'tgl_transaksi' => '',
        'id_anggota' => '',
		'data_produk' => $data_produk,
		'data_anggota' => $data_anggota
    ];


    return view('/ub/inputNasabah',$data);
    
}

public function delete($id)
{
    $this->NasabahModel->delete($id);
    session()->setFlashdata('pesan','Data Nasabah berhasil dihapus.');

    return redirect()->to('/ub/nasabah');

}

public function simpanNasabah(){
    if(!$this->validate([
        'id_anggota' => 'required',
        'id_kredit' => 'required',
        'tgl_transaksi' => 'required' ])
	
)
		{    
		

 	$data_produk = $this->ProdukModel->listProduk();
	$data_anggota = $this->PelangganModel->listPelanggan();
        
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Nasabah',
            'id_kredit' => $this->request->getPost('id_kredit'),
            'id_anggota' => $this->request->getPost('id_anggota'),
            'tgl_transaksi' => $this->request->getPost('tgl_transaksi'),
			'validation' => \Config\Services::validation(),
		'data_produk' => $data_produk,
		'data_anggota' => $data_anggota
			
        ];
        return view('/ub/inputNasabah',$data);
        
    }

    $this->NasabahModel->insertNasabah([
            'id_kredit' => $this->request->getPost('id_kredit'),
            'id_anggota' => $this->request->getPost('id_anggota'),
            'tgl_transaksi' => $this->request->getPost('tgl_transaksi')
			    ]);
    session()->setFlashdata('pesan','Data Nasabah berhasil ditambahkan.');

    return redirect()->to('/ub/nasabah');
        

}


public function editNasabah($id)
{
    $dataNasabah = $this->NasabahModel->getNasabah($id); 
    $validation = \Config\Services::validation();
 	$data_produk = $this->ProdukModel->listProduk();
	$data_anggota = $this->PelangganModel->listPelanggan();


    $data = [
        'title' => 'Edit Data Nasabah',
        'id' => $id,
        'nasabah' => $dataNasabah,
        'validation' => $validation,
		'data_produk' => $data_produk,
		'data_anggota' => $data_anggota

    ];   
    return view('/ub/ubahNasabah',$data);
     
}


public function saveEdit()
    {
        $id = $this->request->getVar('id');
        $this->NasabahModel->updateNasabah($id, [
            'id_kredit' => $this->request->getVar('id_kredit'),
            'id_anggota' => $this->request->getVar('id_anggota'),
            'tgl_transaksi' => $this->request->getVar('tgl_transaksi')
            ]);

            session()->setFlashdata('pesan','Data Nasabah berhasil diedit.');

            return redirect()->to('/ub/nasabah');
        
    }

public function hapus($id){

    $this->NasabahModel->hapusNasabah($id);

    session()->setFlashdata('pesan','Data Nasabah berhasil dihapus.');

    return redirect()->to('/ub/nasabah');

}

    }
