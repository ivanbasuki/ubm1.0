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

<form method="post" action="/ub/simpanInvoice">
 
 
<div class="form-group row">
    <label for="id_penjualan" class="col-sm-4 col-form-label">Tagihan</label>
    <div class="col-sm-6">
  
	<select multiple="multiple" class="form-select <?= (\Config\Services::validation()->hasError('id_penjualan') ? 'is-invalid' : '') ?>" name="id_penjualan[]" id="id_penjualan">
    <option value=''></option>
    <?php if(!empty($data_penjualan)):foreach($data_penjualan as $k): ?>  
    <option value="<?php echo $k->id ?>"  
	<?php if(!empty($id_penjualan))
	{
    $ar=[];
    $ar=explode(",",$id_penjualan);
	foreach($ar as $x => $y){
		($k->id==$y) ? ' selected' : '';
    } 		
	}
		?>>
	
	
	<?php echo  $k->nama_pelanggan.':'.$k->jumlah; ?></option>
     <?php endforeach;
			endif ?>  
      <div id="idpenjualanFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('id_penjualan'); ?>
    </div>

  </select>    


</div>
  </div>

<div class="form-group row">
    <label for="no_invoice" class="col-sm-4 col-form-label">No Invoice</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('no_invoice') ? 'is-invalid' : '') ?>" id="no_invoice" name="no_invoice" value="<?= $no_invoice; ?>" placeholder="Nomor Invoice">
      <div id="noinvoiceFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('no_Invoice'); ?>
    </div>
    </div>
  </div>


<div class="form-group row">
    <label for="tgl_invoice" class="col-sm-4 col-form-label">Tgl Invoice</label>
    <div class="col-sm-6">
      <input type="date" class="form-control <?= (\Config\Services::validation()->hasError('tgl_invoice') ? 'is-invalid' : '') ?>" id="tgl_invoice" name="tgl_invoice" value="<?= $tgl_invoice; ?>" placeholder="Tanggal Invoice">
      <div id="tglFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('tgl_Invoice'); ?>
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
    <label for="deskripsi" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-6">
      <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('deskripsi') ? 'is-invalid' : '') ?>" id="deskripsi" name="deskripsi" value="<?= $deskripsi; ?>" placeholder="Deskripsi Invoice">
      <div id="jumlahFeedback" class="invalid-feedback">
      <?= \Config\Services::validation()->getError('deskripsi'); ?>
    </div>
    </div>
  </div>

 
<input type="hidden" class="form-control" id="ids" name="ids" value="" placeholder="Id">
<input type="hidden" name="xbulan" id="xbulan" value="<?= $bulan ?>"> 
<input type="hidden" name="xtahun" id="xtahun" value="<?= $tahun ?>"> 
<input type="hidden" name="xidkel" id="xidkel" value="<?= $idkel ?>"> 



  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
  $('#id_penjualan').on("change",function(){
	  
	  var a = $('#id_penjualan').val();
	  var b = $('#id_penjualan option:selected').text();

var str = "";
var tagihan = 0;
var tmpAr = new Array();

    $('#id_penjualan option:selected').each( function() {
      //str += $( this ).text() + " ";
	  tmpAr = $( this ).text().split(":");
	  tagihan = parseInt(tagihan) + parseInt(tmpAr[1]);
    } );
 	$('#jumlah').val(tagihan);
	$('#ids').val($(this).val());
	
  } ).trigger( "change" );
	  

  $('#id_penjualan').select2();
  
  
  
  
  });
    </script>
<?= $this->endSection(); ?>
</div>
</div>
</div>