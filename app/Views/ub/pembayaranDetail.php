<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 20px">
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	  

      <div class="row">
       
		<div class="col-md-3">
    <form method="post" action="<?php echo base_url() ?>ub/PostingBayar" class="d-inline">
    <input type="hidden" name="_method" value="jual"></input>
    <input type="hidden" name="xbulan" id="xbulan" value="<?= $bulan ?>"></input>
    <input type="hidden" name="xtahun" id="xtahun" value="<?= $tahun ?>"></input>
<label>Bulan</label>
		</div>

		<div class="col-md-2">

			  <select name="bulan" id="bulan" class="form-select">
              <?php 
              $a=0;
              if(!empty($data_bulan)){
              foreach($data_bulan as $x => $y){
                
               ?>  
              <option value="<?= $x ?>" <?= ($x==$bulan) ? ' selected':'' ?>><?php echo $y ?></option>
              <?php
            $a++;
            } }?>
              </select>  
		</div>

		<div class="col-md-2">
              <select name="tahun" id="tahun" class="form-select">
              <?php 
              $b=0;
              while($b < count($data_tahun)){
              
               ?>  
              <option <?= ($data_tahun[$b]==$bulan) ? ' selected':'' ?>><?php echo $data_tahun[$b] ?></option>
              <?php
            $b++;
            } ?>
              </select>  
        
		</div>
		<div class="col-md-2">
        
              <button id="jual" type="submit" class="btn btn-info" >Generate</button>
</form>		
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
                    <th scope="col">NO INVOICE</th>
					<th scope="col">TGL INVOICE</th>
                    <th scope="col">NILAI INVOICE</th>
                    <th scope="col">KETERANGAN</th>
                    <th scope="col">NO KUITANSI</th>

                    <th scope="col">TOTAL BAYAR</th>
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
                      <td><?php echo $p->no_invoice ?></td>
					  <td><?php echo $p->tgl_invoice ?></td>
                      
					  <td><?php echo number_format($p->total) ?></td>
                      <td><?php echo $p->deskripsi ?></td>
					  <td><?php echo $p->no_bayar ?></td>
					  
					  <td><?php echo $p->jumlah_bayar ?></td>
					  
                      <?php 
					$sisa_bayar = 0;	
					if($p->jumlah_bayar == $p->total)
					  {  
				   ?>
				  <td class="text-center">
				<a href="<?php echo base_url() ?>ub/detailBayar/<?= $p->id ?>" class="btn btn-sm btn-info">LUNAS</a>
				</td>	  
					  <?php } else {
$sisa_bayar = $p->total-$p->jumlah_bayar;
				 
						  ?>	  
					  <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/createBayar/<?= $p->id ?>/<?= $sisa_bayar ?>" class="btn btn-sm btn-warning">BAYAR</a>
                        
 
                      </td>
					  <?php  } ?>
					  
					  
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
