<?php
namespace App\Controllers;
use App\Models\Kalender_Model;
use App\Models\Pengeluaran_Model;
use App\Config\Services;
use App\Models\Kas_Model;


class Pengeluaran extends BaseController{
    
    protected $PengeluaranModel;
    
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){

        $this->PengeluaranModel = new Pengeluaran_Model();
        $this->KalenderModel = new Kalender_Model();
		$this->KasModel = new Kas_Model();

    }
    
    public function index(){
        $bulan=date('m');
        $tahun=date('Y');
        $pengeluaran = $this->PengeluaranModel->listPengeluaran($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Pengeluaran',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_pengeluaran' => $pengeluaran,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/pengeluaranDetail',$data);

    }

    public function uploadPengeluaran(){
		if(!empty($this->request->getVar('bulan')))
		{
			$bulan=$this->request->getVar('bulan');
			$tahun=$this->request->getVar('tahun');
        } else {
			$bulan = date('m');
			$tahun = date('Y');
		}	
		$pengeluaran = $this->PengeluaranModel->listPengeluaran($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Upload Pengeluaran',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_pengeluaran' => $pengeluaran,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/uploadPengeluaranDetail',$data);

    }
 
 		public function simpanExcelPengeluaran()
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
				
				$id_pos = $row[0];
				$deskripsi = $row[1];
				$tgl_transaksi = $row[2];
				$jumlah = $row[3];
				
				
	
				
				$db = \Config\Database::connect();

				$cekID = $db->table('pengeluaran')->getWhere(['id_pos'=>$id_pos,'deskripsi'=>$deskripsi,'tgl_transaksi'=>$tgl_transaksi,'jumlah'=>$jumlah])->getResult();
				$errors='';
				if(count($cekID) > 0) {
					$gagal++;
					$errors .= $id_pos.'|'.$deskripsi.'|'.$tgl_transaksi.'|'.$jumlah.'<br>';
					session()->setFlashdata('message','<b style="color:red">Data Gagal di ID Pos, Deskripsi, Tgl Duplikat</b>');
						$simpandata = [
							'id_pos' => $id_pos, 'deskripsi' => $deskripsi, 'tgl_transaksi'=> $tgl_transaksi, 'jumlah'=>$jumlah
						];
			
						$db->table('pengeluaran_upload_log')->insert($simpandata);
				    
				} else {
				$sukses++;
				$simpandata = [
					'id_pos' => $id_pos, 'deskripsi' => $deskripsi, 'tgl_transaksi'=> $tgl_transaksi, 'jumlah'=>$jumlah
				];
	
				$db->table('pengeluaran')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal :'.$gagal.' record<br>'.$errors);
			
			return redirect()->to(base_url('Pengeluaran/uploadPengeluaran'));
			
		}

 
    public function Bulanan(){
        $bulan=$this->request->getVar('bulan');
        $tahun=$this->request->getVar('tahun');

        $pengeluaran = $this->PengeluaranModel->listPengeluaran($bulan,$tahun);
        $data_bulan = $this->KalenderModel->getBulan();
        $data_tahun = $this->KalenderModel->getTahun($tahun);

        $data = [
          'title' => 'Daftar Pengeluaran',
          'bulan' => $bulan,
          'tahun' => $tahun,
          'data_pengeluaran' => $pengeluaran,
          'data_bulan' => $data_bulan,
          'data_tahun' => $data_tahun  
        ];
        
         return view('ub/pengeluaranDetail',$data);

    }

public function createPengeluaran(){
    $validation = \Config\Services::validation();


	$data_pos = $this->PengeluaranModel->getDataPos();
	
    $data = [
        'title' => 'Tambah Data Pengeluaran',
        'validation' => \Config\Services::validation(),
        'id' => '',
		'id_pengeluaran' => '',
		'deskripsi' => '',
		'id_pos' => '',
        'tgl_transaksi' => '',
        'jumlah' => '',
		'deskrpsi' => '',
		'data_pos' => $data_pos
		
    ];


    return view('/ub/inputPengeluaran',$data);
    
}

public function delete($id)
{
    $this->PengeluaranModel->delete($id);
    session()->setFlashdata('pesan','Data Pengeluaran berhasil dihapus.');

    return redirect()->to('/ub/pengeluaran');

}

public function simpanPengeluaran(){
    $data_pos = $this->PengeluaranModel->getDataPos();
	if(!$this->validate([
        'id_pos' => 'required',
        'tgl_transaksi' => 'required',
        'jumlah' => 'required',
		'deskripsi' => 'required'
        
    ])) {    


        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Pengeluaran',
			'id' => $this->request->getVar('id'),
			'id_pos' => $this->request->getVar('id_pos'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
			'deskripsi' => $this->request->getVar('deskripsi'),
			'data_pos' => $data_pos,
            'validasi' => \Config\Services::validation()
    
        ];
        return view('/ub/inputPengeluaran',$data);
        
    }

    
    $this->PengeluaranModel->save([
        'id_pos' => $this->request->getVar('id_pos'),
        'jumlah' => $this->request->getVar('jumlah'),
		'deskripsi' => $this->request->getVar('deskripsi'),
		
        'tgl_transaksi' => $this->request->getVar('tgl_transaksi')
    ]);
    session()->setFlashdata('pesan','Data Pengeluaran berhasil ditambahkan.');

    return redirect()->to('/ub/pengeluaran');
        

}



public function edit($id)
{
    $data_pos = $this->PengeluaranModel->getDataPos();
	$data_kas = $this->KasModel->dataKas();

    $dataPengeluaran = $this->PengeluaranModel->getPengeluaran($id); 
    $validation = \Config\Services::validation();


    $data = [
        'title' => 'Edit Data Penjualan',
        'id' => $id,
        'penjualan' => $dataPengeluaran,
        'validation' => $validation,
		'data_pos' => $data_pos,
		'data_kas' => $data_kas
    ];  

    return view('/ub/ubahPengeluaran',$data);
     
}


public function saveEdit()
    {
        $id = $this->request->getVar('id');
        $this->PengeluaranModel->updatePengeluaran($id, [
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_transaksi' => $this->request->getVar('tgl_transaksi'),
			'deskripsi' => $this->request->getVar('deskripsi'),
			'id_pos' => $this->request->getVar('id_pos')
			
            ]);

            session()->setFlashdata('pesan','Data Pengeluaran berhasil diedit.');

            return redirect()->to('/ub/pengeluaran');
        
    }

public function hapus($id){

    $this->PengeluaranModel->hapusPengeluaran($id);

    session()->setFlashdata('pesan','Data Pengeluaran berhasil dihapus.');

    return redirect()->to('/ub/pengeluaran');

}

    }
