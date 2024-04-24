<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Mutasi_Model;
use App\Models\Saham_Model;
use App\Models\Config_Model;
use App\Models\Kelompok_Model;
use App\Models\PembayaranKredit_Model;
use Dompdf\Options; 
use Dompdf\FontMetrics;
use TCPDF;
use Fpdf\Fpdf;
//use Fpdf\PDF; 


class PdfController extends Controller
{

    public function __construct(){

 		$this->MutasiModel = new Mutasi_Model();
		$this->SahamModel = new Saham_Model();
		$this->ConfigModel = new Config_Model();
		$this->KelompokModel = new Kelompok_Model();
		
		$this->options = new Options(); 
		$this->options->set('isPhpEnabled', 'true'); 
		$this->options->set('isHtml5ParserEnabled', 'true'); 
				
		$this->dompdf = new \Dompdf\Dompdf($this->options);
		$this->dompdf->set_option('isRemoteEnabled', TRUE);
		
		$this->PembayaranKreditModel = new PembayaranKredit_Model();
		
		
    }
 

    public function index() 
	{
        return view('ub/historyMutasi');
    }

    function htmlToPDF($data = false){
        //$this->dompdf = new \Dompdf\Dompdf();

if (file_exists('document.pdf')) unlink('document.pdf');

		$data_history = $this->MutasiModel->listMutasi();
		$data=[
			'title' => 'History Mutasi',
			'data_history' => $data_history ];
        
		$this->dompdf->loadHtml(view('ub/historyMutasiPDF',$data));
		$this->dompdf->set_option('isHtml5ParserEnabled', true);

        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream('document.pdf', array("Attachment" => false));
    }

public function cetakLaporanSaham()
{
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm','Letter');
        
		$pdf->SetFillColor(200,200,100);
		
		$kelompok=$this->KelompokModel->tableKelompok();
		foreach($kelompok as $kel):
		
		$pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
		$pdf->SetLeftMargin(10);
        $pdf->Cell(0,7,'DAFTAR PEMEGANG SAHAM ',0,1,'C');
		$pdf->Cell(0,7,$kel['nama_klp'],0,1,'C');
        //$pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Courier','B',10);
        $pdf->Cell(15,5,'No',1,0,'C');
        $pdf->Cell(60,5,'Nama',1,0,'C');
        $pdf->Cell(40,5,'HP',1,0,'C');
        $pdf->Cell(10,5,'Tipe',1,0,'C');
        $pdf->Cell(25,5,'Harga',1,0,'C');
		$pdf->Cell(15,5,'Jumlah',1,0,'C');
		$pdf->Cell(25,5,'Total',1,1,'C');
		
		//$pdf->Cell(10,5,'',0,0,'L');
        
		//$pdf->Cell(15,5,'No',1,0,'C');
        //$pdf->Cell(60,5,'Nama',1,0,'C');
        //$pdf->Cell(40,6,'No KK',1,0,'C');
        //$pdf->Cell(65,6,'Nama KK',1,0,'C');
		//$pdf->Cell(30,5,'Jumlah',1,1,'C');
		
        $pdf->SetFont('Arial','',10);
        $saham = $this->SahamModel->dataSahamKelompok($kel['id']);
		$no=0;
        $total=0;
		$xnamakk='';
		$totalkk=0;
		$sisa=0;
		$totalnominal=0;
		$totalnominal=0;
		$jiwa=1;
		$kk=0;
		foreach ($saham as $data){
            $total += $data['jml_saham'];
			$no++;
            
			if($no == 1)
			{ 
				$xnamakk = $data['nama_kk']; 
				//$pdf->Cell(210,6,$xnamakk,1,1);
		
			}
				
			if($xnamakk != $data['nama_kk'])
			{
				$kk++;
				if($kk==1){
					$jiwa -= 1;
				}	
				$pdf->SetFillColor(200);
				$pdf->Cell(150,5,'Total KK '.$xnamakk.' ( '.$jiwa.' )',1,0,'C');
				$pdf->Cell(15,5,$totalkk,1,0);
				$pdf->Cell(25,5,number_format($totalnominalkk),1,1);
				
				$totalkk=0;
				$totalnominalkk=0;
				$jiwa=1;
				$pdf->SetFillColor(0);
				
				$pdf->Cell(15,5,$no,1,0, 'C');
				$pdf->Cell(60,5,$data['nama'],1,0);
				$pdf->Cell(40,5,$data['hp'],1,0);
				$pdf->Cell(10,5,$data['kode_saham'],1,0);
				$pdf->Cell(25,5,number_format($data['harga_saham']),1,0);
				
				$pdf->Cell(15,5,$data['jml_saham'],1,0);
				$pdf->Cell(25,5,number_format($data['total']),1,1);
				
				$xnamakk = $data['nama_kk'];
				$totalkk = $data['jml_saham'];
				$totalnominalkk = $data['total'];
				$totalnominal += $data['total'];
				
				
			} else
			{
				
				$pdf->Cell(15,5,$no,1,0, 'C');
				$pdf->Cell(60,5,$data['nama'],1,0);

				$pdf->Cell(40,5,$data['hp'],1,0);
				$pdf->Cell(10,5,$data['kode_saham'],1,0);
				$pdf->Cell(25,5,number_format($data['harga_saham']),1,0);
				
				$pdf->Cell(15,5,$data['jml_saham'],1,0);
				$pdf->Cell(25,5,number_format($data['total']),1,1);
				$totalkk += $data['jml_saham'];
				$totalnominalkk += $data['total'];
				$totalnominal += $data['total'];
				$jiwa++;
				
				
			}		
		}
		
				$pdf->Cell(150,5,'Total KK '.$xnamakk.' ( '.$jiwa.' )',1,0,'C');
				$pdf->Cell(15,5,$totalkk,1,0);
				$pdf->Cell(25,5,number_format($totalnominalkk),1,1);
		
		$pdf->SetFillColor(200,200,100);
				
		$pdf->Cell(150,5,'Total Kelompok '.$kel['nama_klp'].'( '.$kk.'  KK ) ',1,0);
		$pdf->Cell(15,5,number_format($total),1,0);
		$pdf->Cell(25,5,number_format($totalnominal),1,1);
		
		
		endforeach;
		
		
        $pdf->Output('I');
	$pdf->close();
		
	}
	


