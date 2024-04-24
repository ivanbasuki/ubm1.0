<?php

namespace App\Models;

use CodeIgniter\Model;

class tipeSaham_Model extends Model
{
    protected $table      = 'tipe_saham';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','tipe_saham','harga_saham'];
    protected $db = 'ci4';

    public function tipeSaham($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('*');
            $query   = $builder->get();
        } else
            {
                $builder = $this->select('*')->where('id',$id);
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
	
	
    public function hapusTipeSaham()
    {
		return $this->truncate();
	}


public function inserttipeSaham($data)
{
    return $this->insert($data, false);
}

public function updatetipeSaham($id,$data)
{
   return $this->update($id,$data);
}



public function hapustipeSahamID($id)
{
   return $this->delete($id);
}

}