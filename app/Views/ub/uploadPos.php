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
		<div>	<a href="/ub/excelPOS/<?= $pos ?>"><button class="btn btn-success" type="button">Download Excel<i class="fa fa-download"></i></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="button">Hapus Data <i class="fa fa-trash"></i></button></a></div>
		<div id='loader'></div>

		<form id="myform" method="post" action="/ub/simpanExcelPos/<?= $pos ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button id="upload" class="btn btn-primary" type="button">Upload<i class="fa fa-upload"></i></button>
				<input type="hidden" name="pos" id="pos" value="<?= $pos ?>"></input>
	</div>
		</form>
		<table class="table table-bordered" id="datatablesSimple">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama POS</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($data_pos)){
				$no=1;
				foreach($data_pos as $dt){
				?>
					<tr>
						<td><?= $no ?></td>
						
						<td><?= $dt->nama_pos ?></td>
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

			  window.location.href = "/ub/hapusTablePos/<?= $pos ?>";
			}
		});
		
		});
		
</script>
	
	
<?= $this->endSection() ?>