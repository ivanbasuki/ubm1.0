<?php

namespace App\Models;
use CodeIgniter\Model;

class Pengeluaran_Model extends Model
{
    protected $table      = 'pengeluaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_pos','tgl_transaksi','deskripsi','jumlah'];

    public function listPengeluaran($bl = false, $th = false)
    {
        if($bl == false && $th == false)
        {
            $builder = $this->select('pengeluaran.id,pengeluaran.deskripsi,pengeluaran.tgl_transaksi,pengeluaran.jumlah,pos_pengeluaran.nama_pos,kas.nama_kas')->join('pos_pengeluaran','pos_pengeluaran.id=pengeluaran.id_pos','left')->join('kas','kas.id=pengeluaran.id_kas','left');
			
            $query   = $builder->get();
             } else
            {
				$builder = $this->select('pengeluaran.id,pengeluaran.deskripsi,pengeluaran.tgl_transaksi,pengeluaran.jumlah,pos_pengeluaran.nama_pos,kas.nama_kas')->join('pos_pengeluaran','pos_pengeluaran.id=pengeluaran.id_pos','left')->join('kas','kas.id=pengeluaran.id_kas','left')->where('year(pengeluaran.tgl_transaksi)',$th)->where('month(pengeluaran.tgl_transaksi)',$bl);
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
 
 
    public function dataPengeluaran()
    {
			return $this->select('id_pos,deskripsi,tgl_transaksi,jumlah')->findAll();
	}
 
 
 /*
     series: [{
        name: 'Installation & Developers',
        data: [43934, 48656, 65165, 81827, 112143, 142383,
            171533, 165174, 155157, 161454, 154610]
    }, {
        name: 'Manufacturing',
        data: [24916, 37941, 29742, 29851, 32490, 30282,
            38121, 36885, 33726, 34243, 31050]
    }, {
        name: 'Sales & Distribution',
        data: [11744, 30000, 16005, 19771, 20185, 24377,
            32147, 30912, 29243, 29213, 25663]
    }, {
        name: 'Operations & Maintenance',
        data: [null, null, null, null, null, null, null,
            null, 11164, 11218, 10077]
    }, {
        name: 'Other',
        data: [21908, 5548, 8105, 11248, 8989, 11816, 18274,
            17300, 13053, 11906, 10073]
    }],
*/
 
 
    public function getDataChartLine($th = false)
    {
        $datagab=[];
		if($th == false)
        {
            if($th == false) { $th = date('Y'); }
				$builder = $this->select("pos_pengeluaran.nama_pos,sum(case when month(pengeluaran.tgl_transaksi)='01' then pengeluaran.jumlah else 0  end) januari,sum(case when month(pengeluaran.tgl_transaksi)='02' then pengeluaran.jumlah else 0  end) februari,sum(case when month(pengeluaran.tgl_transaksi)='03' then pengeluaran.jumlah else 0  end) maret,sum(case when month(pengeluaran.tgl_transaksi)='04' then pengeluaran.jumlah else 0  end) april,sum(case when month(pengeluaran.tgl_transaksi)='05' then pengeluaran.jumlah else 0  end) mei,sum(case when month(pengeluaran.tgl_transaksi)='06' then pengeluaran.jumlah else 0  end) juni,sum(case when month(pengeluaran.tgl_transaksi)='07' then pengeluaran.jumlah else 0  end) juli,sum(case when month(pengeluaran.tgl_transaksi)='08' then pengeluaran.jumlah else 0  end) agustus,sum(case when month(pengeluaran.tgl_transaksi)='09' then pengeluaran.jumlah else 0  end) september,sum(case when month(pengeluaran.tgl_transaksi)='10' then pengeluaran.jumlah else 0  end) oktober,sum(case when month(pengeluaran.tgl_transaksi)='11' then pengeluaran.jumlah else 0  end) nopember,sum(case when month(pengeluaran.tgl_transaksi)='12' then pengeluaran.jumlah else 0  end) desember")->join("pos_pengeluaran","pos_pengeluaran.id=pengeluaran.id_pos","left")->where("year(pengeluaran.tgl_transaksi)",$th)->groupBy("pengeluaran.id_pos");
				$query   = $builder->get();
             } else
            {
				$builder = $this->select("pos_pengeluaran.nama_pos,sum(case when month(pengeluaran.tgl_transaksi)='01' then pengeluaran.jumlah else 0 end) januari,sum(case when month(pengeluaran.tgl_transaksi)='02' then pengeluaran.jumlah else 0 end) februari,sum(case when month(pengeluaran.tgl_transaksi)='03' then pengeluaran.jumlah else 0 end) maret,sum(case when month(pengeluaran.tgl_transaksi)='04' then pengeluaran.jumlah else 0 end) april,sum(case when month(pengeluaran.tgl_transaksi)='05' then pengeluaran.jumlah else 0 end) mei,sum(case when month(pengeluaran.tgl_transaksi)='06' then pengeluaran.jumlah else 0 end) juni,sum(case when month(pengeluaran.tgl_transaksi)='07' then pengeluaran.jumlah else 0 end) juli,sum(case when month(pengeluaran.tgl_transaksi)='08' then pengeluaran.jumlah else 0 end) agustus,sum(case when month(pengeluaran.tgl_transaksi)='09' then pengeluaran.jumlah else 0 end) september,sum(case when month(pengeluaran.tgl_transaksi)='10' then pengeluaran.jumlah else 0 end) oktober,sum(case when month(pengeluaran.tgl_transaksi)='11' then pengeluaran.jumlah else 0 end) nopember,sum(case when month(pengeluaran.tgl_transaksi)='12' then pengeluaran.jumlah else 0 end) desember")->join("pos_pengeluaran","pos_pengeluaran.id=pengeluaran.id_pos","left")->where("year(pengeluaran.tgl_transaksi)",$th)->groupBy("pengeluaran.id_pos");
				$query   = $builder->get();
            } 
       $record = $query->getResult();
       foreach ($record as $row) {
				$datax['name']=$row->nama_pos;
				$datax['data']=[(int)$row->januari,(int)$row->februari,(int)$row->maret,(int)$row->april,(int)$row->mei,(int)$row->juni,(int)$row->juli,(int)$row->agustus,(int)$row->september,(int)$row->oktober,(int)$row->nopember,(int)$row->desember];
				$datagab[] = $datax;
		}
 
 $data  = [
	 'title' => 'Chart Pengeluaran',
	 'deskripsi' => 'Gambaran Pengeluaran UB',
	 'chart_data' => $datagab ];


	
	return $data;
	

 }
 



    public function getPengeluaran($id = false)
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
 
    public function getDataPos()
    {
            $builder = $this->db->table('pos_pengeluaran')->select('*');
            $query   = $builder->get();
			if ($query->getNumRows() > 0) {
				foreach ($query->getResult() as $row) {
				$data[] = $row;
				}
			}	
	   return $data;
    }

    
public function insertPengeluaran($data)
{
    return $this->insert($data, false);
}

public function updatePengeluaran($id,$data)
{
   return $this->update($id,$data);
}

public function hapusPengeluaran($id)
{
   return $this->delete($id);
}

}