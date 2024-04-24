<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;

class Kelompok_Model extends Model
{
    //protected $table      = 'saham_kk';
    protected $db = 'ci4';
    protected $table = 'kelompok';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','kode_klp','nama_klp'];



public function tableKelompok($kodeklp = false)
{
    if($kodeklp == false)
    {
        return $this->findAll();
    } else
        {
			return $this->where(['id' => $kodeklp])->first();
    } 
}



public function getKelompok($kodeklp = false)
{
    if($kodeklp == false)
    {
        $builder = $this->db->table('kelompok')->select('kelompok.kode_klp,kelompok.nama_klp,saham_kk.id_klp,kelompok.prefix_kk,count(*) jumlah,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_klp=kelompok.id','left')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->groupBy('kode_klp');
        $query   = $builder->get();
    } else
        {
			$builder = $this->db->table('kelompok')->select('kelompok.kode_klp,kelompok.nama_klp,saham_kk.id_klp,kelompok.prefix_kk,count(*) jumlah,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_klp=kelompok.id','left')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->where('kelompok.id',$kodeklp)->groupBy('kode_klp');
            $query = $builder->get();    
    } 
if ($query->getNumRows() > 0) {
   foreach ($query->getResult() as $row) {
       $data[] = $row;
   }
   return $data;
}
return false;
}

public function hapusTableKelompok()
{
    return $this->emptyTable();
}



public function rekapKelompok($kodeklp = false)
{
    if($kodeklp == false)
    {
        $builder = $this->db->table('kelompok')->select('kelompok.id,kelompok.nama_klp,count(saham_kk.id_klp) kk,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_klp=kelompok.id','left')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->groupBy('kelompok.id');
        $query   = $builder->get();
    } else
        {
			$builder = $this->db->table('kelompok')->select('kelompok.id,kelompok.nama_klp,count(saham_kk.id_klp) kk,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_klp=kelompok.id','left')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->where('kelompok.id',$kodeklp)->groupBy('kelompok.id');
            $query = $builder->get();    
    } 
if ($query->getNumRows() > 0) {
   foreach ($query->getResult() as $row) {
       $data[] = $row;
   }
   return $data;
}
return false;
}


   public function getDataChart() {
   
        //$query =  $this->db->query("SELECT created_at as y_date, DAYNAME(created_at) as day_name, COUNT(id) as count  FROM usersx WHERE date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "' GROUP BY DAYNAME(created_at) ORDER BY (y_date) ASC"); 
		$builder =  $this->db->table("kelompok")->select("nama_klp,sum(saham_anggota.jml_saham) jumlah")->join("saham_kk","saham_kk.id_klp=kelompok.id","left")->join("saham_anggota","saham_anggota.no_kk=saham_kk.id_kk","left")->groupBy("kelompok.id");
		$query = $builder->get();
 
        $record = $query->getResult();
        $data = [];
 
        foreach($record as $row) {
            $data[] = [$row->nama_klp,(int) $row->jumlah];
            //$data[][] = (int) $row->jumlah;
        }
        $data1 = json_encode($data);
		return $data1;
    }


   public function getDataChart1() {
   
        //$query =  $this->db->query("SELECT created_at as y_date, DAYNAME(created_at) as day_name, COUNT(id) as count  FROM usersx WHERE date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "' GROUP BY DAYNAME(created_at) ORDER BY (y_date) ASC"); 
		$builder =  $this->db->table("kelompok")->select("nama_klp,count(id) jumlah")->groupBy("id");
		$query = $builder->get();
 
        $record = $query->getResult();
        $data = [];
 
        foreach($record as $row) {
            $data['label'][] = $row->nama_klp;
            $data['data'][] = (int) $row->jumlah;
        }
        $data['chart_data'] = json_encode($data);
		return $data;
    }



public function getDataKelompok($kodeklp = false)
{
    if($kodeklp == false)
    {
        return $this->findAll();
    }
    return $this->where([ 'kode_klp' => $kodeklp ])->first();
}

public function insertKelompok($data)
{
    return $this->insert($data, false);
}

public function updateKelompok($kodeklp,$data)
{

return $this->update($kodeklp,$data);


}
}