<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
namespace App\Controllers;
use App\Models\Kelompok_Model;
use App\Models\Saham_Model;
use App\Models\SahamKK_Model;
use App\Models\Invoice_Model;
use App\Models\Pengeluaran_Model;
 
class Chart extends BaseController {
    
 protected $db = 'ci4';
 protected $table = 'usersx';
 
 
     public function __construct(){

        $this->KelompokModel = new Kelompok_Model();
		$this->InvoiceModel = new Invoice_Model();
		$this->SahamModel = new Saham_Model();
		$this->SahamKKModel = new SahamKK_Model();
		$this->PengeluaranModel = new Pengeluaran_Model();

    }

   public function pie_chart_js() {
   
        $data = $this->KelompokModel->getDataChart1();

        return view('charts/pieChart',$data);
    }
	
   public function pie_highchart() {
   
        $chart_data = $this->KelompokModel->getDataChart();
		$data = [
		'title' => 'Chart Kepemilikan Saham Kelompok',
		'deskripsi' => 'Kepemilikan berdasarkan Kelompok',
		'chart_data' => $chart_data ];
		
		return view('charts/pieHighchart',$data);
    }

   public function pie_KategoriSaham() {
   
        $chart_data = $this->SahamModel->getDataKategoriSaham();
		
		$data = [
		'title' => 'Chart Kepemilikan Saham',
		'deskripsi' => 'Kepemilikan berdasarkan Kategori Jumlah',
		'chart_data' => $chart_data ];
		return view('charts/pieHighchart',$data);
    }

	
   public function bar_Saham() {
   
        $data = $this->SahamModel->getDataChartBar();
		return view('charts/barHighchart',$data);
    }
	
   public function Donut_Saham() {
   
        $data = $this->SahamModel->getDataChart3dDonut();
		return view('charts/3dDonutHighchart',$data);
    }

   public function getDataChartLine($th = false){
		$data = $this->PengeluaranModel->getDataChartLine($th);
		return view('charts/lineChart',$data);
	}


   public function getDataChartLinePengeluaran($th = false){
		$data = $this->PengeluaranModel->getDataChartLine($th);
		return view('charts/lineChart',$data);
	}


   public function pie_SahamJiwa() {
   
        $data = $this->SahamModel->getDataChart();
		return view('charts/3dDonutHighchart',$data);
    }
	
	public function apiData($bulan){
		echo json_encode($this->InvoiceModel->getDataInvoice($bulan,$tahun));
	}
}
?>