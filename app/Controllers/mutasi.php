<?php
namespace App\Controllers;
use App\Models\Saham_Model;
use App\Models\Resign_Model;
use App\Models\Mutasi_Model;
use App\Config\Services;

class Mutasi extends BaseController{
    
    protected $SahamModel;
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->SahamModel = new Saham_Model();
		$this->MutasiModel = new Mutasi_Model();
		$this->ResignModel = new Resign_Model();
		
    }
    
    public function index(){
        $saham = $this->SahamModel->memberSaham();
        
        $data = [
          'title' => 'Daftar Pemegang Saham',
          'data_saham' => $saham  
        ];
        return view('ub/mutasiDetail',$data);

    }
	
	
	public function listHistory(){
			$data_history = $this->MutasiModel->listMutasi();
			$data = [
			'title' => 'History Mutasi',
			'data_history' => $data_history ];
			return view('ub/historyMutasi',$data);
	}	
	

	public function listResign(){
			$data_history = $this->ResignModel->listResign();
			$data = [
			'title' => 'History Resign',
			'data_history' => $data_history ];
			return view('ub/historyResign',$data);
	}	
	

public function formMutasi($id){
    $saham = $this->SahamModel->dataSahamId($id);
    $sahamkk = $this->SahamModel->listKK();

    $data = [
        'title' => 'Mutasi Saham',
		'id' => $id,
		'tgl_mutasi' => '',
		'alasan' => '',
        'data_saham' => $saham,
        'sahamkk' => $sahamkk       

    ];
    if(empty($data['data_saham']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan '.$id);

    }
	

    return view('ub/formMutasi',$data);
}

public function formResign($id){
    $saham = $this->SahamModel->dataSahamId($id);
    $sahamkk = $this->SahamModel->listKK();

    $data = [
        'title' => 'Detail Saham Resign',
        'id' => $id,
		'tgl_resign' => '',
		'alasan' => '',
        'data_saham' => $saham,
        'sahamkk' => $sahamkk       

    ];
    if(empty($data['data_saham']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Saham tidak ditemukan'.$id);

    }
    return view('ub/formResign',$data);
}



public function delete($id)
{
    $this->SahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub');

}

public function simpanMutasi(){
    $validation = \Config\Services::validation();

    if(!$this->validate([
        'namakk2' => 'required',
        'nama' => 'required',
		'alamat' => 'required',
        'hp' => 'required',
		'tgl_mutasi' => 'required',
		'alasan' => 'required'
    ])) {    

    $sahamkk = $this->SahamModel->listKK();
    $saham = $this->SahamModel->dataSahamId($this->request->getVar('id'));
    
    $data = [
	    'title' => 'Mutasi Saham',
		'id' => $this->request->getVar('id'),
	    'nama' => $this->request->getVar('nama'),
        'alamat' => $this->request->getVar('alamat'),
        'namakk1' => $this->request->getVar('namakk1'),
		'namakk2' => $this->request->getVar('namakk2'),
		'id_tipe' => $this->request->getVar('id_tipe'),
        'jumlah' => $this->request->getVar('jumlah'),
        'hp' => $this->request->getVar('hp'),
        'tgl_beli' => $this->request->getVar('tgl_beli'),
        'tgl_mutasi' => $this->request->getVar('tgl_mutasi'),
        'alasan' => $this->request->getVar('alasan'),
		'validation' => $validation,
        'sahamkk' => $sahamkk,
'data_saham' => $saham		];
    
        //dd($data);
        return view('/ub/formMutasi',$data);

    //return redirect()->to('/ub/create')->withInput()->with('errors',$errors);
        
    }

    
        $id = $this->request->getPost('id');
        
		$this->SahamModel->updateSahamId($id, [
			'nama' => $this->request->getPost('nama'),
			'no_kk' => $this->request->getPost('namakk2'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp')
        ]);
		
        $this->MutasiModel->insertMutasi([
			'id_saham_lama' => $id,
			'nama' => $this->request->getPost('nama'),
			'no_kk_lama' => $this->request->getPost('namakk1'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp'),
			'tgl_join' => $this->request->getPost('tgl_beli'),
			'jml_saham' => $this->request->getPost('jumlah'),
			'id_tipe' => $this->request->getPost('id_tipe'),
			'tgl_mutasi' => $this->request->getPost('tgl_mutasi'),
			'alasan' => $this->request->getPost('alasan')
        ]);
		



            session()->setFlashdata('pesan','Data berhasil diedit.');
	
	
	
    session()->setFlashdata('pesan','Data Mutasi Berhasil.');

    return redirect()->to('/ub/mutasi');

}


public function simpanResign(){
    $validation = \Config\Services::validation();

    if(!$this->validate([
        'namakk1' => 'required',
		'tgl_resign' => 'required',
		'alasan' => 'required'
    ])) {    

    $sahamkk = $this->SahamModel->listKK();
    $saham = $this->SahamModel->dataSahamId($this->request->getVar('id'));
    
    $data = [
	    'title' => 'Mutasi Saham',
		'id' => $this->request->getVar('id'),
	    'nama' => $this->request->getVar('nama'),
        'alamat' => $this->request->getVar('alamat'),
        'namakk1' => $this->request->getVar('namakk1'),
		'harga' => $this->request->getVar('harga'),
        'jumlah' => $this->request->getVar('jumlah'),
        'hp' => $this->request->getVar('hp'),
        'tgl_beli' => $this->request->getVar('tgl_beli'),
        'tgl_resign' => $this->request->getVar('tgl_mutasi'),
        'alasan' => $this->request->getVar('alasan'),
		'validation' => $validation,
        'sahamkk' => $sahamkk,
'data_saham' => $saham		];
    
        //dd($data);
        return view('/ub/formResign',$data);

    //return redirect()->to('/ub/create')->withInput()->with('errors',$errors);
        
    }

    
        $id = $this->request->getPost('id');
        
		
        $this->ResignModel->insertResign([
			'nama' => $this->request->getPost('nama'),
			'no_kk' => $this->request->getPost('namakk1'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp'),
			'tgl_join' => $this->request->getPost('tgl_beli'),
			'jml_saham' => $this->request->getPost('jumlah'),
			'harga_saham' => $this->request->getPost('harga'),
			'tgl_resign' => $this->request->getPost('tgl_resign'),
			'alasan' => $this->request->getPost('alasan')
        ]);
		
		$this->SahamModel->hapusSaham($id);

            session()->setFlashdata('pesan','Data Resign berhasil dihapus.');
	
	
    return redirect()->to('/ub/historyResign');

}



public function edit($id)
{
    $datalama = $this->SahamModel->getSahamId($id);
    $validation = \Config\Services::validation();

    $data = $datalama;
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
            'harga_saham' => $this->request->getPost('harga'),
            'tgl_join' => $this->request->getPost('tgl_beli')
            
            ]);

            session()->setFlashdata('pesan','Data berhasil diedit.');

            return redirect()->to('/ub/mutasi');
        
    }

public function insert($data){
    $data = [
        'title' => 'Detail Komik',
        'komik' => $this->komikModel->getKomik($slug)
    ];

    return $komik = $this->komikModel->insertKomik($data);
    //dd($komik);
    
}
public function hapusSaham($id){
    $this->SahamModel->hapusSaham($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/mutasi');

}    


    }
