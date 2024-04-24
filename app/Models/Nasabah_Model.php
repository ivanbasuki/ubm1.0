<?php

namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;


//SELECT a.tgl_transaksi,b.nama_barang,b.harga_jual,b.angsuran,b.tenor,c.nama_pelanggan,sum(d.jumlah) jumlah from nasabah_kredit a left join produk_kredit b on a.id_kredit=b.id left join pelanggan c on a.id_anggota=c.id left join pembayaran_kredit d on a.id_kredit=d.id_kredit group by a.id_kredit;

class Nasabah_Model extends Model
{
    protected $table      = 'nasabah_kredit';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_anggota','id_kredit','tgl_transaksi'];
	protected $db = 'ci4';

    public function listNasabah($nasabahId = false)
    {
        if($nasabahId == false)
        {
            $builder = $this->select('nasabah_kredit.id,nasabah_kredit.tgl_transaksi,produk_kredit.nama_barang,produk_kredit.tenor,produk_kredit.harga_jual,produk_kredit.angsuran,produk_kredit.tenor,pelanggan.nama_pelanggan,count(pembayaran_kredit.jumlah) jml,sum(pembayaran_kredit.jumlah) terbayar')
			->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left')
			->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')
			->join('pembayaran_kredit','pembayaran_kredit.id_kredit=nasabah_kredit.id','left')
			->groupBy('nasabah_kredit.id');
			$query   = $builder->get();
             } else
            {
           $builder = $this->select('nasabah_kredit.id,nasabah_kredit.tgl_transaksi,produk_kredit.nama_barang,produk_kredit.tenor,produk_kredit.harga_jual,produk_kredit.angsuran,produk_kredit.tenor,pelanggan.nama_pelanggan,count(pembayaran_kredit.jumlah) jml,sum(pembayaran_kredit.jumlah) terbayar')
			->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left')
			->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')
			->join('pembayaran_kredit','pembayaran_kredit.id_kredit=nasabah_kredit.id','left')
			->groupBy('nasabah_kredit.id')
			->where('nasabah_kredit.id',$nasabahId);
 
// $builder = $this->select('*')->where('id',$nasabahId);
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
 
 
 public function detailKredit($id = false){
    if($id == false)
    {
		$builder = $this->select('nasabah_kredit.id,nasabah_kredit.tgl_transaksi,produk_kredit.nama_barang,produk_kredit.angsuran,produk_kredit.tenor,nasabah_kredit.id_anggota,pelanggan.nama_pelanggan')->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left');
		$query   = $builder->get();
    } else {
		
        $builder = $this->select('nasabah_kredit.id,nasabah_kredit.tgl_transaksi,produk_kredit.nama_barang,produk_kredit.angsuran,produk_kredit.tenor,nasabah_kredit.id_anggota,pelanggan.nama_pelanggan')->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left')->where('nasabah_kredit.id',$id);
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
 
 
    public function getNasabah($id = false)
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
 

    
public function insertNasabah($data)
{
    return $this->insert($data, false);
}

public function updateNasabah($id,$data)
{
   return $this->update($id,$data);
}

public function hapusNasabah($id)
{
   return $this->delete($id);
}

}