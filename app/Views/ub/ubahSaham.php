<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/updateSaham">
 

<?php
//if(!empty($data_lama))
//{ foreach($data_lama as $dt){
?>	
  <div class="form-group row">
    <label for="id" class="col-sm-4 col-form-label">No Seri</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="id" name="id" value="<?= $data_lama['id']; ?>" placeholder="Nomer Seri" readonly>
      
    </div>
  </div>


  <div class="form-group row">
    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-6">
      <input type="nama" class="form-control" id="nama" name="nama" value="<?= $data_lama['nama']; ?>" placeholder="Nama Lengkap">
    </div>
  </div>

  <div class="form-group row">
    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
    <div class="col-sm-6">
      <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?= $data_lama['alamat']; ?>" placeholder="Alamat Lengkap">
    </div>
  </div>
 
  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="hp" class="form-control" id="hp" name="hp" value="<?= $data_lama['hp']; ?>" placeholder="Nomer HP">
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Saham</label>
    <div class="col-sm-6">
      <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $data_lama['jml_saham']; ?>" placeholder="Jumlah Saham">
      
    </div>
  </div>
  <div class="form-group row">
    <label for="id_tipe" class="col-sm-4 col-form-label">Tipe Saham</label>
    <div class="col-sm-6">
      <select id="id_tipe" name="id_tipe" class="form-select">
	  <?php if(!empty($data_tipe)){
	  foreach($data_tipe as $dt1){
	  ?>
	  <option value="<?= $dt1->id ?>" <?php ($dt1->id==$data_lama['id_tipe']) ? ' selected' : ''; ?>><?= $dt1->kode_saham.'['.$dt1->harga_saham.']'; ?></option>
	  <?php
}}
	  
	  ?>
	  </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="tgl_beli" class="col-sm-4 col-form-label">Tgl Pembelian</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" value="<?= $data_lama['tgl_join'] ?>" placeholder="Tgl Beli" readonly>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
  </div>
<?php  ?>
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