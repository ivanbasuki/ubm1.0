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
		<div>	<a href="/ub/excelSahamKK"><button class="btn btn-success" type="submit">Download Excel<i class="fa fa-download"></i></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="submit">Hapus Data<i class="fa fa-trash"></i></button></a></div>
	
		<form method="post" action="/ub/simpanExcelSahamKK" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Upload</button>
	</div>
		</form>
<div id="loader">
		</div>
			
	<table class="table table-bordered" id="datatablesSimple">
			<thead>
				<tr>
					<th>No Seri</th>
					<th>ID KK</th>
					<th>Nama KK</th>
					<th>ID Kelompok</th>
					<th>Nama Kelompok</th>

				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($data_sahamkk)){
				$no=1;
				foreach($data_sahamkk as $dt){
				?>
					<tr>
						<td><?= $dt['id'] ?></td>
						<td><?= $dt['id_kk'] ?></td>
						<td><?= $dt['nama_kk'] ?></td>
						<td><?= $dt['id_klp'] ?></td>
						<td><?= $dt['nama_klp'] ?></td>

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
		let x = Math.floor((Math.random() * 20) + 1);
		var img = "/img/"+x.toString()+".gif";  
		//alert(img);
		$("#loader").css("background-image","url(" + img + ")");
		/*$('#loader').show().delay(5000).fadeOut();
		*/
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

			  window.location.href = "/ub/hapusSahamKK";
			}
		});
		
		
		});
		
</script>	
<?= $this->endSection() ?>