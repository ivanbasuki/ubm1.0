<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/simpanPOSD">
<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="ub/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Input POS Debet</li>
                        </ol>
   
  <input type="hidden" name="id" id="id"></input>


  <div class="form-group row">
    <label for="nama_posd" class="col-sm-4 col-form-label">Nama POS</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_POSD') ? 'is-invalid' : '') ?>" id="nama_POSD" name="nama_POSD" value="<?= $nama_POSD; ?>" placeholder="Nama POS Pemasukan">
      <div id="POSDFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_POSD'); ?>
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