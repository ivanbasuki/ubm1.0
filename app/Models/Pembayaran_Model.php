<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;


class Pembayaran_Model extends Model
{
    protected $table      = 'pembayaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_invoice','no_bayar','tgl_bayar','jumlah_bayar','keterangan'];

public function listBayar($bl = false, $th = false)
{
    if($bl == false && $th == false)
    {
        $builder = $this->db->table('invoice')->select('invoice.id,pembayaran.no_bayar,sum(pembayaran.jumlah_bayar) jumlah_bayar,invoice.no_invoice,invoice.tgl_invoice,invoice.total,invoice.deskripsi')->join('pembayaran','pembayaran.id_invoice=invoice.id','left')->orderBy('invoice.tgl_invoice','ASC')->groupBy('invoice.id');
        $query   = $builder->get();
    } else {
	    $builder = $this->db->table('invoice')->select('invoice.id,pembayaran.no_bayar,sum(pembayaran.jumlah_bayar) jumlah_bayar,invoice.no_invoice,invoice.tgl_invoice,invoice.total,invoice.deskripsi')->join('pembayaran','pembayaran.id_invoice=invoice.id','left')->where('month(invoice.tgl_invoice)',$bl)->where('year(invoice.tgl_invoice)',$th)->orderBy('invoice.tgl_invoice','ASC')->groupBy('invoice.id');
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


public function detailBayar($id_invoice = false)
{
    if($id_invoice == false)
    {
        $builder = $this->db->table('pembayaran')->select('*');
		$query   = $builder->get();
    } else {
	    $builder = $this->db->table('pembayaran')->select('*')->where('id_invoice',$id_invoice);
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


public function nomorBayar()
{

	$query = $this->db->query("SELECT max(id)+1 id FROM pembayaran");
	$result = ($query->getFirstRow()->id)+1;
	return $result;

}

public function nomorBayarKredit()
{

	$query = $this->db->query("SELECT max(id)+1 id FROM pembayaran_kredit");
	$result = ($query->getFirstRow()->id)+1;
	return $result;

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