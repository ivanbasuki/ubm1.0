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
			<div>	<a href="/ub/excelKelompok"><button class="btn btn-success" type="submit">Download Excel<i class="fa fa-download"></i></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="button">Hapus Data <i class="fa fa-trash"></i></button></a></div>
	


		<div id='loader'></div>

		<form id="myform" method="post" action="/ub/simpanExcel" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
			<div class="form-group">

				<button id="upload" class="btn btn-primary" type="button">Upload <i class="fa fa-upload"></i></button>

			</div>

		</form>

		<table class="table table-bordered" id="datatablesSimple">
			<thead>
				<tr>
					<th>Id#</th>
					<th>Kode Kelompok</th>
					<th>Nama Kelompok</th>
					<th>Prefix Kelompok</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($kelompok)){
				$no=1;
				foreach($kelompok as $dt){
				?>
					<tr>
						<td><?= $dt['id'] ?></td>
						
						<td><?= $dt['kode_klp'] ?></td>
						<td><?= $dt['nama_klp'] ?></td>
						<td><?= $dt['prefix_kk'] ?></td>
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
			var file = $('#file').val();
			if(file == ''){
				alert('Upload file terlebih dahulu!');
			} else {	
			$('#loader').show().delay(5000).fadeOut();
			$('#myform').trigger('submit'); }
		});
		
		$('#hapus').on('click',function(){
			if(confirm('Yakin mau dihapus?')){
			$('#loader').show().delay(5000).fadeOut();

			  window.location.href = "/ub/hapusKelompok";
			}
		});
		
		});
		
</script>

<?= $this->endSection() ?>