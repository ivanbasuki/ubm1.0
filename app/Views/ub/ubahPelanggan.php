<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/ubahPelanggan">
 

  <input type="hidden" name="id" id="id" value="<?= $pelanggan['id'] ?>"></input>
  <input type="hidden" name="idkel" id="idkel" value="<?= $pelanggan['id_kelompok'] ?>"></input>

  <div class="form-group row">
    <label for="id_kelompok" class="col-sm-4 col-form-label">Nama Kelompok</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('id_kelompok') ? 'is-invalid' : '') ?>" name="id_kelompok" id="id_kelompok">
    <option value=''></option>
    <?php foreach($data_kelompok as $kel): ?>  
    <option value="<?php echo $kel['id'] ?>"><?php echo  $kel['nama_klp'] ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="idFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_kelompok'); ?>
    </div>

</div>
  </div>

  <div class="form-group row">
    <label for="nama_pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_pelanggan') ? 'is-invalid' : '') ?>" id="nama_pelanggan" name="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>" placeholder="Nama Lengkap">
      <div id="namaFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_pelanggan'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="hp" name="hp" value="<?= $pelanggan['hp']; ?>" placeholder="Alamat Lengkap">
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
    var idkel= $('#idkel').val(); 
    $('#id_kelompok').val(idkel);
     
     $('#id_kelompok').trigger('change');
    $('#id_kelompok').select2();
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>