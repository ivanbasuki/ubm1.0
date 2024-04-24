<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" type="image/png" href="img/naruto.jpeg"/>
		<title>UB Management 1.0</title>
         <link href="/css/style.min.css" rel="stylesheet" />
        <link href="/css/stylesmenusb.css" rel="stylesheet" />
		<link href="/css/select2.min.css" rel="stylesheet" />
  
		<script src="/js/all.js"></script>
		<script src="/jquery/jquery.min.js"></script>
		<script src="/jquery/select2.min.js"></script>


    </head>
    <body class="sb-nav-fixed" >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">UB Management 1.0</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/ub/gantiPassword">Ganti Password</a></li>
                        <li><a class="dropdown-item" href="/ub/userList">List User</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout"><?= (session()->get('user_name')) ? 'Logout' : 'Login' ?></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            

<!---Level 1--->

						   
							
							




                           
						   <div class="sb-sidenav-menu-heading">Transaksi UB</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                SAHAM UB
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ub/kk"><i class="fas fa-check-square fa-fw"></i>&nbsp;Saham Per KK</a>
                                    <a class="nav-link" href="/ub/member"><i class="fas fa-address-book fa-fw"></i>&nbsp;Saham Per Jiwa</a>
									<a class="nav-link" href="/ub/mutasi"><i class="fas fa-arrows fa-fw"></i>&nbsp;Mutasi Saham</a>
									
									<a class="nav-link" href="/ub/rekapKelompok"><i class="fas fa-university fa-fw"></i>&nbsp;Rekap Kelompok</a>
									
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Operasional UB
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        <i class="fas fa-shopping-basket fa-fw"></i>&nbsp;Transaksi UB
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="/ub/pengeluaran">Pembelian</a>
                                            <a class="nav-link" href="/ub/penjualan">Penjualan</a>
                                            <a class="nav-link" href="/ub/Invoice">Invoice</a>
                                            <a class="nav-link" href="/ub/pembayaran">Pembayaran</a>
				   </nav>
                                    </div>
									
									<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Pembiayaan" aria-expanded="false" aria-controls="pagesCollapseError">
                                        <i class="fas fa-credit-card fa-fw"></i>&nbsp;Pembiayaan
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="Pembiayaan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="/ub/produk">Produk Pembiayaan</a>
                                            <a class="nav-link" href="/ub/nasabah">Nasabah</a>
                                            <a class="nav-link" href="/ub/pembayaranKredit">Pembayaran</a>
                                        </nav>
                                    </div>
									
									
									
                                </nav>
                            </div>
                           
<div class="sb-sidenav-menu-heading">Master Data</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#masterLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Konfigurasi Sistem
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="masterLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ub/posdebet">POS Penerimaan</a>
                                    <a class="nav-link" href="/ub/poskredit">POS Pengeluaran</a>
								    <a class="nav-link" href="/ub/listConfig">Konfigurasi</a>
									
                                </nav>
                            </div>
                            
							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#userLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="userLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/ub/pelanggan">Data Pelanggan</a>
                                    <a class="nav-link" href="/ub/userList">User</a>
									
                                </nav>
                            </div>

							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#uploadLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Upload
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="uploadLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url('Kelompok/upload') ?>">Data Kelompok</a>
                                    <a class="nav-link" href="<?php echo base_url('posKas/upload/DEBET') ?>">POS Penerimaan</a>
                                    <a class="nav-link" href="<?php echo base_url('posKas/upload/KREDIT') ?>">POS Pengeluaran</a>
                                    <a class="nav-link" href="<?php echo base_url('Sahamkk/upload') ?>">Saham KK</a>
                                    <a class="nav-link" href="<?php echo base_url('Saham/upload') ?>">Saham Anggota</a>
                                    <a class="nav-link" href="<?php echo base_url('tipeSaham/upload') ?>">Tipe Saham</a>
                                    <a class="nav-link" href="<?php echo base_url('Produk/uploadProduk') ?>">Produk Kredit</a>
                                    <a class="nav-link" href="<?php echo base_url('Pengeluaran/uploadPengeluaran') ?>">Pembelian</a>
                                    
									
                                </nav>
                            </div>
                           

<div class="sb-sidenav-menu-heading">Reporting</div>


									<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Reporting" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Reporting
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="Reporting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="/ub/historyMutasi">History Mutasi</a>
                                            <a class="nav-link" href="/ub/historyResign">History Resign</a>
                                            <a class="nav-link" href="/ub/cetakSaham">Cetak Saham</a>
                                            <a class="nav-link" href="<?php echo base_url('PdfController/cetakLaporanSaham') ?>">Laporan Saham</a>

                                        </nav>
                                    </div>




                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                UB Dashboard
                            </a>


									<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Grafik" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Grafik
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="Grafik" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="/ub/chartBar">Saham KK Kelompok</a>
                                            <a class="nav-link" href="/ub/chart3dDonut">Saham Kelompok</a>
                                            <a class="nav-link" href="/ub/chartLine">Pengeluaran UB</a>
                                            <a class="nav-link" href="/ub/chartPie">Saham UB Kelompok</a>
                                            <a class="nav-link" href="/ub/chartPie2">Saham UB Kategori</a>


                                        </nav>
                                    </div>


						   <div class="sb-sidenav-menu-heading">Lain-lain</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:<?= session()->get('user_name'); ?></div>

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

<?= $this->renderSection('content'); ?>


                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright 2024 UB Bina Syirkah Mandiri</div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
		<script>
		$().ready(function(){
		   $('#kelompok').select2();
		   $('#bulan').select2();
		   $('#tahun').select2();
		   
		});
		</script>
		
          <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/scripts.js"></script>
        <script src="/js/Chart.min.js"></script>
        <script src="/js/chart-area-demo.js"></script>
        <script src="/js/chart-bar-demo.js"></script>
        <script src="/js/simple-datatables.min.js"></script>
        <script src="/js/datatables-simple-demo.js"></script>
    </body>
</html>
