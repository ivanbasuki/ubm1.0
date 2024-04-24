<?php
namespace App\Controllers;
use App\Models\Kelompok_Model;
use App\Config\Services;

class Kelompok extends BaseController{
    
    protected $KelompokModel;
    protected $request;
    public $validation;
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->KelompokModel = new Kelompok_Model();
    }
    
    public function index(){
        $kelompok = $this->KelompokModel->getKelompok();
        
        $data = [
          'title' => 'Daftar Kelompok',
          'data_kelompok' => $kelompok  
        ];
        //dd($komik);
        return view('ub/kelompokdetail',$data);

    }
	
	
    public function upload(){
        $kelompok = $this->KelompokModel->tableKelompok();
        
        $data = [
          'title' => 'Upload Data Kelompok',
          'kelompok' => $kelompok  
        ];
        //dd($komik);
        return view('ub/uploadKelompok',$data);

    }
	
	
	
		public function simpanExcel()
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
				
				$id=$row[0];
				$kode_klp = $row[1];
				$nama_klp = $row[2];
				$prefix_kk = $row[3];
	
				
				$db = \Config\Database::connect();

				$cekNis = $db->table('kelompok')->getWhere(['kode_klp'=>$kode_klp])->getResult();

				if(count($cekNis) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import Kode Kelompok ada yang sama</b>');
				} else {
				$sukses++;
				$simpandata = [
					'id'=>$id,'kode_klp' => $kode_klp, 'nama_klp' => $nama_klp, 'prefix_kk'=> $prefix_kk
				];
	
				$db->table('kelompok')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal ->'.$gagal.' record');
			
			return redirect()->to('/ub/uploadKelompok');
		}
	


    public function rekapKelompok($idkel=''){
        $kelompok = $this->KelompokModel->getKelompok();

        if(!empty($idkel)){
			$sahamKelompok = $this->KelompokModel->rekapKelompok($idkel);
        } else {
			$idKel = $this->request->getVar('idkel');
			$sahamKelompok = $this->KelompokModel->rekapKelompok($idkel);
		}	
        $data = [
          'title' => 'Daftar Pemegang Saham Per Kelompok',
          'saham_kelompok' => $sahamKelompok,
		  'data_kelompok' => $kelompok 	
        ];
        
        return view('ub/sahamkelompokdetail',$data);

    }



public function detail($kodeklp){
    $kelompok = $this->KelompokModel->getKelompokKode($kodeklp);
    //dd($komik);
    $data = [
        'title' => 'Detail Kelompok',
        'data_kelompok' => $this->KelompokModel->getKelompokKode($kodeklp)
    ];
    if(empty($data['kelompok']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan'.$slug);

    }
    return view('ub/detailkelompok',$data);
    //echo $slug;
}

public function create(){
    $validation = \Config\Services::validation();
    $errors = $validation->listErrors();
    $data = [
        'title' => 'Tambah Data Saham',
        'validation' => \Config\Services::validation(),
        'errors' => $errors       
    ];


    return view('/ub/createkelompok',$data);
    
}

public function delete($id)
{
    $this->SahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub');

}

public function save(){
    $slug=url_title($this->request->getVar('judul'),'-',true);
    if(!$this->validate([
        'judul' => 'required|is_unique[komik.judul]',
        'penerbit' => 'required',
        'penulis' => 'required'
    ])) {    
    
        $validation = \Config\Services::validation();
        $errors = $validation->listErrors();
    
    return redirect()->to('/ub/create')->withInput()->with('errors',$errors);
        
    }

    
    $this->SahamModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul')
        
    ]);
    session()->setFlashdata('pesan','Data berhasil ditambahkan.');
    return redirect()->to('/ub');
}


public function edit($id)
{
    $data = $this->komikModel->getKomikId($id);    
    return view('/komik/edit',$data);

}


public function saveEdit()
    {
        $id = $this->request->getPost('id');
        $this->komikModel->updateKomikId($id, [
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'sampul' => $this->request->getPost('sampul'),
            ]);

            session()->setFlashdata('pesan','Data berhasil diedit.');

            return redirect()->to('/komik');
    }

public function insert($data){
    $data = [
        'title' => 'Detail Komik',
        'komik' => $this->komikModel->getKomik($slug)
    ];

    return $komik = $this->komikModel->insertKomik($data);
    //dd($komik);
    
}


    }
