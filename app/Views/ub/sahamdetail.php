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
            <div class="card-body">
              <a href="<?php echo base_url() ?>ub/create" class="btn btn-md btn-success" style="margin-bottom: 10px"><i class="fa fa-database" style="font-size:20px"></i>&nbsp;INPUT SAHAM</a>
              <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>
              <table id="datatablesSimple">
                <thead>
                  <tr>
 

 <th scope="col">NO.</th>
                   <th scope="col">AKSI</th>
 
                    <th scope="col">NO KK</th>
                    <th scope="col">NAMA LENGKAP</th>
                    <th scope="col">ALAMAT</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">TIPE SAHAM</th>
					<th scope="col">HARGA</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    //dd($data_saham);
					foreach($data_saham as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>ub/edit/<?= $saham->id ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <form method="post" action="<?php echo base_url() ?>ub/hapus/<?= $saham->id; ?>">
    <input type="hidden" name="_method" value="delete"></input>
    
	<button id="konfirm" type="submit" class="btn btn-warning" onclick="return confirm('Mau Hapus Data Saham?')"><i class="fa fa-trash"></i></button>
  </form>
                      </td>
 
					<td><?= $saham->no_kk ?></td>
                      <td><?= $saham->nama ?></td>
                      <td><?= $saham->alamat ?></td>
                      <td><?= $saham->jml_saham ?></td>
                      <td><?= $saham->kode_saham ?></td>
					  <td><?= number_format($saham->harga_saham) ?></td>
                      
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

  <?= $this->endSection(); ?>
