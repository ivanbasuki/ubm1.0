<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	  
<h2>DATA INVOICE</h2>

<form method="post" action="/ub/simpanBayar">
 
 
<div class="form-group row">
    <label for="id_invoice" class="col-sm-4 col-form-label">ID Invoice</label>
    <div class="col-sm-6">
	<input type="text" class="form-control" name="id_invoice" id="id_invoice" value="<?= $data_invoice['id'] ?>" readonly></input>
	<input type="hidden" class="form-control" name="sisa_bayar" id="sisa_bayar" value="<?= $sisa_bayar ?>"></input>

</div>
  </div>

<div class="form-group row">
    <label for="no_invoice" class="col-sm-4 col-form-label">No Invoice</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?= $data_invoice['no_invoice']; ?>" placeholder="Nomor Invoice" readonly>
    </div>
  </div>


<div class="form-group row">
    <label for="tgl_invoice" class="col-sm-4 col-form-label">Tgl Invoice</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_invoice" name="tgl_invoice" value="<?= $data_invoice['tgl_invoice']; ?>" placeholder="Tanggal Invoice" readonly>
    </div>
  </div>


  <div class="form-group row">
    <label for="total" class="col-sm-4 col-form-label">Total</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control" id="total" name="total" value="<?= $data_invoice['total']; ?>" placeholder="Total Tagihan" readonly>
    </div>
  </div>

<?php
//endforeach;
//endif;
?>

  <div class="form-group row">
    <label for="deskripsi" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $data_invoice['deskripsi']; ?>" placeholder="Deskripsi Invoice" readonly>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-6">

<h2><?= $title ?></h2>
</div>
  </div>

  <div class="form-group row">
    <label for="no_bayar" class="col-sm-4 col-form-label">No Kuitansi</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('no_bayar') ? 'is-invalid' : '') ?>" id="no_bayar" name="no_bayar" value="<?= $no_bayar; ?>" placeholder="Nomor Bayar">
          <div id="tglbayarpenjualanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('no_bayar'); ?>
    </div>
	</div>
  </div>



  <div class="form-group row">
    <label for="tgl_bayar" class="col-sm-4 col-form-label">Tgl Bayar</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_bayar') ? 'is-invalid' : '') ?>" id="tgl_bayar" name="tgl_bayar" value="<?= $tgl_bayar; ?>" placeholder="Tgl Bayar">
          <div id="tglbayarpenjualanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_bayar'); ?>
    </div>
	</div>
  </div>

<?php
if($sisa_bayar > 0){
?>
  <div class="form-group row">
    <label for="kurang_bayar" class="col-sm-4 col-form-label">Kekurangan Bayar</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control" id="kurang_bayar" name="kurang_bayar" value="<?= $sisa_bayar; ?>" placeholder="Kurang Bayar" readonly>
    </div>
  </div>
<?php
}
?>	


  <div class="form-group row">
    <label for="jml_bayar" class="col-sm-4 col-form-label">Jumlah Bayar</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('jml_bayar') ? 'is-invalid' : '') ?>" id="jml_bayar" name="jml_bayar" value="<?= $jml_bayar; ?>" placeholder="Jumlah Bayar">
          <div id="jmlbayarpenjualanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jml_bayar'); ?>
    </div>
	</div>
  </div>

  <div class="form-group row">
    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-6">
      <input type="keterangan" class="form-control <?= (\Config\Services::validation()->hasError('keterangan') ? 'is-invalid' : '') ?>" id="keterangan" name="keterangan" value="<?= $keterangan; ?>" placeholder="Keterangan">
          <div id="keteranganFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('keterangan'); ?>
    </div>
	</div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
       var kurang_bayar = $('#kurang_bayar').val();
	   $('#jml_bayar').on('change',function(){
			var a=$('#jml_bayar').val();
			if(a >= kurang_bayar)
			  { 
		  alert('Input Terlalu banyak');
		  $('#jml_bayar').val(kurang_bayar);
		  }
	   });
	   
	   
	   
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>