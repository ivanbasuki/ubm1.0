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
		<form method="post" action="/ub/simpanExcel" enctype="multipart/form-data">
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
					<th>Kode Kelompok</th>
					<th>Nama Kelompok</th>
					<th>Prefix Kelompok</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($kelompok)){
				foreach($kelompok as $dt){
				?>
					<tr>
						<td><?= $dt->kode_klp ?></td>
						<td><?= $dt->nama_klp ?></td>
						<td><?= $dt->prefix_kk ?></td>
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
<?= $this->endSection() ?>