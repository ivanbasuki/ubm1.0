<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container-fluid px-4" style="margin-top: 5px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?= $title ?>
            </div>
            <div class="card-body">
              <a href="<?php echo base_url() ?>index.php/ub/tambah" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NO Seri</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">TGL JOIN</th>
                    
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    foreach($data_sahamkk as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><button class="btn btn-sm btn-warning"><?php echo $saham->id ?></button></td>
                      <td><?php echo $saham->nama ?></td>
                      <td><?php echo $saham->jml_saham ?></td>
                      <td><?php echo $saham->tgl_join ?></td>
                      
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>index.php/ub/edit/<?= $saham->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="<?php echo base_url() ?>index.php/ub/hapus/<?= $saham->id ?>" class="btn btn-sm btn-danger">HAPUS</a>
                      </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

  <?= $this->endSection(); ?>
