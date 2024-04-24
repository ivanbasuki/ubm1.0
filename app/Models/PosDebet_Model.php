<?php

namespace App\Models;

use CodeIgniter\Model;

class PosDebet_Model extends Model
{
    protected $table      = 'pos_penerimaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama_pos'];
    protected $db = 'ci4';

    public function dataPOSDId($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('pos_penerimaan')->select('id,nama_pos');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('pos_penerimaan')->select('id,nama_pos')->where('id',$id);
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
    

public function insertPOSD($data)
{
    return $this->insert($data, false);
}

public function updatePOSD($id,$data)
{
   return $this->update($id,$data);
}



public function hapusPOSD($id)
{
   return $this->delete($id);
}

public function hapusTablePOSD()
{
   return $this->truncate();
}

}