<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container-fluid px-4">
	<div>	
		<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
								<li class="breadcrumb-item active"><?= $title; ?></li>
							</ol>
	</div>      
	  
       <div class="row">
        <div class="col-md-12">
				<div class="card">
						<div class="card-header">
						<?= $title ?>
						</div>
				</div>
				<table id="datatablesSimple">
					<thead>
					  <tr>
						<th scope="col">NO.</th>
						<th scope="col">NO KK</th>
						<th scope="col">NAMA</th>
						<th scope="col">JUMLAH</th>
						<th scope="col">TGL RESIGN</th>
						<th scope="col">ALASAN</th>
						
					  </tr>
					</thead>
					<tbody>
					  
					  <?php 
						$no = 1;
						foreach($data_history as $saham){
					  ?>

					  <tr>
						  <td><?= $no++ ?></td>
						  <td><?= $saham->no_kk ?></td>
						  <td><?= $saham->nama ?></td>
						  <td><?= $saham->jml_saham ?></td>
						  <td><?= $saham->tgl_resign ?></td>
						  <td><?= $saham->alasan ?></td>
						  
					  </tr>
					<?php } ?>
					</tbody>
				</table>
            
			
			
			</div>
          </div>
      </div>
<?= $this->endSection(); ?>