    public function cetakSaham() 
	{
            $fontMetrics = new FontMetrics($canvas, $this->options); 
			 
			// Get height and width of page 
			$w = $canvas->get_width(); 
			$h = $canvas->get_height(); 
			 
			// Get font family file 
			$font = $fontMetrics->getFont('times'); 
			$fontMetrics = new FontMetrics($canvas, $this->options); 
			 
			// Get height and width of page 
			$w = $canvas->get_width(); 
			$h = $canvas->get_height(); 
			 
			// Get font family file 
			$font = $fontMetrics->getFont('times'); 
			$fontMetrics = new FontMetrics($canvas, $this->options); 
			 
			// Get height and width of page 
			$w = $canvas->get_width(); 
			$h = $canvas->get_height(); 
			 
			// Get font family file 
			$font = $fontMetrics->getFont('times'); 
			return view('ub/listCetakSaham');
    }

    function htmlToPDFCetakSaham($data = false){
        //$this->dompdf = new \Dompdf\Dompdf();

if (file_exists('document.pdf')) unlink('document.pdf');

		$data_saham = $this->SahamModel->dataSaham();
		$data=[
			'title' => 'Daftar Pemegang Saham',
			'data_saham' => $data_saham ];
        
		$this->dompdf->loadHtml(view('ub/listCetakSahamPDF',$data));
		$this->dompdf->set_option('isHtml5ParserEnabled', true);

        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('document.pdf', array("Attachment" => false));
    }

