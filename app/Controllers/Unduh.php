<?php 
namespace AppControllers;

use App\Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Unduh extends BaseController {

    public function __construct() {
        $db                         = db_connect();
        $this->ip_address            = $_SERVER['REMOTE_ADDR'];
        $this->datetime          = date("Y-m-d H:i:s");
    }

    public function index() {
        echo view("index");
    }

    public function display() {
        $data   = [];
        $data ["result"] = $this->userModel->getUserList();
        echo view("display", $data);
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

    public function uploadFile($path, $image) {
        if (!is_dir($path)) 
            mkdir($path, 0777, TRUE);
        if ($image->isValid() && ! $image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('./'.$path, $newName);
            return $path.$image->getName();
        }
        return "";
    }
}