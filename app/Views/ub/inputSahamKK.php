<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-8">
<h2>Input Saham KK</h2>

<form method="post" action="/ub/simpanSahamKK">
 
<table class="table">
<div class="form-group row">
    <label for="kelompok" class="col-sm-4 col-form-label">Nama Kelompok</label>
    <div class="col-sm-6">
    <select class="form-select form-select-lg mb-3" name="kelompok" id="kelompok">
    <?php foreach($kelompok as $k): ?>  
    <?php $no = str_pad($k->jumlah++,3,'0',STR_PAD_LEFT);
     ?>
      <option value=<?php echo $k->prefix_kk.$no."_".$k->kode_klp; ?>
      <?= ($k->kode_klp == $id_klp) ? 'selected' : '' ?>
      ><?php echo  $k->nama_klp ?></option>
     <?php endforeach ?>  
  </select>    
    </div>
  </div>

<div class="form-group row">
    <label for="namakk" class="col-sm-4 col-form-label">Nama KK</label>
    <div class="col-sm-6">
      <input type="namakk" class="form-control <?= (\Config\Services::validation()->hasError('namakk') ? 'is-invalid' : '') ?>" id="namakk" name="namakk" value="<?= $nama_kk; ?>" placeholder="Nama Kepala Keluarga">
      <div id="namakkFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('namakk'); ?>
    </div>

    </div>
  </div>
  <div class="form-group row">
    <label for="nokk" class="col-sm-4 col-form-label">Nomer KK</label>
    <div class="col-sm-6">
      <input type="nokk" class="form-control <?= (\Config\Services::validation()->hasError('nokk') ? 'is-invalid' : '') ?>" id="nokk" name="nokk" value="<?= $no_kk; ?>" placeholder="Nomor KK">
      <div id="nokkFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nokk'); ?></div>
    </div>
  </div>

  <input type="hidden" class="form-control" id="idklp" name="idklp" value="<?= $id_klp; ?>" placeholder="Nomor KK">

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>
    </table>

<script>
  $(document).ready(function() {

    $('.form-select').select2();
    $('#kelompok').change(function () {
     var optionSelected = $(this).find("option:selected");
     var prefix  = optionSelected.val();
     var a = prefix.split('_');
     var textSelected   = optionSelected.text();
     $('#nokk').val(a[0]);
     $('#idklp').val(a[1]);

    });
});
    </script>

<?= $this->endSection(); ?>
</div>
</div>
</div>