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
                    
					<th scope="col">NO KUITANSI</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">KETERANGAN</th>
                    <th scope="col">AKSI</th>

                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_bayar)){
					foreach($data_bayar as $p){
				  ?>

                  <tr>
                      <td><?= $no++ ?></td>
  <td><?php echo $p->tgl_bayar ?></td>
                                        
					<td><?php echo $p->no_bayar ?></td>
                      <td><?php echo $p->jumlah ?></td>
                      <td><?php echo $p->keterangan ?></td>
					  <td><a OnClick="window.open('<?php echo base_url('PdfController/htmlToPDFKuitansi/'.$p->id) ?>','_blank')"><i class="fa fa-print"></i></a></td>
					  
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
