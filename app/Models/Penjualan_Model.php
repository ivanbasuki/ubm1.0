<?php

namespace App\Models;
use CodeIgniter\Model;

class Penjualan_Model extends Model
{
    protected $table      = 'detail_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_pelanggan','id_invoice','tgl_penjualan','jumlah'];
    protected $db = 'ci4';

    public function listPenjualan($bl = false, $th = false)
    {
        if($bl == false && $th == false)
        {
            $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp,invoice.no_invoice')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->join('invoice','invoice.id=detail_penjualan.id_invoice','left');
            $query   = $builder->get();
             } else
            {
                $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp,invoice.no_invoice')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->join('invoice','invoice.id=detail_penjualan.id_invoice','left')->where('year(detail_penjualan.tgl_penjualan)',$th)->where('month(detail_penjualan.tgl_penjualan)',$bl);
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
 

    public function listPenjualanKelompok($bl = false, $th = false, $kelompok = false)
    {
        if($bl == false && $th == false && $kelompok == false)
        {
            $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left');
			$query   = $builder->get();
		
		     } else
            {
                $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where('year(detail_penjualan.tgl_penjualan)',$th)->where('month(detail_penjualan.tgl_penjualan)',$bl)->where('kelompok.id',$kelompok)->where('detail_penjualan.id_invoice',NULL);
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


    public function getPenjualanIdInvoice($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('detail_penjualan.id,invoice.no_invoice,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('invoice','invoice.id=detail_penjualan.id_invoice','left')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left');
            $query   = $builder->get();
             } else
            {
                $builder = $this->select('detail_penjualan.id,invoice.no_invoice,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('invoice','invoice.id=detail_penjualan.id_invoice','left')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where('detail_penjualan.id_invoice',$id);
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
 
    public function getPenjualanId($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left');
            $query   = $builder->get();
             } else
            {
                $builder = $this->select('detail_penjualan.id,pelanggan.nama_pelanggan,detail_penjualan.tgl_penjualan,detail_penjualan.jumlah,kelompok.nama_klp')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where('detail_penjualan.id',$id);
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

    
public function insertPenjualan($data)
{
    return $this->insert($data, false);
}

public function updatePenjualan($id,$data)
{
   return $this->update($id,$data);
}

public function hapusPenjualan($id)
{
   return $this->delete($id);
}

}