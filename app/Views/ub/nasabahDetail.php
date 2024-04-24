<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 15px">
  <div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	      
	  
	  
	  <div class="row">

<div class="col-md-3">

			  <a href="<?php echo base_url() ?>ub/tambahNasabah" class="btn btn-md btn-success" style="margin-bottom: 10px">INPUT Nasabah</a>
             <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>

</div>

</div>
<div class="col-md-2">
                
    <input type="hidden" name="_method" value="beli"></input>
 
</div>
<div class="col-md-2">

</div>


        <div class="col-md-12">
          <div class="card">
            
			<div class="card-header">
              <?= $title ?>
            </div>
            
			<div class="card-body">
              
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">TGL TRANSAKSI</th>
                    
					<th scope="col">NAMA</th>
                    <th scope="col">NAMA BARANG</th>
                    <th scope="col">ANGSURAN</th>
					<th scope="col">PIUTANG</th>
					<th scope="col">TERBAYAR</th>
					<th scope="col">SISA</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_nasabah)){
                    $sisa = 0;
					$piutang = 0;
					foreach($data_nasabah as $p){
                      $piutang = $p->angsuran * $p->tenor;
					  $sisa = $piutang - $p->terbayar;
				  ?>

                  <tr>
                      <td><?= $no++ ?></td>
  <td><?php echo $p->tgl_transaksi ?></td>
                                        
					<td><?php echo $p->nama_pelanggan ?></td>
                      <td><?php echo $p->nama_barang ?></td>
                      <td><?php echo number_format($p->angsuran) ?></td>
					  <td><?php echo number_format($piutang) ?></td>
					  <td><?php echo number_format($p->terbayar) ?></td>
					  <td><?php echo number_format($sisa) ?></td>
					 
					 
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editNasabah/<?= $p->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url() ?>ub/hapusNasabah/<?= $p->id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data Nasabah?')">Delete</button>

  </form>
                      </td>
                  </tr>
                <?php }
                } ?>
                </tbody>
              </table>

            </div>
          </div>
      </div>
    </div>
<script>
$().ready(function(){
  var bln=$('#xbulan').val();
  var thn=$('#xtahun').val();
  $('#bulan').val(bln);
  $('#tahun').val(thn);
  $('#bulan').trigger('change');
  $('#tahun').trigger('change');
  
})

</script>
<?= $this->endSection(); ?>
