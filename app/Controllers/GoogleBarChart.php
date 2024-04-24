<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class GoogleBarChart extends Controller
{
    public function index() {
        return view('chart');
    }
    
    public function initChart() {
        
        $db = \Config\Database::connect();
        $builder = $db->table('pembayaran');
        $query = $builder->select("COUNT(id) as count, jumlah_bayar as s, DAYNAME(created_at) as day");
        $query = $builder->where("DAY(created_at) GROUP BY DAYNAME(created_at), s")->get();
        $record = $query->getResult();
        $pembayaran = [];
        foreach($record as $row) {
            $pembayaran[] = array(
                'day'   => $row->day,
                'sell' => floatval($row->s)
            );
        }
        
        $data['pembayaran'] = ($pembayaran);    
        $data['title'] = 'Grafik Bar Pembayaran';    

        return view('ub/googleBar', $data);                
    }
 
}