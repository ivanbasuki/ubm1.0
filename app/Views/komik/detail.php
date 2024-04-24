<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">




<h1 class="mt-2">Detail</h1>
<div class="row">
        <div class="col">

        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="/img/<?= $komik['sampul'] ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $komik['judul'] ?></h5>
    <p class="card-text"><?= $komik['penerbit'] ?></p>
    <a href="/komik/edit/<?= $komik['id']; ?>" class="btn btn-primary">Edit</a>

    <form method="post" action="/komik/<?= $komik['id']; ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin?');">Delete</button>
  </form>

  </div>
</div>



        </div>
    </div>
</div>
<?= $this->endSection(); ?>

