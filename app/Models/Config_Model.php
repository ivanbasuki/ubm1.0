<?php

namespace App\Models;

use CodeIgniter\Model;

class Config_Model extends Model
{
    protected $table      = 'konfigurasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','kode','nama_kode'];
    protected $db = 'ci4';

    public function listConfig($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('konfigurasi')->select('*');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('konfigurasi')->select('*')->where('id',$id);
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
    

public function getConfig($kode=''){
    return $this->where([ 'kode' => $kode ])->first(); 	
}	

public function getConfigAll($kode=''){
   $configAll = $this->select('kode,nama_kode')->findAll();
   if(empty($configAll)){
	   return false;
   }   
   foreach($configAll as $conf):
		$data[$conf['kode']] = $conf['nama_kode'];
	endforeach;
    return $data;	
}



public function insertConfig($data)
{
    return $this->insert($data, false);
}

public function updateConfig($id,$data)
{
   return $this->update($id,$data);
}



public function hapusConfig($id)
{
   return $this->delete($id);
}

}