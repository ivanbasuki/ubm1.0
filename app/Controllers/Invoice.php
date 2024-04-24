<?php
namespace App\Controllers;
use App\Models\Kalender_Model;
use App\Models\Penjualan_Model;
use App\Models\Invoice_Model;
use App\Models\Kelompok_Model;
use App\Models\Config_Model;

use App\Config\Services;

class Invoice extends BaseController{
       
	protected $PenjualanModel;
    protected $KalenderModel;
    protected $KelompokModel;
    protected $InvoiceModel;
	protected $ConfigModel;
    

    public function __construct(){

        $this->PenjualanModel = new Penjualan_Model();
        $this->KalenderModel = new Kalender_Model();
        $this->InvoiceModel = new Invoice_Model();
		$this->KelompokModel = new Kelompok_Model();
		$this->ConfigModel = new Config_Model();
		

    }
    
    public function index(){
        $bulan=date('m');
        $tahun=date('Y');
		$idkel='';
        $data_kelompok = $this->KelompokModel->getDataKelompok();
		$data_invoice = $this->InvoiceModel->listInvoice();
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Invoice Kelompok',
          'idkel' => '',
		  'bulan' => $bulan,
          'tahun' => $tahun,
		  'data_kelompok' => $data_kelompok,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun,
		  'data_invoice' => $data_invoice	
        ];
		 return view('ub/penjualanKelompokDetail',$data);

    }



    public function invoiceBulanan(){

        $bulan = $this->request->getVar('bulan');
		$tahun = $this->request->getVar('tahun');
        $data_kelompok = $this->KelompokModel->getDataKelompok();
        $data = [
          'title' => 'Daftar Invoice Kelompok',
          'idkel' => $this->request->getVar('kelompok'),
		  'bulan' => $this->request->getVar('bulan'),
          'tahun' => $this->request->getVar('tahun'),
          'data_kelompok' => $this->KelompokModel->getDataKelompok(),
          'data_invoice' => $this->InvoiceModel->listInvoice($bulan,$tahun,$this->request->getVar('kelompok')),
          'data_bulan' => $this->KalenderModel->getBulan(),
          'data_tahun' => $this->KalenderModel->getTahun($tahun)  
        ];
				
         return view('ub/penjualanKelompokDetail',$data);

    }
	
    public function detailInvoiceId($id = false){

        $bulan=date('m');
        $tahun=date('Y');
		
        $penjualan = $this->PenjualanModel->getPenjualanIdInvoice($id);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Penjualan Invoice',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_penjualan' => $penjualan,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/penjualanDetail',$data);

    }
	
	

public function createInvoice($bulan = false, $tahun = false, $kelompok = false){
    $validation = \Config\Services::validation();
    $data_penjualan = $this->PenjualanModel->listPenjualanKelompok($bulan,$tahun,$kelompok);
	$no_invoice=$this->InvoiceModel->nomorInvoice();
    $kode_invoice=$this->ConfigModel->getConfig('NO_INVOICE');
	
	$invNumber =  str_pad($no_invoice,4,"0",STR_PAD_LEFT)."/".$kode_invoice['nama_kode'].$kelompok."/".$bulan.$tahun;

    $data = [
        'title' => 'Tambah Data Invoice',
        'validation' => \Config\Services::validation(),
        'id_invoice' => '',
        'tgl_invoice' => '',
		'deskripsi' => 'INVOICE('.$kelompok.')'.$bulan.$tahun,
		'no_invoice' => $invNumber,
		'bulan' => $bulan,
		'tahun' => $tahun,
		'idkel' => $kelompok,
        'jumlah' => '',
		'ids' => '',
        'data_penjualan' => $data_penjualan
    ];

    return view('/ub/inputInvoice',$data);
    
}

public function simpanInvoice(){
    if(!$this->validate([
		'id_penjualan' => 'required',
		'no_invoice' => 'required',
        'tgl_invoice' => 'required',
        'deskripsi' => 'required',
		'jumlah' => 'required'
		])) {    

	$bulan=$this->request->getVar('xbulan');
	$tahun=$this->request->getVar('xtahun');
	$kelompok=$this->request->getVar('xidkel');
	

    $validation = \Config\Services::validation();
    $data_penjualan = $this->PenjualanModel->listPenjualanKelompok($bulan,$tahun,$kelompok);
	$no_invoice=$this->InvoiceModel->nomorInvoice();
    $invNumber =  str_pad($no_invoice,4,"0",STR_PAD_LEFT)."/UB-BSM-".$kelompok."/".$bulan.$tahun;

        $data = [
            'title' => 'Simpan Data Invoice',
            'bulan' => $bulan,
			'tahun' => $tahun,
			'idkel' => $kelompok,
			'id_penjualan' => $this->request->getVar('id_penjualan'),
            'no_invoice' => $this->request->getVar('no_invoice'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_invoice' => $this->request->getVar('tgl_invoice'),
			'deskripsi' => $this->request->getVar('deskripsi'),
            'validasi' => \Config\Services::validation(),
            'data_penjualan' => $data_penjualan
    
        ];
        dd($data);
		return view('/ub/inputInvoice',$data);
        
    }

    
    $this->InvoiceModel->insertInvoice([
        'no_invoice' => $this->request->getVar('no_invoice'),
        'total' => $this->request->getVar('jumlah'),
        'tgl_invoice' => $this->request->getVar('tgl_invoice'),
		'deskripsi' => $this->request->getVar('deskripsi')
		
    ]);
	
	$noInvoice = $this->InvoiceModel->insertID();
	
	$ids = $this->request->getVar('ids');
	$var_id = explode(",",$ids);
	
	$txt='';
	if(!empty($var_id))
	{ foreach($var_id as $x => $y)
		{
			$txt.=$y.',';
			$this->PenjualanModel->updatePenjualan($y,
			[ 'id_invoice' => $noInvoice ]);
		}	
	}
	
	
	
    session()->setFlashdata('pesan','Data '.$txt.' Invoice '.$noInvoice.' berhasil ditambahkan.');

    return redirect()->to('/ub/Invoice');
        

}



public function delete($id)
{
    $this->PenjualanModel->delete($id);
    session()->setFlashdata('pesan','Data Invoice berhasil dihapus.');

    return redirect()->to('/ub/penjualan');

}


public function edit($id)
{
    $dataPenjualan = $this->PenjualanModel->getPenjualan($id); 
    $validation = \Config\Services::validation();


    $data = [
        'title' => 'Edit Data Invoice',
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

    $this->InvoiceModel->hapusInvoice($id);

    session()->setFlashdata('pesan','Data Invoice berhasil dihapus.');

    return redirect()->to('/ub/Invoice');

}

    }
