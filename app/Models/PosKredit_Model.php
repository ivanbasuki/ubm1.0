<?php

namespace App\Models;

use CodeIgniter\Model;

class PosKredit_Model extends Model
{
    protected $table      = 'pos_pengeluaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama_pos'];
    protected $db = 'ci4';

    public function listPOSK($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('pos_pengeluaran')->select('id,nama_pos');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('pos_pengeluaran')->select('id,nama_pos')->where('id',$id);
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
    

    public function dataPOSKId($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('pos_pengeluaran')->select('id,nama_pos');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('pos_pengeluaran')->select('id,nama_pos')->where('id',$id);
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
    


public function insertPOSK($data)
{
    return $this->insert($data, false);
}

public function updatePOSK($id,$data)
{
   return $this->update($id,$data);
}



public function hapusPOSK($id)
{
   return $this->delete($id);
}

public function hapusTablePOSK()
{
   return $this->truncate();
}


}