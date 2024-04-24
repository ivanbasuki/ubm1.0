<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              DATA KELOMPOK
            </div>
            <div class="card-body">
              <a href="<?php echo base_url() ?>index.php/siswa/tambah" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
              <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>
              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">KODE KELOMPOK</th>
                    <th scope="col">NAMA KELOMPOK</th>
                    <th scope="col">JUMLAH KK</th>
                    <th scope="col">SAHAM</th>
                    
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    foreach($data_kelompok as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $saham->kode_klp ?></td>
                      <td><?= $saham->nama_klp ?></td>
                      <td><?= $saham->jumlah ?></td>
                      <td><?= $saham->saham ?></td>
                      
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>index.php/kelompok/edit/<?= $saham->kode_klp ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="<?php echo base_url() ?>index.php/kelompok/hapus/<?= $saham->kode_klp ?>" class="btn btn-sm btn-danger">HAPUS</a>
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
