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

<form method="post" action="/ub/simpanPenjualan">
 
<div class="form-group row">
    <label for="id_anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
    <div class="col-sm-6">
    <select class="form-select <?= (\Config\Services::validation()->hasError('id_anggota') ? 'is-invalid' : '') ?>" name="id_anggota" id="id_anggota">
    <option value=''></option>
    <?php foreach($data_anggota as $k): ?>  
    <option value="<?php echo $k->id ?>"><?php echo  $k->nama_pelanggan.':'.$k->nama_klp; ?></option>
     <?php endforeach ?>  
  </select>    
  <div id="idFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_anggota'); ?>
    </div>

  <input type="hidden" name="id" id="id"></input>
  <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $id_anggota ?>"></input>

</div>
  </div>


<div class="form-group row">
    <label for="tgl_penjualan" class="col-sm-4 col-form-label">Tgl Penjualan</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_penjualan') ? 'is-invalid' : '') ?>" id="tgl_penjualan" name="tgl_penjualan" value="<?= $tgl_penjualan; ?>" placeholder="Tanggal Penjualan">
      <div id="tglFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_penjualan'); ?>
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