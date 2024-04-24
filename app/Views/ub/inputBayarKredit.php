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
	  
<h2>DATA TAGIHAN</h2>

<form method="post" action="/ub/simpanBayarKredit">
 
<?php
if(!empty($data_kredit)){
foreach($data_kredit as $dk){
?>	
<div class="form-group row">
    <label for="id_kredit" class="col-sm-4 col-form-label">ID Pembiayaan</label>
    <div class="col-sm-6">
	<input type="text" class="form-control" name="id_kredit" id="id_kredit" value="<?= $dk->id ?>" readonly></input>
	<input type="hidden" class="form-control" name="sisa_bayar" id="sisa_bayar" value="<?= $sisa_bayar ?>"></input>

</div>
  </div>

<div class="form-group row">
    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $dk->nama_barang; ?>" placeholder="Nama Barang" readonly>
    </div>
  </div>


<div class="form-group row">
    <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tgl Transaksi</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?= $dk->tgl_transaksi; ?>" placeholder="Tanggal TRansaksi" readonly>
    </div>
  </div>


  <div class="form-group row">
    <label for="angsuran" class="col-sm-4 col-form-label">Angsuran</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control" id="angsuran" name="angsuran" value="<?= $dk->angsuran; ?>" placeholder="Angsuran" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="tenor" class="col-sm-4 col-form-label">Tenor</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control" id="tenor" name="tenor" value="<?= $dk->tenor; ?>" placeholder="Tenor" readonly>
    </div>
  </div>


<?php
}}
//endforeach;
//endif;
?>

 
  <div class="form-group row">
    <div class="col-sm-6">

<h2><?= $title ?></h2>
</div>
  </div>

  <div class="form-group row">
    <label for="no_bayar" class="col-sm-4 col-form-label">No Kuitansi</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('no_bayar') ? 'is-invalid' : '') ?>" id="no_bayar" name="no_bayar" value="<?= $no_bayar; ?>" placeholder="Nomor Bayar">
          <div id="nobayarpenjualanFeedback" class="invalid-feedback">
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
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Bayar</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('jumlah') ? 'is-invalid' : '') ?>" id="jumlah" name="jumlah" value="<?= $jumlah; ?>" placeholder="Jumlah Bayar">
          <div id="jmlbayarpenjualanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jumlah'); ?>
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