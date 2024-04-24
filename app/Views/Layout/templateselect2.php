<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
-->
    <title>Aplikasi Manajemen UB</title>
  </head>
  <link href="/css/style.css" style="stylesheet">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link href="/css/select2.min.css" rel="stylesheet" />
  <script src="/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="/jquery/bootstrap.min.js"></script>
    
<script src="/jquery/jquery.min.js"></script>
<script src="/jquery/select2.min.js"></script>


  <body>

<div class="container">
<h1>Aplikasi Manajemen UB</h1>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">UB Bina Syirkah Mandiri</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Saham
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/ub/kk">Saham Per KK</a>
        <a class="dropdown-item" href="/ub/member">Saham Per Jiwa</a>
        <a class="dropdown-item" href="/ub/kelompok">Kelompok</a>
        <a class="dropdown-item" href="/komik/index">Mutasi</a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Cetak Saham</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Master Data
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/ub/datakelompok">Data Kelompok</a>
        <a class="dropdown-item" href="/ub/pelanggan">Data Customer</a>
        <a class="dropdown-item" href="/ub/pengurus">Data Pengurus</a>
        <a class="dropdown-item" href="/ub/user">User</a>
</div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Transaksi Keuangan
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/ub/penjualan">Penjualan</a>
        <a class="dropdown-item" href="/ub/pembelian">Pembelian</a>
        
        <a class="dropdown-item" href="/Pages/contact">Pembiayaan</a>
        <a class="dropdown-item" href="/komik/index">Retail</a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Kredit Hadist</a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li>
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</div>
</nav>
</div>
<?= $this->renderSection('content'); ?>


  </body>
</html>