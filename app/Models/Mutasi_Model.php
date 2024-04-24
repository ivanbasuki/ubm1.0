<?php

namespace App\Models;

use CodeIgniter\Model;

class Mutasi_Model extends Model
{
    protected $table      = 'saham_mutasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_saham_lama','no_kk_lama','nama','alamat','hp','tgl_join','jml_saham','tipe_saham','alasan','tgl_mutasi'];
    protected $db = 'ci4';

    public function listMutasi($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('saham_mutasi.id,saham_mutasi.no_kk_lama,saham_anggota.no_kk,saham_anggota.nama,saham_mutasi.tgl_mutasi,saham_mutasi.alasan')->join('saham_anggota','saham_anggota.id=saham_mutasi.id_saham_lama','left');
			$query   = $builder->get();
        } else
            {

		    $builder = $this->select('saham_mutasi.id,saham_mutasi.no_kk_lama,saham_anggota.no_kk,saham_anggota.nama,saham_mutasi.tgl_mutasi,saham_mutasi.alasan')->join('saham_anggota','saham_anggota.id=saham_mutasi.id_saham_lama','left')->where('saham_mutasi.id_saham_lama',$id);
			
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
    

public function insertMutasi($data)
{
    return $this->insert($data);
}

public function updateMutasi($id,$data)
{
   return $this->update($id,$data);
}

public function hapusMutasi($id)
{
   return $this->delete($id);
}

}