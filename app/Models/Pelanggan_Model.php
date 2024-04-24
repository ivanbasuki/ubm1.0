<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan_Model extends Model
{
    protected $table      = 'pelanggan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama_pelanggan','hp','id_anggota','id_kelompok'];
    protected $db = 'ci4';

    public function listPelanggan($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('pelanggan.id,pelanggan.nama_pelanggan,pelanggan.hp,kelompok.nama_klp')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left');
            $query   = $builder->get();
             } else
            {
                $builder = $this->select('pelanggan.id,pelanggan.nama_pelanggan,pelanggan.hp,kelompok.nama_klp')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where('pelanggan.id',$id);
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
 
    public function getPelanggan($id = false)
    {
        if($id == false)
        {
            return $this->findAll();
        }
        return $this->where([ 'id' => $id ])->first();
    }
        
public function insertPelanggan($data)
{
    return $this->insert($data, false);
}

public function updatePelanggan($id,$data)
{
   return $this->update($id,$data);
}

public function hapusPelanggan($id)
{
   return $this->delete($id);
}

}