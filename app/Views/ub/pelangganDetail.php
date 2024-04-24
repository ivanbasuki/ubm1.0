<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 5px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Daftar Pelanggan
            </div>
            <div class="card-body">
              <a href="<?php echo base_url() ?>ub/tambahPelanggan" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">HP</th>
                    <th scope="col">KELOMPOK</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    foreach($data_pelanggan as $p){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?php echo $p->nama_pelanggan ?></td>
                      <td><?php echo $p->hp ?></td>
                      <td><?php echo $p->nama_klp ?></td>
                      
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editPelanggan/<?= $p->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <form method="post" action="<?php echo base_url() ?>ub/hapusPelanggan/<?= $p->id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data Saham?')">Delete</button>

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
