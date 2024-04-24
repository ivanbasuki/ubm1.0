<?php
namespace App\Controllers;
use App\Models\SahamKK_Model;
use App\Models\Kelompok_Model;
use App\Config\Services;

class Sahamkk extends BaseController{
    
    protected $SahamkkModel;
    protected $KelompokModel;
    protected $request;
    public $validation;
    protected $db = 'ci4';

    public function __construct(){
        //$request = App\Config\Service::request();

        $this->SahamkkModel = new SahamKK_Model();
        $this->KelompokModel = new Kelompok_Model();
        
    }
    
    public function index(){
        $saham = $this->SahamkkModel->getAllKK();
        
        $data = [
          'title' => 'Daftar Pemegang Saham Per KK',
          'data_sahamkk' => $saham  
        ];
		return view('ub/sahamkkdetail',$data);
    }


    public function daftarSahamKelompok($idkel=''){
        $saham = $this->SahamkkModel->kkKelompok($idkel);
        $data = [
          'title' => 'Daftar Pemegang Saham Per KK Kelompok',
          'data_sahamkk' => $saham  
        ];
		return view('ub/sahamkkdetail',$data);
    }

   public function upload(){
        $sahamkk = $this->SahamkkModel->dataSahamKK();
        $data = [
          'title' => 'Upload Saham KK',
          'data_sahamkk' => $sahamkk  
        ];
        //dd($komik);
        return view('ub/uploadSahamKK',$data);

    }
	
	
	
		public function simpanExcelSahamKK()
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
				$id_kk = $row[1];
				$nama_kk = $row[2];
				$id_klp = $row[3];
	
				
				$db = \Config\Database::connect();

				$cekID = $db->table('saham_kk')->getWhere(['id_kk'=>$id_kk])->getResult();

				if(count($cekID) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import ID KK ada yang sama</b>');
				} else {
				$sukses++;
				$simpandata = [
					'id' => $id,'id_kk' => $id_kk, 'nama_kk' => $nama_kk, 'id_klp'=> $id_klp
				];
	
				$db->table('saham_kk')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal ->'.$gagal.' record');
			
			return redirect()->to('/ub/uploadSahamKK');
		}
	// Sahamkk::upload
//post -> Sahamkk::simpanExcelSahamKK



public function detail($nokk){
    $detail = $this->SahamkkModel->getAllKK($nokk);
    //dd($komik);
    $data = [
        'title' => 'Member Saham KK',
        'data_sahamkk' => $detail
    ];
    if(empty($data['data_sahamkk']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');

    }
    return view('ub/kkdetail',$data);
    //echo $slug;
}

public function createkk(){
    $validation = \Config\Services::validation();
    $errors = $validation->listErrors();
    $kelompok = $this->KelompokModel->getKelompok();
    //dd($kelompok);
    $data = [
        'title' => 'Tambah Data KK',
        'validation' => \Config\Services::validation(),
        'no_kk' => '',
        'nama_kk' => '',
        'id_klp' => '',
        'kelompok' => $kelompok       
    ];


    return view('/ub/inputSahamKK',$data);
    
}

public function delete($id)
{
    $this->SahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub');

}

public function simpanSahamKK(){
    if(!$this->validate([
        'nokk' => 'required|is_unique[saham_kk.id_kk]',
        'namakk' => 'required'
    ])) {    

        $kelompok = $this->KelompokModel->getKelompok();

        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Tambah Data Saham KK',
            'no_kk' => $this->request->getVar('nokk'),
            'nama_kk' => $this->request->getVar('namakk'),
            'id_klp' => $this->request->getVar('idklp'),
             'kelompok' => $kelompok,   
            'validasi' => \Config\Services::validation(),

        ];
        return view('/ub/inputSahamKK',$data);
        
    }

    
    $this->SahamkkModel->save([
        'id_kk' => $this->request->getVar('nokk'),
        'nama_kk' => $this->request->getVar('namakk'),
        'id_klp' => $this->request->getVar('idklp')
        
    ]);
    session()->setFlashdata('pesan','Data KK berhasil ditambahkan.');

    return redirect()->to('/ub/kk');
        

}


public function edit($id)
{
    $datakk = $this->SahamkkModel->getSahamkkId($id); 
    $data = [
        'title' => 'Edit Data',
        'sahamkk' => $datakk
    ];   
    return view('/ub/ubahSahamKK',$data);

}


public function saveEdit()
    {
        $id = $this->request->getPost('id');
        $this->SahamkkModel->updateSahamKK($id, [
            'nama_kk' => $this->request->getPost('namakk'),
            'id_kk' => $this->request->getPost('idkk')
            
            ]);

            session()->setFlashdata('pesan','Data KK berhasil diedit.');

            return redirect()->to('/ub/kk');
        
    }

public function hapusKK($id){

    $this->SahamkkModel->hapusKK($id);

    session()->setFlashdata('pesan','Data KK berhasil dihapus.');

    return redirect()->to('/ub/kk');

}

    }
