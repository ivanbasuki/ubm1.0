<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 15px">
 <div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	       
	  
	  
	  <div class="row">

<div class="col-md-3">

			  <a href="<?php echo base_url() ?>ub/tambahProduk" class="btn btn-md btn-success" style="margin-bottom: 10px">INPUT PRODUK</a>
</div>
<div class="col-md-2">
                
		<form method="post" action="<?php echo base_url() ?>ub/pembiayaanBulanan" class="d-inline">
    <input type="hidden" name="_method" value="beli"></input>
 
</div>
<div class="col-md-2">

            </form>
</div>


        <div class="col-md-12">
          <div class="card">
            
			<div class="card-header">
              <?= $title ?>
            </div>
            
			<div class="card-body">
              
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NAMA BARANG</th>
                    <th scope="col">HARGA JUAL</th>
                    <th scope="col">HARGA POKOK</th>
                    <th scope="col">DP</th>
					<th scope="col">ANGSURAN</th>
					<th scope="col">TENOR</th>
					
					
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_produk)){
                    foreach($data_produk as $p){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?php echo $p->nama_barang ?></td>
                      <td><?php echo number_format($p->harga_jual) ?></td>
                      <td><?php echo number_format($p->harga_pokok) ?></td>
                      <td><?php echo number_format($p->dp) ?></td>
					  <td><?php echo number_format($p->angsuran) ?></td>
					  <td><?php echo number_format($p->tenor) ?></td>
					  
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editProduk/<?= $p->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url() ?>ub/hapusProduk/<?= $p->id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data Produk?')">Delete</button>

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
  var bln=$('#xbulan').val();
  var thn=$('#xtahun').val();
  $('#bulan').val(bln);
  $('#tahun').val(thn);
  $('#bulan').trigger('change');
  $('#tahun').trigger('change');
  
})

</script>
<?= $this->endSection(); ?>
