<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\RawSql;

class Invoice_Model extends Model
{
    protected $table      = 'invoice';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','no_invoice','tgl_invoice','total','deskripsi'];
	protected $db = 'ci4';

public function listInvoice($bl = false, $th = false, $id = false)
{
    if($bl == false && $th == false && $id == false)
    {
        $builder = $this->db->table('invoice')->select('invoice.id,kelompok.nama_klp,invoice.no_invoice,invoice.tgl_invoice,invoice.total,invoice.deskripsi')->join('detail_penjualan','detail_penjualan.id_invoice=invoice.id','left')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','pelanggan.id_kelompok=kelompok.id','left')->groupBy('invoice.id');
        $query   = $builder->get();
    } elseif($bl && $th && $id)
        {
        $builder = $this->db->table('invoice')->select('invoice.id,kelompok.nama_klp,invoice.no_invoice,invoice.tgl_invoice,invoice.total,invoice.deskripsi')->join('detail_penjualan','detail_penjualan.id_invoice=invoice.id','left')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','pelanggan.id_kelompok=kelompok.id','left')->where('year(invoice.tgl_invoice)',$th)->where('month(invoice.tgl_invoice)',$bl)->where('kelompok.id',$id)->groupBy('invoice.id');
        $query = $builder->get();
    }  else {
	    $builder = $this->db->table('invoice')->select('invoice.id,kelompok.nama_klp,invoice.no_invoice,invoice.tgl_invoice,invoice.total,invoice.deskripsi')->join('detail_penjualan','detail_penjualan.id_invoice=invoice.id','left')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','pelanggan.id_kelompok=kelompok.id','left')->where('year(invoice.tgl_invoice)',$th)->where('month(invoice.tgl_invoice)',$bl)->groupBy('invoice.id');
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


	


public function detailInvoiceId($noInvoice = false)
{
    if($noInvoice == false)
    {
        $builder = $this->db->table('detail_penjualan')->select('*')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left');
        $query   = $builder->get();
        
		return $query;
    } else {
		
        $builder = $this->db->table('detail_penjualan')->select('*')->join('pelanggan','pelanggan.id=detail_penjualan.id_pelanggan','left')->join('kelompok','kelompok.id=pelanggan.id_kelompok','left')->where('detail_penjualan.id_invoice',$noInvoice);
        $query   = $builder->get();
		
		
		return $query;
	}	
if ($query->getNumRows() > 0) {
   foreach ($query->getResult() as $row) {
       $data[] = $row;
   }
   return $data;
}
return false;
}


public function getInvoiceId($id = false)
{
   
   if($id == false)
    {
        return $this->findAll();
    }
    return $this->where([ 'id' => $id ])->first();
}


public function nomorInvoice()
{

	$query = $this->db->query("SELECT max(id)+1 id FROM invoice");
	$result = ($query->getFirstRow()->id)+1;
	return $result;
}


public function nomorInvoiceKredit()
{

	$query = $this->db->query("SELECT max(id)+1 id FROM pembayaran_kredit");
	$result = ($query->getFirstRow()->id)+1;
	return $result;
}

public function insertInvoice($data)
{
    return $this->insert($data, false);
}

public function updateInvoice($id,$data)
{

return $this->update($id,$data);


}

public function hapusInvoice($id)
{

return $this->delete($id);


}

}