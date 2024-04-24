<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<h2><?= $title ?></h2>

<form method="post" action="/ub/simpanEditNasabah">
 
<div class="form-group row">
    <label for="id_anggota" class="col-sm-4 col-form-label">Nama Nasabah</label>
    <div class="col-sm-6">
    <select  name="id_anggota" id="id_anggota" class="form-select <?= (\Config\Services::validation()->hasError('id_anggota') ? 'is-invalid' : '') ?>">
    <option value=''></option>
    <?php foreach($data_anggota as $k): ?>  
    <option value="<?php echo $k->id ?>"><?php echo  $k->id.':'.$k->nama_pelanggan.':'.$k->nama_klp; ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="idFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_anggota'); ?>
    </div>
<?php
if(!empty($nasabah)){
	foreach($nasabah as $n){
		?>
<input type="hidden" name="id" id="id" value="<?= $n->id ?>">
<input type="hidden" name="xid_anggota" id="xid_anggota" value="<?= $n->id_anggota ?>">
<input type="hidden" name="xid_kredit" id="xid_kredit" value="<?= $n->id_kredit ?>">
<input type="hidden" name="xid_tgl" id="xid_tgl" value="<?= $n->tgl_transaksi ?>">
</div>
  </div>


<div class="form-group row">
    <label for="id_kredit" class="col-sm-4 col-form-label">Jenis Pembiayaan</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('id_kredit') ? 'is-invalid' : '') ?>" name="id_kredit" id="id_kredit">
    <option value=''></option>
    <?php foreach($data_produk as $k): ?>  
    <option value="<?php echo $k->id ?>"><?php echo  $k->nama_barang.':'.$k->harga_jual; ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="kreditFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_kredit'); ?>
    </div>

 
</div>
  </div>



<div class="form-group row">
    <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tgl Transaksi</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_transaksi') ? 'is-invalid' : '') ?>" id="tgl_transaksi" name="tgl_transaksi" value="<?= $n->tgl_transaksi; ?>" placeholder="Tanggal Transaksi">
      <div id="tglFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_transaksi'); ?>
    </div>
    </div>
  </div>
<?php
}}
?>

 
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    
	var idnas = $('#xid_anggota').val();
	var idkredit = $('#xid_kredit').val();
	
	$('#id_anggota').val(idnas);
	$('#id_kredit').val(idkredit);
	
	$('#id_anggota').trigger('change');
	$('#id_kredit').trigger('change');
	
	
	
    $('#id_anggota').select2();
    $('#id_kredit').select2();
	
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>