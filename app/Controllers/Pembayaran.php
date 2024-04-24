<?php
namespace App\Controllers;
use App\Models\Kalender_Model;
use App\Models\Invoice_Model;
use App\Models\Pembayaran_Model;
use App\Models\PembayaranKredit_Model;
use App\Models\Config_Model;
use App\Models\Nasabah_Model;


use App\Config\Services;

class Pembayaran extends BaseController{
       
	protected $PembayaranModel;
    protected $KalenderModel;
    protected $InvoiceModel;
    protected $ConfigModel;
    protected $NasabahModel;
	protected $PembayaranKreditModel;
	

    public function __construct(){

        $this->PembayaranModel = new Pembayaran_Model();
        $this->KalenderModel = new Kalender_Model();
        $this->InvoiceModel = new Invoice_Model();
		$this->ConfigModel = new Config_Model();
		$this->NasabahModel = new Nasabah_Model();
		$this->PembayaranKreditModel = new PembayaranKredit_Model();
		

    }
    
    public function index(){
        
		$bulan = $this->request->getVar('bulan'); 
		$tahun = $this->request->getVar('tahun');
		if($bulan == '' && $tahun == '')
		{
			$bulan=date('m');
			$tahun=date('Y');
		}
		$data_bayar = $this->PembayaranModel->listBayar($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Pembayaran Invoice',
		  'bulan' => $bulan,
          'tahun' => $tahun,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun,
		  'data_bayar' => $data_bayar	
        ];
		 return view('ub/pembayaranDetail',$data);

    }


   public function detailBayar($id_invoice = false){
	   $bayar = $this->PembayaranModel->detailBayar($id_invoice);
       $data = [
          'title' => 'Detail Pembayaran',
          'data_bayar' => $bayar          		  
        ];
		 return view('ub/detailBayar',$data);
		

   }

   public function rincianBayarKredit($id = false){
	   $bayar = $this->PembayaranKreditModel->rincianBayarKredit($id);
       $data = [
          'title' => 'Detail Pembayaran Angsuran',
          'data_bayar' => $bayar          		  
        ];
		 return view('ub/rincianBayarKredit',$data);
   }







   public function createBayar($id = false, $sisaBayar = 0){

        $invoice = $this->InvoiceModel->getInvoiceId($id);
		$no = $this->PembayaranModel->nomorBayar();
		$bulan=date('m');
		$tahun=date('Y');
		$paidNumber =  str_pad($no,4,"0",STR_PAD_LEFT)."_UB-BSM-PAID_".$bulan.$tahun;
		


        $data = [
          'title' => 'Input Pembayaran',
          'tgl_bayar' => '',
          'keterangan' => '',
		  'deskripsi' => '',
		  'no_bayar' => $paidNumber,
		  'sisa_bayar' => $sisaBayar,
		  'jml_bayar' => 0,
		  'data_invoice' => $invoice
          		  
        ];
		//dd($data);
        
         return view('ub/inputBayar',$data);

    }
	
	
   public function createBayarKredit($id = false, $sisaBayar = 0,$urut=0){

        $no = $this->PembayaranModel->nomorBayarKredit();
		$bulan=date('m');
		$tahun=date('Y');
		
		$kredit=$this->NasabahModel->detailKredit($id);
		
		$kode = $this->ConfigModel->getConfig('NO_BAYAR_KREDIT');
		
		$paidNumber =  str_pad($no,4,"0",STR_PAD_LEFT)."/".$kode['nama_kode'].$urut."/".$bulan.$tahun;
		


        $data = [
          'title' => 'Input Pembayaran',
          'id' => $id,
		  'tgl_bayar' => '',
          'keterangan' => 'Angsuran ke-'.$urut,
		  'jumlah' => 0,
		  'no_bayar' => $paidNumber,
		  'sisa_bayar' => $sisaBayar,
		  'data_kredit' => $kredit
          		  
        ];
        
         return view('ub/inputBayarKredit',$data);

    }
	
    public function uploadBayarKredit(){
        $produk = $this->ProdukModel->dataProdukKredit();

        $data = [
          'title' => 'Upload Produk Pembiayaan',
          'data_produk' => $produk 
        ];
        
         return view('ub/uploadProduk',$data);
    }


