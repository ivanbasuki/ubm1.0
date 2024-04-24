<?php

namespace App\Models;
use CodeIgniter\Model;

class Produk_Model extends Model
{
    protected $table      = 'produk_kredit';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama_barang','harga_jual','harga_pokok','dp','angsuran','tenor'];
    protected $db = 'ci4';

    public function listProduk($produk = false)
    {
        if($produk == false)
        {
            $builder = $this->select('*');
			$query   = $builder->get();
             } else
            {
                $builder = $this->select('*')->where('nama_barang like ',$produk);
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


    public function dataProdukKredit($id = false)
    {
        if($id == false)
        {
            return $this->findAll();
		} else	{
			return $this->where(['id'=>$id])->first();
		}
    }
 
 
    public function getProduk($id = false)
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
 

    
public function insertProduk($data)
{
    return $this->insert($data, false);
}

public function updateProduk($id,$data)
{
   return $this->update($id,$data);
}

public function hapusProduk($id)
{
   return $this->delete($id);
}

public function hapusProdukAll()
{
   return $this->truncate();
}

}