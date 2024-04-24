<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 20px">
      <div class="row">
       
		<div class="col-md-3">
			  <a href="<?php echo base_url() ?>ub/tambahInvoice/<?= $bulan ?>/<?= $tahun ?>/<?= $idkel ?>" class="btn btn-md btn-success" style="margin-bottom: 10px">BUAT INVOICE</a>
              <form method="post" action="<?php echo base_url() ?>ub/invoiceKelompokBulanan" class="d-inline">
    <input type="hidden" name="_method" value="jual"></input>
    <input type="hidden" name="xid" id="xid" value="<?= $idkel ?>"></input>
    <input type="hidden" name="xbulan" id="xbulan" value="<?= $bulan ?>"></input>
    <input type="hidden" name="xtahun" id="xtahun" value="<?= $tahun ?>"></input>

		</div>

		<div class="col-md-2">

			  <select name="kelompok" id="kelompok" class="form-select">
              <option></option>
			  <?php 
              $a=0;
              if(!empty($data_kelompok)){
              foreach($data_kelompok as $x){
                
               ?>  
              <option value="<?= $x['id'] ?>" <?= ($x['id']==$idkel) ? ' selected':'' ?>><?php echo $x['nama_klp'] ?></option>
              <?php
            $a++;
            } }?>
              </select>  
		</div>

		<div class="col-md-2">

			  <select name="bulan" id="bulan" class="form-select">
              <option></option>
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
              <option></option>
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
        
              <button id="jual" type="submit" class="btn btn-info" >Report</button>
</form>		
		</div>

		

		
		
		<div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?= $title ?>
            </div>
              <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>
            <div class="card-body">

              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
 

					<th scope="col">NO.</th>
                    <th scope="col">TGL</th>
                    <th scope="col">NO INVOICE</th>
                    <th scope="col">KELOMPOK</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_invoice)){
                    foreach($data_invoice as $p){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?php echo $p->tgl_invoice ?></td>
                      <td><?php echo $p->no_invoice ?></td>
                      <td><?php echo $p->nama_klp ?></td>
                      <td><?php echo number_format($p->total) ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/InvoiceDetail/<?= $p->id ?>" class="btn btn-sm btn-primary">DETAIL</a>

                        <a href="<?php echo base_url() ?>ub/editInvoice/<?= $p->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url() ?>ub/hapusInvoice/<?= $p->id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data Invoice?')">Delete</button>
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
