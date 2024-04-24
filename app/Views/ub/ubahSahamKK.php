<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-8">
<h2>Edit Saham KK</h2>

<form method="post" action="/ub/updateSahamKK">
 
<table class="table">
<?php foreach($sahamkk as $s): ?>
<div class="form-group row">
    <label for="namakk" class="col-sm-4 col-form-label">Nama KK</label>
    <div class="col-sm-6">
      <input type="namakk" class="form-control" id="namakk" name="namakk" value="<?= $s->nama_kk; ?>" placeholder="Nama Kepala Keluarga">

    </div>
  </div>
  <div class="form-group row">
    <label for="nokk" class="col-sm-4 col-form-label">Nomer KK</label>
    <div class="col-sm-6">
      <input type="nokk" class="form-control" id="idkk" name="idkk" value="<?= $s->id_kk; ?>" placeholder="Nomor KK">
      <input type="hidden" class="form-control" id="id" name="id" value="<?= $s->id; ?>" placeholder="Nomor KK">

    </div>
</div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
<?php endforeach ?>  
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