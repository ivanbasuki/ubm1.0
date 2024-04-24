<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/ubahPenjualan">

<input type="hidden" class="form-control" name="id" value="<?= $id; ?>">

<?php
if(!empty($penjualan)){
  foreach($penjualan as $p){
?>    
<div class="form-group row">
    <label for="nama_pelanggan" class="col-sm-4 col-form-label">Tgl Penjualan</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="nama_pelanggan" value="<?= $p->nama_pelanggan; ?>" placeholder="Nama Lengkap" readonly>
    </div>
  </div>

<div class="form-group row">
    <label for="tgl_penjualan" class="col-sm-4 col-form-label">Tgl Penjualan</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_penjualan') ? 'is-invalid' : '') ?>" id="tgl_penjualan" name="tgl_penjualan" value="<?= $p->tgl_penjualan; ?>" placeholder="Tanggal Penjualan">
      <div id="tglFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_penjualan'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('jumlah') ? 'is-invalid' : '') ?>" id="jumlah" name="jumlah" value="<?= $p->jumlah; ?>" placeholder="Jumlah Tagihan">
      <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jumlah'); ?>
    </div>
    </div>
  </div>
 
<?php
}
}
?>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    var idpel = $('#id_pelanggan').val();
    $('#id_anggota').val(idpel);
    $('#id_anggota').trigger('change');

    $('#id_anggota').select2();
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>