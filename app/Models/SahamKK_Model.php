<?php

namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;

class SahamKK_Model extends Model
{
    protected $table      = 'saham_kk';
    protected $db = 'ci4';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_kk','nama_kk'];


public function dataSahamKK($idkk = false)
{
    if($idkk == false)
    {
			
			return $this->select('saham_kk.id,saham_kk.id_kk,saham_kk.nama_kk,saham_kk.id_klp,kelompok.nama_klp')->join('kelompok','saham_kk.id_klp=kelompok.id','left')->findAll();
    } else
        {
		return $this->select('saham_kk.id,saham_kk.id_kk,saham_kk.nama_kk,saham_kk.id_klp,kelompok.nama_klp')->join('kelompok','saham_kk.id_klp=kelompok.id','left')->where(['saham_kk.id_kk'=>$idkk])->first();
    } 
}

public function getAllKK($nokk = false)
{
    if($nokk == false)
    {
        $builder = $this->select('saham_kk.id,saham_kk.id_kk,saham_kk.nama_kk,sum(saham_anggota.jml_saham) jumlah,kelompok.nama_klp')->join('kelompok','kelompok.id=saham_kk.id_klp','left')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->groupBy('saham_kk.id_kk');
		$query   = $builder->get();
    } else
        {
            $builder = $this->db->table('saham_anggota')->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.tgl_join,saham_anggota.jml_saham')->where('saham_anggota.no_kk',$nokk);
			$query   = $builder->get();
    } 
if ($query->getNumRows() > 0) {
   foreach ($query->getResult() as $row) {
       $data[] = $row;
   }
   
   return $data;
}
return false;


}

public function kkKelompok($idkel = false)
{
    if($idkel == false)
    {
        $builder = $this->select('saham_kk.id,saham_kk.id_kk,saham_kk.nama_kk,sum(saham_anggota.jml_saham) jumlah,kelompok.nama_klp')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp','left')->groupBy('saham_kk.id');
		$query   = $builder->get();
    } else
        {
            $builder = $this->select('saham_kk.id,saham_kk.id_kk,saham_kk.nama_kk,sum(saham_anggota.jml_saham) jumlah,kelompok.nama_klp')->join('saham_anggota','saham_anggota.no_kk=saham_kk.id_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp','left')->where('kelompok.id',$idkel)->groupBy('saham_kk.id');
			$query   = $builder->get();
    } 
if ($query->getNumRows() > 0) {
   foreach ($query->getResult() as $row) {
       $data[] = $row;
   }
   
   return $data;
}
return false;


}

public function getSahamkkId($nokk = false)
{
    if($nokk == false)
    {

        $builder = $this->db->table('saham_kk')->select('*');
        $query   = $builder->get();
   } else 
   {
        $builder = $this->db->table('saham_kk')->select('*')->where('id_kk',$nokk);
        $query   = $builder->get();

    }
    if ($query->getNumRows() > 0) {
        foreach ($query->getResult() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    }

public function insertSahamKK($data)
{
    return $this->insert($data, false);
}

public function updateSahamKK($idkk,$data)
{

return $this->update($idkk,$data);


}

public function hapusTableSahamKK()
{
    return $this->truncate();
}


public function hapusKK($idkk)
{
    return $this->delete($idkk);
}

}