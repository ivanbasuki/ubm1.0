<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;


class PembayaranKredit_Model extends Model
{
    protected $table      = 'pembayaran_kredit';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_kredit','no_bayar','tgl_bayar','jumlah','keterangan'];


public function nomorBayarKredit()
{

	$query = $this->db->query("SELECT max(id)+1 id FROM pembayaran_kredit");
	$result = ($query->getFirstRow()->id)+1;
	return $result;

}

public function rincianBayarKredit($id = false)
{

if($id == false){
	$builder = $this->select('*')->orderBy('tgl_bayar','ASC');
	$query = $builder->get();
} else {
		$builder = $this->select('*')->where('id_kredit',$id)->orderBy('tgl_bayar','ASC');
		$query = $builder->get();
}

   if ($query->getNumRows() > 0) {
       foreach ($query->getResult() as $row) {
           $data[] = $row;
       }
       return $data;
   }
   return false;
}

public function detailBayarKredit($id = false)
{
if($id == false)
{
	return $this->select('pembayaran_kredit.id_kredit,pelanggan.nama_pelanggan,kelompok.nama_klp,produk_kredit.nama_barang,produk_kredit.harga_jual,produk_kredit.dp,produk_kredit.angsuran,produk_kredit.tenor,produk_kredit.angsuran,produk_kredit.nama_barang,pembayaran_kredit.no_bayar,pembayaran_kredit.tgl_bayar,pembayaran_kredit.jumlah,pembayaran_kredit.keterangan')->join('nasabah_kredit','nasabah_kredit.id=pembayaran_kredit.id_kredit','left')->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left')->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->findAll();
}
return $this->select('pembayaran_kredit.id_kredit,pelanggan.nama_pelanggan,kelompok.nama_klp,produk_kredit.nama_barang,produk_kredit.harga_jual,produk_kredit.dp,produk_kredit.angsuran,produk_kredit.tenor,produk_kredit.angsuran,produk_kredit.nama_barang,pembayaran_kredit.no_bayar,pembayaran_kredit.tgl_bayar,pembayaran_kredit.jumlah,pembayaran_kredit.keterangan')->join('nasabah_kredit','nasabah_kredit.id=pembayaran_kredit.id_kredit','left')->join('produk_kredit','produk_kredit.id=nasabah_kredit.id_kredit','left')->join('pelanggan','pelanggan.id=nasabah_kredit.id_anggota','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where(['pembayaran_kredit.id'=>$id])->first();	

}

public function terbayar($id_kredit = false)
{
if($id_kredit == false)
{
	return false;
}	
return $this->select('sum(pembayaran_kredit.jumlah) terbayar')->where(['pembayaran_kredit.id_kredit'=>$id_kredit])->groupBy('pembayaran_kredit.id_kredit')->first();	

}

public function insertBayar($data)
{
    return $this->insert($data);
}

public function updateBayar($id,$data)
{

return $this->update($id,$data);


}

public function hapusBayar($id)
{

return $this->delete($id);


}

}