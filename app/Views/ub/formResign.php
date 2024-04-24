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
	  
<h2><?= $title ?></h2>
<?php
if(!empty($data_saham)){
	foreach($data_saham as $k){
		$idkk = $k->no_kk;
		?>


<form method="post" action="/ub/simpanResign">
      <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>">
 
<div class="form-group row">
    <label for="namakk1" class="col-sm-4 col-form-label">KK Asal</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('namakk1') ? 'is-invalid' : '') ?>" name="namakk1" id="namakk1" readonly>
    <option value=''></option>
    <?php foreach($sahamkk as $x): ?>  
    <option value=<?php echo $x->id_kk ?><?= ($x->id_kk == $idkk) ? ' selected' : '' ?> ><?php echo  $x->nama_kk ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="namakkFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('namakk1'); ?>
    </div>

</div>
  </div>


<div class="form-group row">
    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-6">
      <input type="nama" class="form-control" id="nama" name="nama" value="<?= $k->nama ?>" placeholder="Nama Lengkap" readonly>
</div>
  </div>

  <div class="form-group row">
    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
    <div class="col-sm-6">
      <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?= $k->alamat; ?>" placeholder="Alamat Lengkap" readonly>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="hp" class="form-control" id="hp" name="hp" value="<?= $k->hp; ?>" placeholder="Nomer HP" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Saham</label>
    <div class="col-sm-6">
      <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $k->jml_saham ?>" placeholder="Jumlah Saham" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="harga" class="col-sm-4 col-form-label">Harga Saham</label>
    <div class="col-sm-6">
      <input type="integer" class="form-control" id="harga" name="harga" value="<?= $k->harga_saham ?>" placeholder="Harga Saham" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="tgl_beli" class="col-sm-4 col-form-label">Tgl Pembelian</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" placeholder="tanggal pembelian" value="<?= $k->tgl_join ?>" readonly>
    </div>
  </div>
  


 <div class="form-group row">
    <label for="tgl_mutasi" class="col-sm-4 col-form-label">Tgl Resign</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_resign') ? 'is-invalid' : '') ?>" id="tgl_resign" name="tgl_resign" value="<?= $tgl_resign ?>" placeholder="Tanggal Resign">
          <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_resign'); ?>
    </div>

	</div>
  </div>

<div class="form-group row">
    <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('alasan') ? 'is-invalid' : '') ?>" id="alasan" name="alasan" value="<?= $alasan ?>" placeholder="Alasan">
      <div id="alasanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('alasan'); ?>
    </div>

    </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>
<?php
}}
?>

<script>
  $(document).ready(function() {
	  $("#namakk1 option").not(":selected").attr("disabled", "disabled");

    $('.form-select').select2();
});
    </script>

<?= $this->endSection(); ?>
</div>
</div>
</div>