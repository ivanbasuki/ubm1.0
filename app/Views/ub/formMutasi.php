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


<form method="post" action="/ub/simpanMutasi">
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
    <label for="namakk2" class="col-sm-4 col-form-label">KK Tujuan</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('namakk2') ? 'is-invalid' : '') ?>" name="namakk2" id="namakk2">
    <option value=''></option>
    <?php foreach($sahamkk as $y): ?>  
    <option value=<?php echo $y->id_kk ?>><?php echo  $y->nama_kk ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="namakk2Feedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('namakk2'); ?>
    </div>

</div>
  </div>


<div class="form-group row">
    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-6">
      <input type="nama" class="form-control <?= (\Config\Services::validation()->hasError('nama') ? 'is-invalid' : '') ?>" id="nama" name="nama" value="<?= $k->nama ?>" placeholder="Nama Lengkap">
      <div id="namaFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
    <div class="col-sm-6">
      <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?= $k->alamat; ?>" placeholder="Alamat Lengkap">
    </div>
  </div>
 
  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="hp" class="form-control" id="hp" name="hp" value="<?= $k->hp; ?>" placeholder="Nomer HP">
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Saham</label>
    <div class="col-sm-6">
      <input type="jumlah" class="form-control <?= (\Config\Services::validation()->hasError('jumlah') ? 'is-invalid' : '') ?>" id="jumlah" name="jumlah" value="<?= $k->jml_saham ?>" placeholder="Jumlah Saham" readonly>
      <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jumlah'); ?>
    </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="id_tipe" class="col-sm-4 col-form-label">Tipe Saham</label>
    <div class="col-sm-6">
      <input type="integer" class="form-control" id="id_tipe" name="id_tipe" value="<?= $k->id_tipe ?>" placeholder="Tipe Saham" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="tgl_beli" class="col-sm-4 col-form-label">Tgl Pembelian</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" placeholder="tanggal pembelian" value="<?= $k->tgl_join ?>" readonly>
    </div>
  </div>
  


 <div class="form-group row">
    <label for="tgl_mutasi" class="col-sm-4 col-form-label">Tgl Mutasi</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_mutasi') ? 'is-invalid' : '') ?>" id="tgl_mutasi" name="tgl_mutasi" value="<?= $tgl_mutasi ?>" placeholder="Tanggal Mutasi">
          <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_mutasi'); ?>
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