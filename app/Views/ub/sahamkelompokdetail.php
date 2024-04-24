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
            <div class="card-header">
              <?= $title; ?>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NAMA KELOMPOK</th>
                    <th scope="col">KK</th>
                    <th scope="col">SAHAM</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
					$totkk=0;
					$totsaham=0;
                    foreach($saham_kelompok as $saham){
						$totkk+=$saham->kk;
						$totsaham+=$saham->saham;
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $saham->nama_klp ?></td>
                      <td><?= $saham->kk ?></td>
                      <td><?= number_format($saham->saham) ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/daftarSahamKelompok/<?= $saham->id ?>" class="btn btn-sm btn-primary">DETAIL</a>
                      </td>
                  </tr>
                <?php } ?>
				<tr>
				      <td colspan=2>Total</td>
                      <td><?= $totkk ?></td>
                      <td><?= number_format($totsaham) ?></td>
                      <td class="text-center">
                        
                      </td>
                
				</tr>
				
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

  <?= $this->endSection(); ?>
