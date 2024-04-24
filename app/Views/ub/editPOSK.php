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

<form method="post" action="/ub/simpanPOSK">
<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="ub/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Input POS Kredit</li>
                        </ol>
   
  <input type="hidden" name="id" id="id" value="<?= $id ?>"></input>

  <?php
if(!empty($data_posk))
{ foreach($data_posk as $p){
  ?>

  <div class="form-group row">
    <label for="nama_posd" class="col-sm-4 col-form-label">Nama POS</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_POSK') ? 'is-invalid' : '') ?>" id="nama_POSK" name="nama_POSK" value="<?= $p->nama_pos; ?>" placeholder="Nama POS Pengeluaran">
      <div id="POSKFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('nama_POSK'); ?>
    </div>
    </div>
  </div>

  <?php }} ?>
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