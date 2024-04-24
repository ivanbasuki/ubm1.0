<?php
namespace App\Controllers;
use App\Models\KomikModel;
use App\Config\Services;

class Komik extends BaseController{
    


    protected $komikModel;
    protected $request;
    public $validation;
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->komikModel = new KomikModel();
    }
    
    public function index(){
        $komik = $this->komikModel->getKomik();
        
        $data = [
          'title' => 'Daftar Komik',
          'komik' => $komik  
        ];
        //dd($komik);
        return view('komik/index',$data);

    }

public function detail($slug){
    $komik = $this->komikModel->getKomik($slug);
    //dd($komik);
    $data = [
        'title' => 'Detail Komik',
        'komik' => $this->komikModel->getKomik($slug)
    ];
    if(empty($data['komik']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan'.$slug);

    }
    return view('komik/detail',$data);
    //echo $slug;
}

public function create(){
    $validation = \Config\Services::validation();
    $errors = $validation->listErrors();
    $data = [
        'title' => 'Tambah Data',
        'validation' => \Config\Services::validation(),
        'errors' => $errors       
    ];

   // $this->session->set([
   //     'title' => 'Tambah Data',
   //     'validation' => \Config\Services::validation(),
   //     ]);

    //dd($this->session->get('validation'));

    return view('/komik/create',$data);
    
}

public function delete($id)
{
    $this->komikModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/komik');

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
    
    //dd($validation->listErrors());
    return redirect()->to('/komik/create')->withInput()->with('errors',$errors);
        
    }

    
    $this->komikModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul')
        
    ]);
    session()->setFlashdata('pesan','Data berhasil ditambahkan.');

    return redirect()->to('/komik');
        

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
