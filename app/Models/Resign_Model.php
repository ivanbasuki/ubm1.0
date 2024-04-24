<?php

namespace App\Models;

use CodeIgniter\Model;

class Resign_Model extends Model
{
    protected $table      = 'saham_resign';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','no_kk','nama','alamat','hp','tgl_join','jml_saham','harga_saham','alasan','tgl_resign'];
    protected $db = 'ci4';

    public function listResign($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('saham_resign')->select('*');
			$query   = $builder->get();
        } else
            {

		    $builder = $this->db->table('saham_resign')->select('*')->where('id',$id);
			
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
    

public function insertResign($data)
{
    return $this->insert($data);
}

public function updateResign($id,$data)
{
   return $this->update($id,$data);
}

public function hapusResign($id)
{
   return $this->delete($id);
}

}