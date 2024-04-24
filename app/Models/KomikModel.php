<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table      = 'komik';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','judul','slug','penulis','penerbit','sampul'];



public function getKomik($slug = false)
{
    if($slug == false)
    {
        return $this->findAll();
    }
    return $this->where([ 'slug' => $slug ])->first();
}
public function getKomikId($id = false)
{
    if($id == false)
    {
        return $this->findAll();
    }
    return $this->where([ 'id' => $id ])->first();
}

public function insertKomik($data)
{
    return $this->insert($data, false);
}

public function updateKomikId($id,$data)
{

return $this->update($id,$data);


}
}