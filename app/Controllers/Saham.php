<?php
namespace App\Controllers;
use App\Models\Saham_Model;
use App\Models\tipeSaham_Model;
use App\Config\Services;

class Saham extends BaseController{
    
    protected $SahamModel;
protected $tipeSahamModel;
    protected $request;
    public $validation;
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->SahamModel = new Saham_Model();
		$this->tipeSahamModel = new tipeSaham_Model();
		
    }
    
    public function index(){
        $saham = $this->SahamModel->daftarSaham();
        
        $data = [
          'title' => 'Daftar Pemegang Saham',
          'data_saham' => $saham  
        ];
        return view('ub/sahamdetail',$data);

    }



   public function upload(){
        $saham = $this->SahamModel->dataSaham();
        
        $data = [
          'title' => 'Upload Saham Per Jiwa',
          'data_saham' => $saham  
        ];
        //dd($komik);
        return view('ub/uploadSaham',$data);

    }
	


   public function listCetakSaham(){
        $saham = $this->SahamModel->dataSaham();
        
        $data = [
          'title' => 'Cetak Saham',
          'data_saham' => $saham  
        ];
        //dd($komik);
        return view('ub/listCetakSaham',$data);

    }

	
	
		public function simpanExcelSaham()
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
				$no_kk = $row[1];
				$nama = $row[2];
				$alamat = $row[3];
				$hp = (!empty($row[4])) ? $row[4] : '-';
				$tgl_join = $row[5];
				$jml_saham = $row[6];
				$id_tipe = $row[7];

				
	
				
				$db = \Config\Database::connect();

				$cekID = $db->table('saham_anggota')->getWhere(['no_kk'=>$no_kk,'nama'=>$nama,'tgl_join'=>$tgl_join])->getResult();
				$errors[]='';
				if(count($cekID) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import ID KK ada yang sama</b>');
					$errors[] = [$nama,$alamat,$hp,$tgl_join,$jml_saham,$harga_saham];
				} else {
				$sukses++;
				$simpandata = [
					'id' => $id,'no_kk' => $no_kk, 'nama' => $nama, 'alamat'=> $alamat, 'hp'=>$hp, 'tgl_join'=>$tgl_join, 'jml_saham'=>$jml_saham, 'id_tipe'=>$id_tipe
				];
	
				$db->table('saham_anggota')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal ->'.$gagal.' record'.print_r($errors));
			
			return redirect()->to('/ub/uploadSaham');
		}
	// Sahamkk::upload
//post -> Sahamkk::simpanExcelSahamKK


 


public function detail($id){
    $komik = $this->SahamModel->getSahamId($id);
    //dd($komik);
    $data = [
        'title' => 'Detail Komik',
        'data_saham' => $this->SahamModel->getSahamId($id)
    ];
    if(empty($data['komik']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan'.$slug);

    }
    return view('ub/detail',$data);
    //echo $slug;
}

public function create(){
    $validation = \Config\Services::validation();
    $tipeSaham = $this->tipeSahamModel->tipeSaham();

    $errors = $validation->listErrors();
    $sahamkk = $this->SahamModel->listKK();

    $data = [
        'title' => 'Tambah Data',
        'validation' => \Config\Services::validation(),
        'nama' => '',
        'namakk' => '',
        'hp' => '',
        'alamat' => '',
        'jumlah' => '',
        'id_tipe' => '',
        'sahamkk' => $sahamkk,
		'data_tipe' => $tipeSaham	
    ];

    return view('/ub/inputSaham',$data);
    
}

public function delete($id)
{
    $this->SahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub');

}

public function simpanSaham(){
    $validation = \Config\Services::validation();
    helper(['form', 'url']);

    if(!$this->validate([
        'namakk' => 'required',
        'nama' => 'required',
        'jumlah' => 'required'
    ])) {    

    $sahamkk = $this->SahamModel->listKK();
    
    $errors = $validation->listErrors();
    
    $data = ['nama' => $this->request->getVar('nama'),
        'alamat' => $this->request->getVar('alamat'),
        'namakk' => $this->request->getVar('namakk'),
        'id_tipe' => $this->request->getVar('id_tipe'),
        'jumlah' => $this->request->getVar('jumlah'),
        'hp' => $this->request->getVar('hp'),
        'tgl_beli' => $this->request->getVar('tgl_beli'),
        'validation' => $this->validator,
        'sahamkk' => $sahamkk ];
    
        //dd($data);
        return view('/ub/inputSaham',$data);

    //return redirect()->to('/ub/create')->withInput()->with('errors',$errors);
        
    }

    
    $this->SahamModel->save([
        'nama' => $this->request->getPost('nama'),
        'no_kk' => $this->request->getPost('namakk'),
        'hp' => $this->request->getPost('hp'),
        'alamat' => $this->request->getPost('alamat'),
        'jml_saham' => $this->request->getPost('jumlah'),
        'id_tipe' => $this->request->getPost('id_tipe'),
        'tgl_join' => $this->request->getPost('tgl_beli')
        
    ]);
    session()->setFlashdata('pesan','Data berhasil ditambahkan.');

    return redirect()->to('/ub/member');
        

}


public function edit($id)
{
    $datalama = $this->SahamModel->getSahamId($id);
    $tipeSaham = $this->tipeSahamModel->tipeSaham();
	$validation = \Config\Services::validation();

    $data = [
	'title' => 'Edit Saham',
	'data_lama' => $datalama,
	'data_tipe' => $tipeSaham ];
    //dd($data);
	return view('/ub/ubahSaham',$data);

}


public function saveEdit()
    {
        $id = $this->request->getPost('id');
        $this->SahamModel->updateSahamId($id, [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp'),
            'jml_saham' => $this->request->getPost('jumlah'),
            'id_tipe' => $this->request->getPost('id_tipe'),
            'tgl_join' => $this->request->getPost('tgl_beli')
            
            ]);

            session()->setFlashdata('pesan',$this->request->getPost('id').$this->request->getPost('id_tipe').'Data berhasil diedit.');

            return redirect()->to('/ub/member');
        
    }

public function hapusSaham($id){
    $this->SahamModel->hapusSaham($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/member');

}    


    }
