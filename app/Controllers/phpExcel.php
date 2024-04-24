<?php namespace App\Controllers;
use App\Models\Mutasi_Model;
use App\Models\Saham_Model;
use App\Models\Sahamkk_Model;
use App\Models\tipeSaham_Model;
use App\Models\Kelompok_Model;
use App\Models\PosDebet_Model;
use App\Models\PosKredit_Model;
use App\Models\Produk_Model;
use App\Models\Pengeluaran_Model;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class phpExcel extends BaseController
{
	public function __construct(){
		$this->MutasiModel = new Mutasi_Model();
		$this->KelompokModel = new Kelompok_Model();
		$this->SahamModel = new Saham_Model();
		$this->SahamkkModel = new Sahamkk_Model();

		$this->SahamkkModel = new Sahamkk_Model();
		$this->tipeSahamModel = new tipeSaham_Model();
		$this->PosDebetModel = new PosDebet_Model();
		$this->PosKreditModel = new PosKredit_Model();
		$this->ProdukModel = new Produk_Model();
		$this->PengeluaranModel = new Pengeluaran_Model();


	}
	public function index(){
		$data  = [
		'title' => 'Daftar Mutasi Saham',
		'data_history' => $this->MutasiModel->listMutasi() ];
		return view('ub/historyMutasi',$data);
	}
	

	public function exportExcelProduk()
		{
			$produk = $this->ProdukModel->dataProdukKredit();
			
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'id')
				->setCellValue('B1', 'Nama Barang')
				->setCellValue('C1', 'Harga Jual')
				->setCellValue('D1', 'Harga Pokok')
				->setCellValue('E1', 'dp')
				->setCellValue('F1', 'angsuran')
				->setCellValue('G1', 'tenor');
				
	
			$column = 2;
	
			foreach ($produk as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['nama_barang'])
					->setCellValue('C' . $column, $a['harga_jual'])
					->setCellValue('D' . $column, $a['harga_pokok'])
					->setCellValue('E' . $column, $a['dp'])
					->setCellValue('F' . $column, $a['angsuran'])
					->setCellValue('G' . $column, $a['tenor']);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Produk-Kredit-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}


	public function exportExcelPengeluaran()
		{
			$produk = $this->PengeluaranModel->dataPengeluaran();
			$posk = $this->PosKreditModel->dataPOSKId();
			
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'id_pos')
				->setCellValue('B1', 'Deskripsi')
				->setCellValue('C1', 'Tgl_transaksi')
				->setCellValue('D1', 'Jumlah');
				
	
			$column = 2;
	
			foreach ($produk as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id_pos'])
					->setCellValue('B' . $column, $a['deskripsi'])
					->setCellValue('C' . $column, $a['tgl_transaksi'])
					->setCellValue('D' . $column, $a['jumlah']);
	
				$column++;
			}


			$spreadsheet->getActiveSheet()->setTitle("pengeluaran");


			$spreadsheet->createSheet(1);
			
			
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A1', 'id')
				->setCellValue('B1', 'Pos Pengeluaran');
				
	
			$column = 2;
	
			foreach ($posk as $k) {
				$spreadsheet->setActiveSheetIndex(1)
					->setCellValue('A' . $column, $k->id)
					->setCellValue('B' . $column, $k->nama_pos);
					
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("pos_pengeluaran");



	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Pengeluaran-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}



	public function exportExcelBayarKredit()
		{
			$produk = $this->ProdukModel->dataProdukKredit();
			
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'id')
				->setCellValue('B1', 'Nama Barang')
				->setCellValue('C1', 'Harga Jual')
				->setCellValue('D1', 'Harga Pokok')
				->setCellValue('E1', 'dp')
				->setCellValue('F1', 'angsuran')
				->setCellValue('G1', 'tenor');
				
	
			$column = 2;
	
			foreach ($produk as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['nama_barang'])
					->setCellValue('C' . $column, $a['harga_jual'])
					->setCellValue('D' . $column, $a['harga_pokok'])
					->setCellValue('E' . $column, $a['dp'])
					->setCellValue('F' . $column, $a['angsuran'])
					->setCellValue('G' . $column, $a['tenor']);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Produk-Kredit-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}




	public function exportExcel()
		{
			$mutasi = $this->MutasiModel->listMutasi();
			
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'No KK')
				->setCellValue('B1', 'Nama')
				->setCellValue('C1', 'Alasan')
				->setCellValue('D1', 'tgl_mutasi');
				
	
			$column = 2;
	
			foreach ($mutasi as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a->no_kk_lama)
					->setCellValue('B' . $column, $a->nama)
					->setCellValue('C' . $column, $a->alasan)
					->setCellValue('D' . $column, $a->tgl_mutasi);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Mutasi-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}
		


	public function hapusTableKelompok()
		{
			$this->KelompokModel->hapusTableKelompok();
			$data=['title'=>'Upload Table Kelompok'];
			return view('/ub/uploadKelompok',$data);
		}


	public function hapusTablePos($pos = false)
		{
			
			if($pos=="DEBET"){
				$this->PosDebetModel->hapusTablePosD();
				$data=['title'=>'Upload POS '.$pos];
				return redirect()->to('/ub/uploadPos/DEBET');
				
				//return view('/ub/uploadPos/DEBET',$data);

			} else {
				$this->PosKreditModel->hapusTablePosK();
				$data=['title'=>'Upload POS '.$pos];
				return redirect()->to('/ub/uploadPos/KREDIT');
				//return view('/ub/uploadPos/KREDIT',$data);

			}		
		}



	public function hapusTableSaham()
		{
			$this->SahamModel->hapusTableSaham();
			$data=['title'=>'Upload Table Saham'];
			return view('/ub/uploadSaham',$data);
		}

	public function hapusTableSahamKK()
		{
			$this->SahamkkModel->hapusTableSahamKK();
			$data=['title'=>'Upload Table Saham KK'];
			return view('/ub/uploadSahamKK',$data);
		}


	public function hapusTipeSaham()
		{
			$this->tipeSahamModel->hapusTipeSaham();
			$data=['title'=>'Upload Table Saham'];
			return view('/ub/uploadtipeSaham',$data);
		}


	public function exportExcelKelompok()
		{
			$kelompok = $this->KelompokModel->tableKelompok();
	
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'Id#')
				->setCellValue('B1', 'Kode Kelompok')
	
				->setCellValue('C1', 'Nama')
				->setCellValue('D1', 'Prefix');
				
	
			$column = 2;
	
			foreach ($kelompok as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['kode_klp'])
					->setCellValue('C' . $column, $a['nama_klp'])
					->setCellValue('D' . $column, $a['prefix_kk']);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Kelompok-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}


	public function exportExcelTipeSaham()
		{
			$tipeSaham = $this->tipeSahamModel->tipeSaham();
	
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'Id#')
				->setCellValue('B1', 'Tipe Saham')
				->setCellValue('C1', 'Harga Saham');
				
	
			$column = 2;
	
			foreach ($tipeSaham as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a->id)
					->setCellValue('B' . $column, $a->kode_saham)
					->setCellValue('C' . $column, $a->harga_saham);
					
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-TipeSaham-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}


	public function exportExcelSahamKK()
		{
			$SahamKK = $this->SahamkkModel->dataSahamKK();
	
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'Id#')
				->setCellValue('B1', 'ID KK')
				->setCellValue('C1', 'Nama KK')
				->setCellValue('D1', 'ID Kelompok');
				
				
	
			$column = 2;
	
			foreach ($SahamKK as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['id_kk'])
					->setCellValue('C' . $column, $a['nama_kk'])
					->setCellValue('D' . $column, $a['id_klp']);
					
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-SahamKK-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}



	public function exportExcelPos($pos = false)
		{
			if($pos == 'DEBET'){
				$pos = $this->PosDebetModel->dataPOSDId();
				$filename = 'Data-Pos-Penerimaan-'. date('Y-m-d-His');
			} elseif($pos == 'KREDIT'){
				$pos = $this->PosKreditModel->dataPOSKId();
				$filename = 'Data-Pos-Pengeluaran-'. date('Y-m-d-His');

			}		
	
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'Id#')
				->setCellValue('B1', 'Nama POS');
				
	
			$column = 2;
	
			foreach ($pos as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a->id)
					->setCellValue('B' . $column, $a->nama_pos);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}



	public function exportExcelSaham()
		{
			$saham = $this->SahamModel->dataSaham();
			$tipeSaham = $this->tipeSahamModel->tipeSaham();
			
			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Nomer KK')
				->setCellValue('C1', 'Nama')
				->setCellValue('D1', 'Alamat')
				->setCellValue('E1', 'HP')
				->setCellValue('F1', 'Tgl Join')
				->setCellValue('G1', 'Jumlah Saham')
				->setCellValue('H1', 'id_tipe');
				
				
	
			$column = 2;
	
			foreach ($saham as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['no_kk'])
					->setCellValue('C' . $column, $a['nama'])
					->setCellValue('D' . $column, $a['alamat'])
					->setCellValue('E' . $column, $a['hp'])
					->setCellValue('F' . $column, $a['tgl_join'])
					->setCellValue('G' . $column, $a['jml_saham'])
					->setCellValue('H' . $column, $a['id_tipe']);
					
	
				$column++;
			}
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column+1, 'Id Tipe menyesuaikan data di Sheet Tipe Saham');
	
	
			$spreadsheet->getActiveSheet()->setTitle("saham");

			$spreadsheet->createSheet(1);
			
			
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Kode Saham')
				->setCellValue('C1', 'Harga Saham');
				
	
			$column = 2;
	
			foreach ($tipeSaham as $b) {
				$spreadsheet->setActiveSheetIndex(1)
					->setCellValue('A' . $column, $b->id)
					->setCellValue('B' . $column, $b->kode_saham)
					->setCellValue('C' . $column, $b->harga_saham);
	
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("tipe_saham");



			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Saham-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}


	public function exportExcelReportSaham()
		{
			$saham = $this->SahamModel->dataSaham();
			$tipeSaham = $this->tipeSahamModel->tipeSaham();
			
			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Nomer KK')
				->setCellValue('C1', 'Nama')
				->setCellValue('D1', 'Alamat')
				->setCellValue('E1', 'HP')
				->setCellValue('F1', 'Tgl Join')
				->setCellValue('G1', 'Jumlah Saham')
				->setCellValue('H1', 'kode_saham')
				->setCellValue('I1', 'harga_saham');			;
				
				
	
			$column = 2;
	
			foreach ($saham as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['no_kk'])
					->setCellValue('C' . $column, $a['nama'])
					->setCellValue('D' . $column, $a['alamat'])
					->setCellValue('E' . $column, $a['hp'])
					->setCellValue('F' . $column, $a['tgl_join'])
					->setCellValue('G' . $column, $a['jml_saham'])
					->setCellValue('H' . $column, $a['kode_saham'])
					->setCellValue('I' . $column, $a['harga_saham']);
					
	
				$column++;
			}
				
	
			$spreadsheet->getActiveSheet()->setTitle("saham");



			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Saham-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}



	public function exportExcelAll()
		{
			$saham = $this->SahamModel->dataSaham();
			$tipeSaham = $this->tipeSahamModel->tipeSaham();
			$kelompok = $this->KelompokModel->tableKelompok();
			$kk = $this->SahamkkModel->dataSahamKK();
			$posd = $this->PosDebetModel->dataPOSDId();
			$posk = $this->PosKreditModel->dataPOSKId();
			
			
			
			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Nomer KK')
				->setCellValue('C1', 'Nama')
				->setCellValue('D1', 'Alamat')
				->setCellValue('E1', 'HP')
				->setCellValue('F1', 'Tgl Join')
				->setCellValue('G1', 'Jumlah Saham')
				->setCellValue('H1', 'id_tipe');
				
				
	
			$column = 2;
	
			foreach ($saham as $a) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $a['id'])
					->setCellValue('B' . $column, $a['no_kk'])
					->setCellValue('C' . $column, $a['nama'])
					->setCellValue('D' . $column, $a['alamat'])
					->setCellValue('E' . $column, $a['hp'])
					->setCellValue('F' . $column, $a['tgl_join'])
					->setCellValue('G' . $column, $a['jml_saham'])
					->setCellValue('H' . $column, $a['id_tipe']);
					
	
				$column++;
			}
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column+1, 'Id Tipe menyesuaikan data di Tipe Saham');
	
	
			$spreadsheet->getActiveSheet()->setTitle("saham");

			$spreadsheet->createSheet(1);
			
			
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Kode Saham')
				->setCellValue('C1', 'Harga Saham');
				
	
			$column = 2;
	
			foreach ($tipeSaham as $b) {
				$spreadsheet->setActiveSheetIndex(1)
					->setCellValue('A' . $column, $b->id)
					->setCellValue('B' . $column, $b->kode_saham)
					->setCellValue('C' . $column, $b->harga_saham);
	
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("tipe_saham");


			$spreadsheet->createSheet(2);
			
			
			$spreadsheet->setActiveSheetIndex(2)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'Kode Kelompok')
				->setCellValue('C1', 'Nama Kelompok')
				->setCellValue('D1', 'Prefix KK');
				
	
			$column = 2;
	
			foreach ($kelompok as $kel) {
				$spreadsheet->setActiveSheetIndex(2)
					->setCellValue('A' . $column, $kel['id'])
					->setCellValue('B' . $column, $kel['kode_klp'])
					->setCellValue('C' . $column, $kel['nama_klp'])
					->setCellValue('D' . $column, $kel['prefix_kk']);
					
	
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("kelompok");


			$spreadsheet->createSheet(3);
			
			
			$spreadsheet->setActiveSheetIndex(3)
				->setCellValue('A1', 'ID')
				->setCellValue('B1', 'ID KK')
				->setCellValue('C1', 'Nama KK')
				->setCellValue('D1', 'ID Kelompok');
				
	
			$column = 2;
	
			foreach ($kk as $k) {
				$spreadsheet->setActiveSheetIndex(3)
					->setCellValue('A' . $column, $k['id'])
					->setCellValue('B' . $column, $k['id_kk'])
					->setCellValue('C' . $column, $k['nama_kk'])
					->setCellValue('D' . $column, $k['id_klp']);
					
	
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("kk");


			$spreadsheet->createSheet(4);
			
			
			$spreadsheet->setActiveSheetIndex(4)
				->setCellValue('A1', 'id')
				->setCellValue('B1', 'Pos Penerimaan');
				
	
			$column = 2;
	
			foreach ($posd as $k) {
				$spreadsheet->setActiveSheetIndex(4)
					->setCellValue('A' . $column, $k->id)
					->setCellValue('B' . $column, $k->nama_pos);
					
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("pos_penerimaan");


			$spreadsheet->createSheet(5);
			
			
			$spreadsheet->setActiveSheetIndex(5)
				->setCellValue('A1', 'id')
				->setCellValue('B1', 'Pos Pengeluaran');
				
	
			$column = 2;
	
			foreach ($posk as $k) {
				$spreadsheet->setActiveSheetIndex(5)
					->setCellValue('A' . $column, $k->id)
					->setCellValue('B' . $column, $k->nama_pos);
					
				$column++;
			}

			$spreadsheet->getActiveSheet()->setTitle("pos_pengeluaran");


			$writer = new Xlsx($spreadsheet);
			$filename =  'Data-Saham-'. date('Y-m-d-His');
	
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}


		
		   public function import() {
        $path           = 'documents/users/';
        $json           = [];
        $file_name      = $this->request->getFile('file');
        $file_name      = $this->uploadFile($path, $file_name);
        $arr_file       = explode('.', $file_name);
        $extension      = end($arr_file);
        if('csv' == $extension) {
            $reader     = new PhpOfficePhpSpreadsheetReaderCsv();
        } else {
            $reader     = new PhpOfficePhpSpreadsheetReaderXlsx();
        }
        $spreadsheet    = $reader->load($file_name);
        $sheet_data     = $spreadsheet->getActiveSheet()->toArray();

        $list           = [];
        foreach($sheet_data as $key => $val) {
            if($key != 0) {
                $result     = $this->userModel->getUser(["country_code" => $val[2], "mobile" => $val[3]]);
                if($result) {
                } else {
                    $list [] = [
                        'name'                  => $val[0],
                        'country_code'          => $val[1],
                        'mobile'                => $val[2],
                        'email'                 => $val[3],
                        'city'                  => $val[4],
                        'ip_address'            => $this->ip_address,
                        'created_at'            => $this->datetime,
                        'status'                => "1",
                    ];
                }
            }
        }

        if(file_exists($file_name))
            unlink($file_name);
        if(count($list) > 0) {
            $result     = $this->userModel->bulkInsert($list);
            if($result) {
                $json = [
                    'success_message'   => showSuccessMessage("All Entries are imported successfully."),
                ];
            } else {
                $json = [
                    'error_message'     => showErrorMessage("Something went wrong. Please try again.")
                ];
            }
        } else {
            $json = [
                'error_message' => showErrorMessage("No new record is found."),
            ];
        }

        echo json_encode($json);
    }

	
}