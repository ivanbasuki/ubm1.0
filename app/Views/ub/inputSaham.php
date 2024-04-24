<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2>Input Saham</h2>

<form method="post" action="/ub/simpanSaham">
 
<div class="form-group row">
    <label for="namakk" class="col-sm-4 col-form-label">Nama KK</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('namakk') ? 'is-invalid' : '') ?>" name="namakk" id="namakk">
    <option value=''></option>
    <?php foreach($sahamkk as $k): ?>  
    <option value=<?php echo $k->id_kk ?>><?php echo  $k->nama_kk ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="namakkFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('namakk'); ?>
    </div>

</div>
  </div>

<div class="form-group row">
    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-6">
      <input type="nama" class="form-control <?= (\Config\Services::validation()->hasError('nama') ? 'is-invalid' : '') ?>" id="nama" name="nama" value="<?= $nama; ?>" placeholder="Nama Lengkap">
      <div id="namaFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
    <div class="col-sm-6">
      <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?= $alamat; ?>" placeholder="Alamat Lengkap">
    </div>
  </div>
 
  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="hp" class="form-control" id="hp" name="hp" value="<?= $hp; ?>" placeholder="Nomer HP">
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Saham</label>
    <div class="col-sm-6">
      <input type="jumlah" class="form-control <?= (\Config\Services::validation()->hasError('jumlah') ? 'is-invalid' : '') ?>" id="jumlah" name="jumlah" value="<?= $jumlah; ?>" placeholder="Jumlah Saham">
      <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jumlah'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="id_tipe" class="col-sm-4 col-form-label">Tipe Saham</label>
    <div class="col-sm-6">
      <select id="id_tipe" name="id_tipe" class="form-select">
	  <?php if(!empty($data_tipe)){
	  foreach($data_tipe as $dt1){
	  ?>
	  <option value="<?= $dt1->id; ?>" <?php ($id_tipe==$dt1->id) ? ' selected' : ''; ?>><?= $dt1->kode_saham.'['.$dt1->harga_saham.']'; ?></option>
	  <?php
}}
	  
	  ?>
	  </select>
     <div id="idtipeFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_tipe'); ?>
    </div>
  
 </div>
  </div>

  <div class="form-group row">
    <label for="tgl_beli" class="col-sm-4 col-form-label">Tgl Pembelian</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" placeholder="Jumlah Saham">
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
    $('.form-select').select2();
});
    </script>

<?= $this->endSection(); ?>
</div>
</div>
</div>