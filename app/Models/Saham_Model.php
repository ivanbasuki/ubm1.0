<?php

namespace App\Models;

use CodeIgniter\Model;

class Saham_Model extends Model
{
    protected $table      = 'saham_anggota';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','no_kk','hp','nama','alamat','tgl_join','jml_saham','id_tipe'];
    protected $db = 'ci4';

    public function listKelompok($kodeklp = false)
    {
        if($kodeklp == false)
        {
            $builder = $this->db->table('kelompok')->select('kode_klp,nama_klp')->groupBy('kode_klp');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('kelompok')->select('kode_klp,nama_klp')->where('kode_klp',$kodeklp)->groupBy('kode_klp');
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
    




    public function dataSaham($id = false)
    {
        if($id == false)
        {
			return $this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,date_format(saham_anggota.tgl_join,"%d-%m-%Y") tgl_join,saham_anggota.alamat,saham_anggota.hp,saham_anggota.id_tipe,tipe_saham.kode_saham,tipe_saham.harga_saham,saham_anggota.jml_saham')
			->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left')
			->findAll();
		} 
			return $this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,date_format(saham_anggota.tgl_join,"%d-%m-%Y") tgl_join,saham_anggota.alamat,saham_anggota.hp,saham_anggota.id_tipe,tipe_saham.kode_saham,tipe_saham.harga_saham,saham_anggota.jml_saham')
			->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left')
			->where(['saham_anggota.id'=>$id])
			->first();
	}
	
    public function dataSahamKelompok($idkel = false)
    {
        if($idkel == false)
        {
			return $this->select('saham_kk.nama_kk,saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,date_format(saham_anggota.tgl_join,"%d-%m-%Y") tgl_join,saham_anggota.alamat,saham_anggota.hp,saham_anggota.id_tipe,tipe_saham.kode_saham,tipe_saham.harga_saham,saham_anggota.jml_saham,(tipe_saham.harga_saham*saham_anggota.jml_saham) total')
			->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left')
			->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')
			->findAll();
		} 
			return $this->select('saham_kk.nama_kk,saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,date_format(saham_anggota.tgl_join,"%d-%m-%Y") tgl_join,saham_anggota.alamat,saham_anggota.hp,saham_anggota.id_tipe,tipe_saham.kode_saham,tipe_saham.harga_saham,saham_anggota.jml_saham,(tipe_saham.harga_saham*saham_anggota.jml_saham) total')
			->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left')
			->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')
			->where(['saham_kk.id_klp'=>$idkel])
			->findAll();
	}
	

    public function listKK($idkk = false)
    {
        if($idkk == false)
        {
            $builder = $this->db->table('saham_kk')->select('id_kk,nama_kk')->groupBy('id_kk');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('saham_kk')->select('id_kk,nama_kk')->where('id_kk',$idkk)->groupBy('id_kk');
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


   public function getDataKategoriSaham() {
   
		$builder =  $this->db->table("saham_anggota")->select("sum(if(saham_anggota.jml_saham = 1,1,0)) kategori1,sum(if(saham_anggota.jml_saham > 1  and saham_anggota.jml_saham <= 5,1,0)) kategori2,sum(if((saham_anggota.jml_saham > 5 and saham_anggota.jml_saham <= 10),1,0)) kategori3,sum(if((saham_anggota.jml_saham > 10 and saham_anggota.jml_saham <= 50),1,0)) kategori4,sum(if((saham_anggota.jml_saham > 50 and saham_anggota.jml_saham <= 100),1,0)) kategori5,sum(if((saham_anggota.jml_saham > 100),1,0)) kategori6");
		$query = $builder->get();
 
 
        $record = $query->getResult();
		$kat[] = [];
		$a=1;
		foreach($record as $row) {
			$kat[1] = (int)$row->kategori1;
			$kat[2] = (int)$row->kategori2;
			$kat[3] = (int)$row->kategori3;
			$kat[4] = (int)$row->kategori4;
			$kat[5] = (int)$row->kategori5;
			$kat[6] = (int)$row->kategori6;
        }
		

		$data = [];
		$ket = ['','Saham 1 Unit','Saham 2-5','Saham 6-10','Saham 11-50','Saham 51-100','Saham > 100'];
		
		
		$loop=1;
        while($loop <= 6)
		{
				$data[] = [$ket[$loop],$kat[$loop]];
		$loop++;
		}	
		
		
        $data1 = json_encode($data);
		return $data1;
    }


   public function getDataChartBar()
   {
	   
	   	
		$builder =  $this->select('kelompok.nama_klp,count(distinct saham_kk.id_kk) kk,count(saham_anggota.id) jiwa,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp')->groupBy('kelompok.id');
		$query = $builder->get();
 
        $record = $query->getResult();
        $data = [];
 
	$name[] = 'kk';
	$name[] = 'jiwa';
	$name[] = 'saham';
	
	

        foreach($record as $row) {
            
			$data_jiwa[] = (int)$row->jiwa;
			$data_saham[] = (int)$row->saham;
			$data_kk[] = (int)$row->kk;
			
		    $data_categories[] = $row->nama_klp;	
        }

		// object
		$dc1['name'] = 'jiwa';
		$dc1['data'] = $data_jiwa;
		// object 
		$dc2['name'] = 'saham';
		$dc2['data'] = $data_saham;
		// object 
		$dc3['name'] = 'kk';
		$dc3['data'] = $data_kk;
	 
	$dataobj = [$dc3,$dc1,$dc2];
	//$gdc = [$dc1,$dc2];

     $data  = [
	 'title' => 'Chart Kepemilikan Saham Per Jiwa',
	 'deskripsi' => 'Gambaran kepemilikan Saham Kelompok per Jiwa',
	 'categories' => $data_categories,
	 'chart_data' => $dataobj ];
	 
	 
	 //$data = json_encode($data);
		return $data;
   
	   
   }	   


   public function getDataChart3dDonut()
   {
	   
	   	
		$builder =  $this->select('kelompok.nama_klp,sum(saham_anggota.jml_saham) saham')->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp')->groupBy('kelompok.id');
		$query = $builder->get();
 
        $record = $query->getResult();
        $data = [];
 
		$name[] = 'saham';
	
	/*
	[{
        name: 'Medals',
        data: [
            ['Norway', 16],
            ['Germany', 12],
            ['USA', 8],
            ['Sweden', 8],
            ['Netherlands', 8],
            ['ROC', 6],
            ['Austria', 7],
            ['Canada', 4],
            ['Japan', 3]

        ]
    }]
	*/
	

        foreach($record as $row) {
            
			$data_kelompok[] = [$row->nama_klp,(int)$row->saham];
        }

	$dataobj['name'] = 'Saham';
	$dataobj['data'] = $data_kelompok;
	$datagab[] = $dataobj;
	
 $data  = [
	 'title' => 'Chart Kepemilikan Saham Per Jiwa',
	 'deskripsi' => 'Gambaran kepemilikan Saham Kelompok per Jiwa',
	 'chart_data' => $datagab ];
	 
	 
	 //$data = json_encode($data);
		return $data;
   
	   
   }	   


 
   public function dataSahamId($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('saham_anggota')->select('*');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('saham_anggota')->select('*')->where('id',$id);
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
 
 
    public function listAnggota($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('saham_anggota')->select('saham_anggota.id,saham_anggota.nama,saham_anggota.hp,kelompok.nama_klp,saham_kk.id_klp')->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp','left');

            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('saham_anggota')->select('saham_anggota.id,saham_anggota.nama,saham_anggota.hp,kelompok.nama_klp,saham_kk.id_klp')->join('saham_kk','saham_kk.id_kk=saham_anggota.no_kk','left')->join('kelompok','kelompok.id=saham_kk.id_klp','left')->where('saham_anggota.id',$id);
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



    public function daftarSaham($id = false)
    {
        if($id == false)
        {
            $builder = $this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,tipe_saham.kode_saham,tipe_saham.harga_saham')->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left');
			
            $query   = $builder->get();
        } else
            {
                $builder = $this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,tipe_saham.kode_saham,tipe_saham.harga_saham')->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left')->where('saham_anggota.id',$id);
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


public function memberSaham($nokk = false)
{
    if($nokk == false)
    {
        $this->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left');
		$this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,tipe_saham.harga_saham,saham_anggota.id_tipe,saham_anggota.tgl_join,tipe_saham.harga_saham');
		
		return $this->findAll();
    }
            $this->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe','left');
		$this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,tipe_saham.harga_saham,saham_anggota.id_tipe,saham_anggota.tgl_join,tipe_saham.harga_saham');

	return $this->where([ 'no_kk' => $nokk ])->first();
}


public function getSahamId($id = false)
{
    if($id == false)
    {
        $this->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe');
		$this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,saham_anggota.id_tipe,saham_anggota.tgl_join,tipe_saham.harga_saham');
		return $this->findAll();
    }
    
		$this->join('tipe_saham','tipe_saham.id=saham_anggota.id_tipe');
		$this->select('saham_anggota.id,saham_anggota.no_kk,saham_anggota.nama,saham_anggota.alamat,saham_anggota.hp,saham_anggota.jml_saham,saham_anggota.id_tipe,saham_anggota.tgl_join,tipe_saham.harga_saham');

		return $this->where([ 'saham_anggota.id' => $id ])->first();
}



public function insertSaham($data)
{
    return $this->insert($data, false);
}

public function updateSahamId($id,$data)
{
   return $this->update($id,$data);
}



public function hapusSaham($id)
{
   return $this->delete($id);
}


public function hapusTableSaham()
{
   return $this->emptyTable();
}

}