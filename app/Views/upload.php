<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Import Excel Codeigniter</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-3">
		<?php
		if(session()->getFlashdata('message')){
		?>
			<div class="alert alert-info">
				<?= session()->getFlashdata('message') ?>
			</div>
		<?php
		}
		?>
		<form method="post" action="/upload/prosesExcel" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Upload</button>
			</div>
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Nama POS</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($data_POSD)){
				foreach($data_POSD as $p){
				?>
					<tr>
						<td><?= $p['nama_pos'] ?></td>
					</tr>
				<?php
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
</body>
</html>