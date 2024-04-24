<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container-fluid px-4">
       <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?= $title ?>
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
                    <th scope="col">NO KK</th>
                    <th scope="col">NAMA LENGKAP</th>
                    <th scope="col">ALAMAT</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">HARGA</th>
                    
                    <th scope="col">AKSI</th>
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
                      <td><?= $saham['jml_saham'] ?></td>
                      <td><?= $saham['harga_saham'] ?></td>
                      
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/edit/<?= $saham['id'] ?>" class="btn btn-sm btn-primary">MUTASI</a>
                        <form method="post" action="<?php echo base_url() ?>ub/resign/<?= $saham['id']; ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <input type="hidden" name="totalsaham" id="totalsaham" value="<?= $saham['jml_saham'] ?>">
    <button id="konfirm" type="submit" class="btn btn-warning" onclick="return confirm('Mau Hapus Data Saham?')">RESIGN</button>
  </form>
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
