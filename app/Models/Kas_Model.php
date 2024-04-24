<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;


class Kas_Model extends Model
{
    protected $table      = 'kas';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama_kas','pemegang_kas'];



public function dataKas($id = false)
{
if($id == false)
{
	return $this->findAll();	
}
return $this->where(['id'=>$id])->first();	

}

public function insertKas($data)
{
    return $this->insert($data);
}

public function updateKas($id,$data)
{

return $this->update($id,$data);


}

public function hapusKas($id)
{

return $this->delete($id);


}

public function hapusTableKas($id)
{

return $this->truncate();


}


}