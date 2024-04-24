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
                <div class="d-flex flex-row-reverse bd-highlight">
      <a href="<?php echo base_url('PdfController/htmlToPDF') ?>" class="btn btn-primary">
        Laporan PDF
      </a>
      <a href="<?php echo base_url('phpExcel/exportExcel') ?>" class="btn btn-info">
        Laporan Excel
      </a>
    </div>

			<div class="card-body">
              <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NO KK LAMA</th>
                    <th scope="col">NO KK BARU</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">TGL MUTASI</th>
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
                      <td><?= $saham->no_kk_lama ?></td>
                      <td><?= $saham->no_kk ?></td>
                      <td><?= $saham->nama ?></td>
                      <td><?= $saham->tgl_mutasi ?></td>
                      <td><?= $saham->alasan ?></td>
                      
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

  <?= $this->endSection(); ?>
