<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 80px">
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	   
 <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card bg-primary text-white mb-4">
              <?= $title; ?>
            </div>
			<div class="row">
							
			
            <div class="card-body">
              <a href="<?php echo base_url() ?>ub/createkk" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH KK SAHAM</a>
              <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NO KK</th>
                    <th scope="col">Kelompok</th>
					<th scope="col">NAMA KK</th>
                    <th scope="col">JUMLAH</th>
                    
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_sahamkk)) {
						foreach($data_sahamkk as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><a href="<?php echo base_url() ?>ub/detail/<?= $saham->id_kk ?>" class="btn btn-sm btn-success"><?php echo $saham->id_kk ?></a></td>
                      <td><?php echo $saham->nama_klp ?></td>

                      <td><?php echo $saham->nama_kk ?></td>
                      <td><?php echo $saham->jumlah ?></td>
                      
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editkk/<?= $saham->id_kk ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <form id="kirim" method="post" action="<?php echo base_url() ?>ub/hapuskk/<?= $saham->id; ?>" class="d-inline">
                        <input type="hidden" name="_method" value="delete"></input>
                        <input class="jumlah" id="jumlah" type="hidden" value="<?= $saham->jumlah ?>"></input>
                        <button type="submit" name="hapuskk" id="hapuskk" class="btn btn-danger" <?= ($saham->jumlah > 0) ? "disabled" : '' ?> onclick="return confirm('Yakin hapus data KK?')">Delete</button>
                      </form>
    </td>
                  </tr>
					<?php } }?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    <script>
  $(document).ready(function() {

    </script>

  <?= $this->endSection(); ?>