		public function simpanExcelBayarKredit()
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
	



public function simpanBayar(){
    if(!$this->validate([
		'no_bayar' => 'required',
		'tgl_bayar' => 'required',
		'jml_bayar' => 'required',
        'keterangan' => 'required'
		])) {    


    $bulan=date('m');
	$tahun=date('Y');
	$validation = \Config\Services::validation();
	$no_bayar=$this->PembayaranModel->nomorBayar();
    $paidNumber =  str_pad($no_bayar,4,"0",STR_PAD_LEFT)."/UB-BSM-PAYMENT/".$bulan.$tahun;
    $id = $this->request->getVar('id_invoice');
	$invoice = $this->InvoiceModel->getInvoiceId($id);
	
        $data = [
            'title' => 'Simpan Data Pembayaran',
			'data_invoice' => $invoice,
			'no_bayar' => $this->request->getVar('no_bayar'),
            'tgl_bayar' => $this->request->getVar('tgl_bayar'),
            'jml_bayar' => $this->request->getVar('jml_bayar'),
			'sisa_bayar' => $this->request->getVar('sisa_bayar'),
            'keterangan' => $this->request->getVar('keterangan'),
            'validasi' => \Config\Services::validation()
    
        ];
		return view('/ub/inputBayar',$data);
        
    }

    
    $this->PembayaranModel->insertBayar([
        'id_invoice' => $this->request->getVar('id_invoice'),
        'tgl_bayar' => $this->request->getVar('tgl_bayar'),
        'jumlah_bayar' => $this->request->getVar('jml_bayar'),
		'keterangan' => $this->request->getVar('keterangan'),
		'no_bayar' => $this->request->getVar('no_bayar')
		
    ]);
	
	
    session()->setFlashdata('pesan','Data Pembayaran berhasil disimpan.');

    return redirect()->to('/ub/pembayaran');
        

}



public function simpanBayarKredit(){
    if(!$this->validate([
		'no_bayar' => 'required',
		'tgl_bayar' => 'required',
		'jumlah' => 'required',
        'keterangan' => 'required'
		])) {    


    $bulan=date('m');
	$tahun=date('Y');
	$validation = \Config\Services::validation();
	$id = $this->request->getVar('id_kredit');
	$sisaBayar = $this->request->getVar('sisa_bayar');
	
	$kredit=$this->NasabahModel->detailKredit($id);
		
        $data = [
            'title' => 'Simpan Data Pembayaran Kredit',
			'data_kredit' => $kredit,
			'id' => $id,
			'sisa_bayar' => $sisaBayar,
			'tgl_bayar' => $this->request->getVar('tgl_bayar'),
			'keterangan' => $this->request->getVar('keterangan'),
			'jumlah' => $this->request->getVar('jumlah'),
			'no_bayar' => $this->request->getVar('no_bayar'),
			'sisa_bayar' => $sisaBayar,
            'validasi' => \Config\Services::validation()
    
        ];
		return view('/ub/inputBayarKredit',$data);
        
    }

    
    $this->PembayaranKreditModel->insertBayar([
        'tgl_bayar' => $this->request->getVar('tgl_bayar'),
        'jumlah' => $this->request->getVar('jumlah'),
		'no_bayar' => $this->request->getVar('no_bayar'),
		'id_kredit' => $this->request->getVar('id_kredit'),
		'keterangan' => $this->request->getVar('keterangan')
		
    ]);
	
	
    session()->setFlashdata('pesan','Data Pembayaran Kredit berhasil disimpan.');

    return redirect()->to('/ub/pembayaranKredit');
        

}




public function delete($id)
{
    $this->PembayaranModel->delete($id);
    session()->setFlashdata('pesan','Data Pembayaran berhasil dihapus.');

    return redirect()->to('/ub/pembayaran');

}


public function edit($id)
{
    $dataPembayaran = $this->PembayaranModel->getPembayaran($id); 
    $validation = \Config\Services::validation();


    $data = [
        'title' => 'Edit Data Pembayaran',
        'id_pembayaran' => $id,
        'pembayaran' => $dataPembayaran,
        'validation' => $validation
    ];   
    return view('/ub/ubahPembayaran',$data);
     
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

    $this->InvoiceModel->hapusInvoice($id);

    session()->setFlashdata('pesan','Data Invoice berhasil dihapus.');

    return redirect()->to('/ub/Invoice');

}

    }
