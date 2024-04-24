<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 15px">
	<?php
		if(session()->getFlashdata('message')){
		?>
			<div class="alert alert-info">
				<?= session()->getFlashdata('message') ?>
			</div>
		<?php
		}
?>
      
	  
	  
	  <div class="row">

<div class="col-md-2">
                
	<form method="post" action="<?php echo base_url('Pengeluaran/uploadPengeluaran') ?>" class="d-inline">
    <input type="hidden" name="_method" value="beli"></input>
    <input type="hidden" name="xbulan" id="xbulan" value="<?= $bulan ?>"></input>
    <input type="hidden" name="xtahun" id="xtahun" value="<?= $tahun ?>"></input>

			  <select name="bulan" id="bulan" class="form-select">
              <?php 
              $a=0;
              if(!empty($data_bulan)){
              foreach($data_bulan as $x => $y){
                
               ?>  
              <option value="<?= $x ?>" <?= ($x==$bulan) ? ' selected':'' ?>><?php echo $y ?></option>
              <?php
            $a++;
            } }?>
              </select>  
</div>
<div class="col-md-2">

              <select name="tahun" id="tahun" class="form-select">
              <?php 
              $b=0;
              while($b < count($data_tahun)){
              
               ?>  
              <option <?= ($data_tahun[$b]==$bulan) ? ' selected':'' ?>><?php echo $data_tahun[$b] ?></option>
              <?php
            $b++;
            } ?>
              </select>
</div>
<div class="col-md-2">
			  
              <button id="beli" type="submit" class="btn btn-info" >Report</button>

            </form>
</div>


        <div class="col-md-12">
          <div class="card">
            
			<div class="card-header">
              <?= $title ?>
            </div>
            
			<div class="card-body">

					<div>	<a href="<?php echo base_url('phpExcel/exportExcelPengeluaran') ?>"><button class="btn btn-success" type="submit">Download Excel &nbsp;&nbsp;<i class="fa fa-download" style="font-size:20px"></i></button></a>&nbsp;&nbsp;&nbsp;<a><button id="hapus" class="btn btn-danger" type="submit">Hapus Data&nbsp;&nbsp;<i class="fa fa-trash" style="font-size:20px"></i></button></a></div>

		<div id='loader'></div>
		<form id="myform" name="myform" method="post" action="<?php echo base_url('Pengeluaran/simpanExcelPengeluaran') ?>" enctype="multipart/form-data">
			
	
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
                    <th scope="col">NO.</th>
                    <th scope="col">TGL TRANSAKSI</th>
                    <th scope="col">POS</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">KAS</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_pengeluaran)){
                    foreach($data_pengeluaran as $p){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?php echo $p->tgl_transaksi ?></td>
                      <td><?php echo $p->nama_pos ?></td>
                      <td><?php echo $p->deskripsi ?></td>
                      <td><?php echo number_format($p->jumlah) ?></td>
                      <td><?php echo $p->nama_kas ?></td>
                      
					  <td class="text-center">
                        <a href="<?php echo base_url('Pengeluaran/edit/'.$p->id) ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url('Pengeluaran/hapus/'.$p->id) ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data Pengeluaran?')">Delete</button>

  </form>
                      </td>
                  </tr>
                <?php }
                } ?>
                </tbody>
              </table>

            </div>
          </div>
      </div>
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

			  window.location.href = "<?php echo base_url('Pengeluaran/hapusPengeluaran') ?>";
			}
		});
		
		});
		
</script>
<?= $this->endSection(); ?>
