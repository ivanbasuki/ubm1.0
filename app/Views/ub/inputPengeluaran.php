<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="row">
<div class="col-10">
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	  
<h2><?= $title ?></h2>

<form method="post" action="/ub/simpanPengeluaran">
 
<div class="form-group row">
    <label for="id_pos" class="col-sm-4 col-form-label">Pos Pengeluaran</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('id_pos') ? 'is-invalid' : '') ?>" name="id_pos" id="id_pos">
    <option value=''></option>
    <?php foreach($data_pos as $k): ?>  
    <option value="<?php echo $k->id ?>"><?php echo  $k->nama_pos; ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="idFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_pos'); ?>
    </div>

  <input type="hidden" name="id" id="id" value="<?= $id ?>"></input>
  <input type="hidden" name="id_pengeluaran" id="id_pengeluaran" value="<?= $id_pos ?>"></input>

</div>
  </div>


<div class="form-group row">
    <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tgl Transaksi</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_transaksi') ? 'is-invalid' : '') ?>" id="tgl_transaksi" name="tgl_transaksi" value="<?= $tgl_transaksi; ?>" placeholder="Tanggal Penjualan">
      <div id="tglFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_transaksi'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('jumlah') ? 'is-invalid' : '') ?>" id="jumlah" name="jumlah" value="<?= $jumlah; ?>" placeholder="Jumlah Tagihan">
      <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('jumlah'); ?>
    </div>
    </div>
  </div>
 
  <div class="form-group row">
    <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
    <div class="col-sm-6">
      <input type="decimal" class="form-control <?= (\Config\Services::validation()->hasError('deskripsi') ? 'is-invalid' : '') ?>" id="deskripsi" name="deskripsi" value="<?= $deskripsi; ?>" placeholder="Keterangan">
      <div id="deskripsiFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('deskripsi'); ?>
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
    var idpos = $('#id_pengeluaran').val();
    $('#id_pos').val(idpos);
    $('#id_pos').trigger('change');

    $('#id_pos').select2();
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>