<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 20px">
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
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
                    <th scope="col">NO BAYAR</th>
					<th scope="col">TGL BAYAR</th>
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
                      <td><?php echo $p->no_bayar ?></td>
					  <td><?php echo $p->tgl_bayar ?></td>
                      
					  <td><?php echo number_format($p->jumlah_bayar) ?></td>
                      <td><?php echo $p->keterangan ?></td>
					  <td class="text-center">
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
