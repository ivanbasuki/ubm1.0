<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
<div class="row">
<div class="col-8">
<h2>Form Edit Data Komik</h2>
<form action="/komik/saveEdit ?>"  method="POST">
<?php //print_r($errors);  ?>

<div class="form-group">
      <label for="judul">Judul</label>
      <input type="hidden" id="id" name="id" value="<?= $id; ?>">

      <input type="judul" class="form-control"   name="judul" id="judul" placeholder="Judul" value="<?= $judul; ?>" autofocus>

    </div>
  <div class="invalid-feedback">
    Masukkan judul dengan benar
</div>  
    <div class="form-group">
      <label for="penerbit">Penerbit</label>
      <input type="penerbit" class="form-control" name="penerbit" id="penerbit" value="<?= $penerbit; ?>" placeholder="penerbit">
    </div>
  
  <div class="form-group">
    <label for="penulis">Penulis</label>
    <input type="text" class="form-control" name="penulis" id="penulis" value="<?= $penulis; ?>" placeholder="Nama penulis">
  </div>
  <div class="form-group">
    <label for="sampul">Gambar Sampul</label>
    <input type="text" class="form-control" name="sampul" id="sampul" value="<?= $sampul; ?>" placeholder="Gambar Sampul">
  </div>
  <button type="submit" class="btn btn-primary">Ubah</button>
</form>
</div>
</div>

</div>
<?= $this->endSection(); ?>