    function htmlToPDFCetakSaham1($id = false){
        //$this->dompdf = new \Dompdf\Dompdf();
		
		if (file_exists('document.pdf')) unlink('document.pdf');

		$data_saham = $this->SahamModel->dataSaham($id);
		$data=[
			'title' => 'Daftar Pemegang Saham',
			'data_saham' => $data_saham ];
		$this->dompdf->set_option('isHtml5ParserEnabled', true);
        
		$this->dompdf->loadHtml(view('ub/CetakSahamPDF',$data));
        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream('document.pdf', array("Attachment" => false));
    }
	
	
    function htmlToPDFCetakSahamID($id = false){


		if (file_exists('document.pdf')) unlink('document.pdf');

			$data_saham = $this->SahamModel->dataSaham($id);
			$data_config = $this->ConfigModel->getConfigAll();
			
			$data=[
			'title' => 'Daftar Pemegang Saham',
			'data_saham' => $data_saham,
			'data_config' => $data_config ];
			
			$total=0;
			if(!empty($data_saham)):
				$total = $data_saham['jml_saham'] * $data_saham['harga_saham'];
			endif;
				
			$data['terbilang_total'] = $this->terbilang($total);
			$data['terbilang_nominal'] = $this->terbilang($data_saham['harga_saham']);
			
			
			$this->dompdf->set_option('isHtml5ParserEnabled', true);
			
			$options = $this->dompdf->getOptions();
			$logoWidth = 60; 
			$logoHeight = 50; 

			$this->dompdf->setPaper($data_config['SAHAM_PAPER'], $data_config['SAHAM_ORIENTATION']); 
			$this->dompdf->set_option('isRemoteEnabled', TRUE);
			

				
			switch($data_config['SAHAM_ORIENTATION'])
			{
					case 'portrait':
									$view_page = 'ub/cetakSahamPDF';
									$max_x=$this->dompdf->getCanvas()->get_width();
									$max_y=$this->dompdf->getCanvas()->get_height();
									$pos_logo_x = ($max_x-$logoWidth)/2;
									$pos_logo_y =  75;
									$pos_wm_x = 397;
									$pos_wm_y = 525;
									
			
									break;
					case 'landscape':
									$view_page = 'ub/cetakSahamPDFLandscape';
									$max_x=800;
									$max_y=600;
									$pos_logo_x = ($max_x-$logoWidth)/2;
									$pos_logo_y =  75;	
									$pos_wm_x = 570;
									$pos_wm_y = 345;

			
									break;
					default:
									$view_page = 'ub/cetakSahamPDF';
									$max_x=$this->dompdf->getCanvas()->get_width();
									$max_y=$this->dompdf->getCanvas()->get_height();
									$pos_logo_x = ($max_x-$logoWidth)/2;
									$pos_logo_y =  75;
									$pos_wm_x = 397;
									$pos_wm_y = 525;
	

									break;
					
			}	
 
			
			
			
			$this->dompdf->loadHtml(view($view_page,$data));
			$this->dompdf->render(); 
			
			$canvas = $this->dompdf->getCanvas(); 
        	
			
			 
			 
			$w = $canvas->get_width(); 
			$h = $canvas->get_height(); 
			 
			// Specify watermark image 
			$imageLOGO = 'img/'.$data_config['SAHAM_LOGO'];
			 
			// Set image opacity 
			$canvas->set_opacity($data_config['SAHAM_OPACITY']); 
			 
			// Add an image to the pdf 
			$canvas->image($imageLOGO, $pos_logo_x, $pos_logo_y, $logoWidth, $logoHeight); 
			$canvas->image('img/'.$data_config['SAHAM_BACKGROUND'],0,0,$max_x,$max_y);
			$canvas->image('img/'.$data_config['SAHAM_WATERMARK'],$pos_wm_x,$pos_wm_y,150,150);
			
			
			
			
			// Output the generated PDF (1 = download and 0 = preview) 
			$this->dompdf->stream('document.pdf', array("Attachment" => false));
    }


function htmlToPDFKuitansi($id = false){
		
			ob_end_clean();
			$data_bayar = $this->PembayaranKreditModel->detailBayarKredit($id);
			$data_config = $this->ConfigModel->getConfigAll();
			$data_totalBayar = $this->PembayaranKreditModel->terbayar($data_bayar['id_kredit']);
			$terhutang = $data_bayar['harga_jual']-$data_bayar['dp']-$data_totalBayar['terbayar'];
			
			
			$data=[
			'title' => 'Kuitansi Pembayaran Kredit',
			'data_kredit' => $data_bayar,
			'data_config' => $data_config,
			'terbilang' => $this->terbilang($data_bayar['jumlah']),
			'terhutang' => $terhutang 	];
			
		$html=view('ub/kuitansi',$data);
		$output='invoice'.$id.'.pdf';
		if (file_exists($output)) unlink($output);
		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($data_config['NAMA_UB']);
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting

		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		
		$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/'.$output, 'I');			

}

		function penyebut($nilai) {
			$nilai = abs($nilai);
			$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
			$temp = "";
			if ($nilai < 12) {
				$temp = " ". $huruf[$nilai];
			} else if ($nilai <20) {
				$temp = $this->penyebut($nilai - 10). " belas";
			} else if ($nilai < 100) {
				$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
			} else if ($nilai < 200) {
				$temp = " seratus" . $this->penyebut($nilai - 100);
			} else if ($nilai < 1000) {
				$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
			} else if ($nilai < 2000) {
				$temp = " seribu" . $this->penyebut($nilai - 1000);
			} else if ($nilai < 1000000) {
				$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
			} else if ($nilai < 1000000000) {
				$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
			} else if ($nilai < 1000000000000) {
				$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
			} else if ($nilai < 1000000000000000) {
				$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
			}     
			return $temp;
		}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}
 


}