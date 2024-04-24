<?php
namespace App\Controllers;
use App\Config\Services;
use App\Models\Produk_Model;


class Produk extends BaseController{
    
    protected $ProdukModel;
    
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){

        $this->ProdukModel = new Produk_Model();

    }
    
    public function index(){
        $produk = $this->ProdukModel->listProduk();

        $data = [
          'title' => 'Daftar Produk Pembiayaan',
          'data_produk' => $produk 
        ];
        
         return view('ub/produkPembiayaanDetail',$data);
    }


    public function uploadProduk(){
        $produk = $this->ProdukModel->dataProdukKredit();

        $data = [
          'title' => 'Upload Produk Pembiayaan',
          'data_produk' => $produk 
        ];
        
         return view('ub/uploadProduk',$data);
    }


		public function simpanExcelProduk()
		{
			$file_excel = $this->request->getFile('fileexcel');
			$ext = $file_excel->getClientExtension();
			if($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $render->load($file_excel);
	
			$data = $spreadsheet->getActiveSheet()->toArray();
			$sukses=0;
			$gagal=0;
	
			foreach($data as $x => $row) {
				if ($x == 0) {
					continue;
				}
				
				$id = $row[0];
				$nama_barang = $row[1];
				$harga_jual = $row[2];
				$harga_pokok = $row[3];
				$dp = $row[4];
				$angsuran = $row[5];
				$tenor = $row[6];

				
	
				
				$db = \Config\Database::connect();

				$cekID = $db->table('produk_kredit')->getWhere(['nama_barang'=>$nama_barang,'angsuran'=>$angsuran,'tenor'=>$tenor])->getResult();
				$errors[]='';
				if(count($cekID) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Nama Barang, Angsura, Tenor Duplikat</b>');
				    
				} else {
				$sukses++;
				$simpandata = [
					'id' => $id, 'nama_barang' => $nama_barang, 'harga_jual'=> $harga_jual, 'harga_pokok'=>$harga_pokok, 'dp'=>$dp, 'angsuran'=>$angsuran, 'tenor'=>$tenor
				];
	
				$db->table('produk_kredit')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal :'.$gagal.' record');
			
			return redirect()->to(base_url('Produk/uploadProduk'));
			
		}


    public function hapusProduk(){
        $this->ProdukModel->hapusProdukAll();
		return redirect()->to(base_url('Produk/uploadProduk'));
    }


public function createProduk(){
    $validation = \Config\Services::validation();
 
    $data = [
        'title' => 'Tambah Data Penjualan',
        'validation' => \Config\Services::validation(),
        'nama_barang' => '',
        'harga_jual' => '',
		'dp' => '',
        'harga_pokok' => '',
        'angsuran' => '',
		'tenor' => ''
    ];


    return view('/ub/inputProdukPembiayaan',$data);
    
}

public function delete($id)
{
    $this->ProdukModel->delete($id);
    session()->setFlashdata('pesan','Data Produk berhasil dihapus.');

    return redirect()->to('/ub/produk');

}

public function simpanProduk(){
    if(!$this->validate([
        'nama_barang' => 'required',
        'harga_jual' => 'required|decimal',
        'harga_pokok' => 'required|decimal',
		'angsuran' => 'required|decimal',
		'tenor' => 'required|decimal' ])
		
)
		{    

        
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Produk',
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'harga_pokok' => $this->request->getVar('harga_pokok'),
			'dp' => $this->request->getVar('dp'),
            'angsuran' => $this->request->getVar('angsuran'),
            'tenor' => $this->request->getVar('tenor'),
			'validasi' => \Config\Services::validation()
        ];
        return view('/ub/inputProdukPembiayaan',$data);
        
    }

    
    $this->ProdukModel->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'harga_pokok' => $this->request->getVar('harga_pokok'),
			'dp' => $this->request->getVar('dp'),
			
            'angsuran' => $this->request->getVar('angsuran'),
            'tenor' => $this->request->getVar('tenor')
    ]);
    session()->setFlashdata('pesan','Data Produk berhasil ditambahkan.');

    return redirect()->to('/ub/produk');
        

}


public function editProduk($id)
{
    $dataProduk = $this->ProdukModel->getProduk($id); 
    $validation = \Config\Services::validation();


    $data = [
        'title' => 'Edit Data Produk',
        'id' => $id,
        'produk' => $dataProduk,
        'validation' => $validation
    ];   
    return view('/ub/ubahProduk',$data);
     
}


public function saveEdit()
    {
        $id = $this->request->getVar('id');
        $this->ProdukModel->updateProduk($id, [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'harga_pokok' => $this->request->getVar('harga_pokok'),
			'dp' => $this->request->getVar('dp'),
			
            'angsuran' => $this->request->getVar('harga_jual'),
            'tenor' => $this->request->getVar('harga_pokok')
            ]);

            session()->setFlashdata('pesan','Data Produk berhasil diedit.');

            return redirect()->to('/ub/produk');
        
    }

public function hapus($id){

    $this->ProdukModel->hapusProduk($id);

    session()->setFlashdata('pesan','Data Produk berhasil dihapus.');

    return redirect()->to('/ub/produk');

}

    }
