<?php
namespace App\Controllers;
use App\Models\tipeSaham_Model;
use App\Config\Services;

class tipeSaham extends BaseController{
    
    protected $tipeSahamModel;
    protected $request;
    public $validation;
    
    public function __construct(){
        //$request = App\Config\Service::request();

        $this->tipeSahamModel = new tipeSaham_Model();
    }
    
    public function upload(){
        $saham = $this->tipeSahamModel->tipeSaham();
        
        $data = [
          'title' => 'Tipe Saham',
          'data_tipe' => $saham  
        ];
        return view('ub/uploadTipeSaham',$data);

    }



	
		public function simpanExcelTipeSaham()
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
				$tipe = $row[1];
				$harga_saham = $row[2];
	
				
				$db = \Config\Database::connect();

				$cekID = $db->table('tipe_saham')->getWhere(['kode_saham'=>$tipe])->getResult();

				if(count($cekID) > 0) {
					$gagal++;
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import Tipe Saham ada yang sama</b>');
				} else {
				$sukses++;
				$simpandata = [
					'id' => $id, 'kode_saham' => $tipe, 'harga_saham' => $harga_saham
				];
	
				$db->table('tipe_saham')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			    }
		
			}
			session()->setFlashdata('message','Berhasil :'.$sukses.' record </br> gagal :'.$gagal.' record');
			
			return redirect()->to('/ub/uploadtipeSaham');
		}
	// Sahamkk::upload
//post -> Sahamkk::simpanExcelSahamKK


 

public function delete($id)
{
    $this->tipeSahamModel->delete($id);
    session()->setFlashdata('pesan','Data berhasil dihapus.');

    return redirect()->to('/ub/uploadtipeSaham');

}



    }
