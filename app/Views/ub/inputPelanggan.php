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
	  
<h2>Input Pelanggan</h2>

<form method="post" action="/ub/simpanPelanggan">
 
<div class="form-group row">
    <label for="id_anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
    <div class="col-sm-6">
    <select class="form-select" name="id_anggota" id="id_anggota">
    <option value=''></option>
    <?php foreach($data_anggota as $k): ?>  
    <option value="<?php echo $k->id ?>|<?= $k->hp ?>|<?= $k->id_klp ?>"><?php echo  $k->nama.':'.$k->nama_klp; ?></option>
     <?php endforeach ?>  
  </select>    
<input type="hidden" name="id" id="id"></input>
</div>
  </div>

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
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_pelanggan') ? 'is-invalid' : '') ?>" id="nama_pelanggan" name="nama_pelanggan" value="<?= $nama_pelanggan; ?>" placeholder="Nama Lengkap">
      <div id="namaFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_pelanggan'); ?>
    </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="hp" class="col-sm-4 col-form-label">No HP</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="hp" name="hp" value="<?= $hp; ?>" placeholder="Alamat Lengkap">
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
    $('#id_anggota').on('change',function(){
     var nama = $('#id_anggota option:selected').text();
     var ar_nama = nama.split(':');
     
     var id = $('#id_anggota').val();
     var ar = id.split('|');
     $('#id').val(ar[0]);

     $('#nama_pelanggan').val(ar_nama[0]);
     $('#hp').val(ar[1]);
     $('#id').val(ar[0]);
     
     $('#id_kelompok').val(ar[2]);
     $('#id_kelompok').trigger('change');
     
    });

    $('#id_kelompok').select2();
    $('#id_anggota').select2();
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>