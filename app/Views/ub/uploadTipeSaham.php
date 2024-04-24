<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>
	<div class="container mt-3">
  <div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>
		<?php
		if(session()->getFlashdata('message')){
		?>
			<div class="alert alert-info">
				<?= session()->getFlashdata('message') ?>
			</div>
		<?php
		}
		?>
		<div>	<a href="/ub/excelTipeSaham"><button class="btn btn-success" type="submit">Download Excel >></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="submit">Hapus Data >></button></a></div>
	
		<form method="post" action="/ub/simpanExcelTipeSaham" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" id="fileexcel" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button id="upload" class="btn btn-primary" type="submit">Upload</button>
			</div>
		</form>
		<div id="loader">
		</div>
		<table class="table table-bordered" id="datatablesSimple">
			<thead>
				<tr>
					<th>Id#</th>
					<th>Tipe Saham</th>
					<th>Harga Saham</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($data_tipe)){
				$no=1;
				foreach($data_tipe as $dt){
				?>
					<tr>
						<td><?= $dt->id ?></td>
						
						<td><?= $dt->kode_saham ?></td>
						<td><?= $dt->harga_saham ?></td>
					</tr>
				<?php
				$no++;
				}
			}else{
			?>
				<tr>
					<td colspan="3">Tidak ada data</td>		
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
<script>	
		$().ready(function(){
		$('#loader').hide();
		
		$('#upload').on('click',function(){
			
			var fileName=$('#fileexcel').val();
			if(fileName != '') {
				$('#loader').show().delay(5000).fadeOut();
				$('#myform').trigger('submit');
			
			} else { alert('File belum dipilih'); }	
		});
		
		$('#hapus').on('click',function(){
			if(confirm('Yakin mau dihapus?')){
			$('#loader').show().delay(5000).fadeOut();

			  window.location.href = "/ub/hapusTipeSaham";
			}
		});
		
		
		});
		
</script>
	
	
<?= $this->endSection() ?>