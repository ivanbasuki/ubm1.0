<?php 
namespace App\Controllers;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\ContactModel;
use App\Models\PosDebet_Model;

class Upload extends BaseController
{
	public function __construct(){
		$this->POSDModel = new PosDebet_Model();
	}
	public function index(){
		$data['data_posd'] = $this->POSDModel->findAll();
		echo view('Upload',$data);
	}
	public function prosesExcel()
	{
		$file = $this->request->getFile('fileexcel');
		if($file){
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$fileLocation = $file->getTempName();
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			//ambil sheet active
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			//looping untuk mengambil data
			foreach ($sheet as $idx => $data) {
				//skip index 1 karena title excel
				if($idx==1){
					continue;
				}
				$nama_pos = $data['A'];
				// insert data
				$this->POSDModel->insert([
					'nama_pos'=>$nama_pos
				]);
			}
		}
		session()->setFlashdata('message','Berhasil import excel');
		return redirect()->to('/Upload');
	}
	
}