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
					<div>	<a href="<?php echo base_url('Produk/simpanExcelProduk') ?>"><button class="btn btn-success" type="submit">Download Excel &nbsp;&nbsp;<i class="fa fa-download" style="font-size:20px"></i></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="submit">Hapus Data&nbsp;&nbsp;<i class="fa fa-trash" style="font-size:20px"></i></button></a></div>

		<div id='loader'></div>
		<form id="myform" name="myform" method="post" action="<?php echo base_url('Produk/simpanExcelProduk') ?>" enctype="multipart/form-data">
			
	
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button id="upload" class="btn btn-primary" type="button"><i class="fa fa-upload" style="font-size:20px"></i> Upload </button>
	</div>
		</form>
		<table class="table table-bordered" id="datatablesSimple">
			<thead>
				<tr>
					<th>Id#</th>
					
					<th>Nama Barang</th>
					<th>Harga Jual</th>
					<th>Harga Pokok</th>
					<th>DP</th>
					<th>Angsuran</th>
					<th>Tenor</th>
					<th>Aksi</th>



				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
			if(!empty($data_produk)){
				$no=1;
				foreach($data_produk as $dt){
				?>
					<tr>
						<td><?= $dt['id'] ?></td>
						<td><?= $dt['nama_barang'] ?></td>
<td><?= $dt['harga_jual'] ?></td>
<td><?= $dt['harga_pokok'] ?></td>
<td><?= $dt['dp'] ?></td>
<td><?= $dt['angsuran'] ?></td>
<td><?= $dt['tenor'] ?></td>
<td><a href="<?php echo base_url('Produk/editProduk/'.$dt['id']) ?>"><i class="fa fa-edit" style="font-size:20px"></button></a></td>


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

			  window.location.href = "<?php echo base_url('Produk/hapusProduk') ?>";
			}
		});
		
		});
		
</script>
<?= $this->endSection() ?>		