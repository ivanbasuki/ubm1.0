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
						
					<div class="card-header">
						<a href="<?php echo base_url('PdfController/htmlToPDFCetakSaham') ?>">
						<button  class="btn btn-primary">Laporan PDF</button>
						</a>
						<a href="<?php echo base_url('phpExcel/exportExcelReportSaham') ?>">
						<button  class="btn btn-info">Laporan Excel</button>
						</a>
					</div>

			<div class="card-body">
  
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">ID KK</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">HP</th>
                    <th scope="col">Tgl Join</th>
					<th scope="col">Kode Saham</th>
					<th scope="col">Harga Saham</th>
					<th scope="col">Aksi</th>
					
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    foreach($data_saham as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $saham['no_kk'] ?></td>
                      <td><?= $saham['nama'] ?></td>
                      <td><?= $saham['alamat'] ?></td>
                      <td><?= $saham['hp'] ?></td>
                      <td><?= $saham['tgl_join'] ?></td>
					  <td><?= $saham['kode_saham'] ?></td>
                      <td><?= $saham['harga_saham'] ?></td>
					  <td><a onClick="window.open('<?php echo base_url('PdfController/htmlToPDFCetakSahamID/'.$saham['id']) ?>','_blank');"><button><i class="fa fa-print"></i></button></a></td>
 
                      
                  </tr>
                <?php } ?>
                </tbody>
              </table>
</div>
</div>
            </div>
          </div>
</div>

  <?= $this->endSection(); ?>
