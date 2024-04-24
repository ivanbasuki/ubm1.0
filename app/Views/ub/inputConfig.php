<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/simpanConfig">
<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="ub/">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
   
  <input type="hidden" name="id" id="id"></input>


  <div class="form-group row">
    <label for="kode" class="col-sm-4 col-form-label">Kode</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('kode') ? 'is-invalid' : '') ?>" id="kode" name="kode" value="<?= $kode; ?>" placeholder="Kode">
      <div id="kodeFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('kode'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="nama_kode" class="col-sm-4 col-form-label">Nama Kode</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_kode') ? 'is-invalid' : '') ?>" id="nama_kode" name="nama_kode" value="<?= $nama_kode; ?>" placeholder="Nama Kode">
      <div id="kodeFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_kode'); ?>
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
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>