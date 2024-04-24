<?php
namespace App\Controllers;
use App\Models\PosKredit_Model;
use App\Models\PosDebet_Model;
use App\Config\Services;

class PosKas extends BaseController{
    
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->POSDModel = new PosDebet_Model();
		$this->POSKModel = new PosKredit_Model();
		
    }
    
    public function listPOSD(){
        $datapos = $this->POSDModel->dataPOSDId();
        
        $data = [
          'title' => 'Daftar POS Penerimaan',
          'data_pos' => $datapos  
        ];
        return view('ub/PosDebetDetail',$data);

    }
	
	    public function listPOSK(){
        $datapos = $this->POSKModel->listPOSK();
        
        $data = [
          'title' => 'Daftar POS Pengeluaran',
          'data_pos' => $datapos  
        ];
        return view('ub/PosKreditDetail',$data);

    }
	


    public function upload($pos=false){
        if($pos==false)
		{
			return false;
		} elseif($pos == 'DEBET'){
			$title = 'Upload Pos Penerimaan';
			$datapos = $this->POSDModel->dataPOSDId();
			$url='ub/uploadPos';
		} else {
			$title='Upload Pos Pengeluaran';
			$datapos = $this->POSKModel->listPOSK();
			$url='ub/uploadPos';

		}
        
		
        $data = [
          'pos' => $pos,
		  'title' => $title,
          'data_pos' => $datapos  
        ];
        return view($url,$data);

    }


		public function simpanExcelPOS($pos=false)
		{
			$pos = $this->request->getVar('pos');

			if($pos == false)
			{ return false; }
			if($pos == 'DEBET')
			{  
				$tableName = 'pos_penerimaan'; 
				$url = '/ub/uploadPos/DEBET';
			} else { 
				$tableName = 'pos_pengeluaran'; 
				$url = '/ub/uploadPos/KREDIT';
			}

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
				$nama_pos = $row[1];
	
				
				$db = \Config\Database::connect();

				$cekPos = $db->table($tableName)->getWhere(['nama_pos'=>$nama_pos])->getResult();

				if(count($cekPos) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import Nama Pos ada yang sama</b>');
				} else {
				$sukses++;
				$simpandata = [
					'id' => $id_pos,
					'nama_pos' => $nama_pos
				];
	
				$db->table($tableName)->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal ->'.$gagal.' record');
			
			return redirect()->to($url);
		}
	


	    public function listConfig(){
        $dataconfig = $this->ConfigModel->listConfig();
        
        $data = [
          'title' => 'Konfigurasi Sistem',
          'data_config' => $dataconfig  
        ];
        return view('ub/configDetail',$data);

    }
	
	
	

public function tambahPOSD(){

    $data = [
        'title' => 'Tambah POS Penerimaan',
		'id' => '',
		'nama_POSD' => ''
    ];
	
    return view('ub/inputPOSD',$data);
}

public function tambahPOSK(){

    $data = [
        'title' => 'Tambah POS Pengeluaran',
		'id' => '',
		'nama_POSK' => ''
    ];
	
    return view('ub/inputPOSK',$data);
}




public function simpanPOSD(){
    $validation = \Config\Services::validation();

    if(!$this->validate([
        'nama_POSD' => 'required'
    ])) {    

    
    $data = [
	'title' => 'Input POS Penerimaan',
	'nama_POSD' => $this->request->getVar('nama_POSD'),
        'validation' => $validation ];
    
        return view('ub/inputPOSD',$data);

    }

    
    $this->POSDModel->insertPOSD([
        'nama_pos' => $this->request->getPost('nama_POSD')
        
    ]);
    session()->setFlashdata('pesan','Data POS Pemasukan ditambahkan.');

    return redirect()->to('ub/posdebet');
        

}

public function simpanPOSK(){
    $validation = \Config\Services::validation();

    if(!$this->validate([
        'nama_POSK' => 'required'
    ])) {    

    
    $data = [
	'title' => 'Input POS Penerimaan',
	'nama_POSK' => $this->request->getVar('nama_POSK'),
        'validation' => $validation ];
    
        return view('ub/inputPOSK',$data);

    }

    
    $this->POSKModel->insertPOSK([
        'nama_pos' => $this->request->getPost('nama_POSK')
        
    ]);
    session()->setFlashdata('pesan','Data POS Pengeluaran ditambahkan.');

    return redirect()->to('ub/poskredit');
        

}





public function editPOSD($id){
    $posd = $this->POSDModel->dataPOSDId($id);

    $data = [
        'title' => 'Edit POS Penerimaan',
		'id' => $id,
		'data_posd' => $posd      

    ];
	if(empty($data['data_posd']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan '.$id);

    }
	
    return view('ub/editPOSD',$data);
}


public function editPOSK($id){
    $posk = $this->POSKModel->dataPOSKId($id);

    $data = [
        'title' => 'Edit POS Pengeluaran',
		'id' => $id,
		'data_posk' => $posk      

    ];
	
    if(empty($data['data_posk']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan '.$id);

    }
	
    return view('ub/editPOSK',$data);
}



public function deletePOSD($id)
{
    $this->POSDModel->delete($id);
    session()->setFlashdata('pesan','Data POS Debet berhasil dihapus.');

    return redirect()->to('/posDebet');

}

public function deletePOSK($id)
{
    $this->POSKModel->delete($id);
    session()->setFlashdata('pesan','Data POS Debet berhasil dihapus.');

    return redirect()->to('/posKredit');

}




public function edit($id)
{
    $datalama = $this->SahamModel->getSahamId($id);
    $validation = \Config\Services::validation();

    $data = $datalama;
    return view('/ub/ubahSaham',$data);

}


public function simpanEditPOSD()
    {
        $id = $this->request->getPost('id');
        $this->POSDModel->updatePOSD($id, [
            'nama_pos' => $this->request->getPost('nama_POSD')
            
            ]);

            session()->setFlashdata('pesan','Data berhasil diedit.');

            return redirect()->to('/ub/posdebet');
        
    }


public function simpanEditPOSK()
    {
        $id = $this->request->getPost('id');
        $this->POSKModel->updatePOSK($id, [
            'nama_pos' => $this->request->getPost('nama_POSK')
            
            ]);

            session()->setFlashdata('pesan','Data berhasil diedit.');

            return redirect()->to('/ub/poskredit');
        
    }
	
	


public function hapusPOSK($id){
    $this->POSKModel->hapusPOSK($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/poskredit');

}    
public function hapusPOSD($id){
    $this->POSDModel->hapusPOSD($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/posdebet');

}    



    }
