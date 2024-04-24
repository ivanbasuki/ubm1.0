<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/simpanProdukPembiayaan">
 

  <input type="hidden" name="id" id="id"></input>

<div class="form-group row">
    <label for="tgl_penjualan" class="col-sm-4 col-form-label">Nama Barang</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_barang') ? 'is-invalid' : '') ?>" id="nama_barang" name="nama_barang" value="<?= $nama_barang; ?>" placeholder="Nama Barang">
      <div id="namaFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_barang'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="harga_jual" class="col-sm-4 col-form-label">Harga Jual</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('harga_jual') ? 'is-invalid' : '') ?>" id="harga_jual" name="harga_jual" value="<?= $harga_jual; ?>" placeholder="Harga Jual">
      <div id="jualFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('harga_jual'); ?>
    </div>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="harga_pokok" class="col-sm-4 col-form-label">Harga Pokok</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('harga_pokok') ? 'is-invalid' : '') ?>" id="harga_pokok" name="harga_pokok" value="<?= $harga_pokok; ?>" placeholder="Harga Jual">
      <div id="pokokFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('harga_pokok'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="dp" class="col-sm-4 col-form-label">Uang Muka</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control" id="dp" name="dp" value="<?= $dp; ?>" placeholder="Uang Muka">
    </div>
  </div>

  <div class="form-group row">
    <label for="angsuran" class="col-sm-4 col-form-label">Angsuran</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('angsuran') ? 'is-invalid' : '') ?>" id="angsuran" name="angsuran" value="<?= $angsuran; ?>" placeholder="Angsuran">
      <div id="pokokFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('angsuran'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="tenor" class="col-sm-4 col-form-label">Tenor</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('tenor') ? 'is-invalid' : '') ?>" id="tenor" name="tenor" value="<?= $tenor; ?>" placeholder="Tenor">
      <div id="tenorFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tenor'); ?>
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
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>