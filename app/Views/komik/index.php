<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
<h1 class="mt-2">Daftar Buku</h1>
<a href="/komik/create" class="btn btn-success">Tambah</a>
<?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>

<?php endif ?>

<div class="row">
        <div class="col">
        <table class="table">
  <thead>
    <tr>
       <th scope="col">#</th>
      <th scope="col">Sampul</th>
      <th scope="col">Judul</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php $i=1; ?>
  <?php foreach ($komik as $k): ?>    
  <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><img src="/img/<?= $k['sampul']; ?>" class="sampul"></img></td>
      <td><?= $k['judul']; ?></td>
      <td><a href="/komik/detail/<?= $k['slug']; ?>" class="btn btn-success">Detail</a></td>
</tr>

<?php endforeach; ?>  
</tbody>
</table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

