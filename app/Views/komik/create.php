<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
<div class="row">
<div class="col-8">
<h2>Form Input Data Komik</h2>
<form action="/ub/save"  method="POST">
<?= \Config\Services::validation()->listErrors();  ?>

<div class="form-group">
      <label for="judul">Judul</label>
      <input type="judul" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>"  name="judul" id="judul" placeholder="Judul" autofocus>

    </div>
  <div class="invalid-feedback">
    Masukkan judul dengan benar
</div>  
    <div class="form-group">
      <label for="penerbit">Penerbit</label>
      <input type="penerbit" class="form-control" name="penerbit" id="penerbit" placeholder="penerbit">
    </div>
  
  <div class="form-group">
    <label for="penulis">Penulis</label>
    <input type="text" class="form-control" name="penulis" id="penulis" placeholder="Nama penulis">
  </div>
  <div class="form-group">
    <label for="sampul">Gambar Sampul</label>
    <input type="text" class="form-control" name="sampul" id="sampul" placeholder="Gambar Sampul">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
</div>

</div>
<?= $this->endSection(); ?>

