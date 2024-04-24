<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
 
$routes->get('/', 'Login::index');
$routes->post('/ub/auth','Login::auth');
$routes->get('/ub/register','Register::index');
$routes->post('/ub/simpanreg','Register::save');
$routes->get('/ub/logout','Login::logout',['filter' => 'auth']);
$routes->get('/ub/userList','User::index',['filter' => 'auth']);
$routes->get('/ub/gantiPassword','Register::gantiPassword');
$routes->get('/ub/gantiPassword','Register::gantiPassword');
$routes->post('/ub/simpanPassword','Register::simpanPassword');



$routes->get('/ub/member','Saham::index',['filter' => 'auth']);
$routes->get('/ub/kk','Sahamkk::index',['filter' => 'auth']);
$routes->get('ub/rekapKelompok','Kelompok::rekapKelompok',['filter' => 'auth']);

$routes->get('/ub/pelanggan','Pelanggan::index',['filter' => 'auth']);
$routes->get('/ub/penjualan','Penjualan::index',['filter' => 'auth']);
$routes->get('/ub/pengeluaran','Pengeluaran::index',['filter' => 'auth']);
$routes->get('/ub/dbUsers','AddUser::up',['filter' => 'auth']);

$routes->get('/ub/tambahPenjualan','Penjualan::createPenjualan',['filter' => 'auth']);
$routes->post('/ub/simpanPenjualan','Penjualan::simpanPenjualan',['filter' => 'auth']);
$routes->post('/ub/ubahPenjualan','Penjualan::saveEdit',['filter' => 'auth']);
$routes->post('/ub/ubahPengeluaran','Pengeluaran::saveEdit',['filter' => 'auth']);

/* Pembiayaan */
$routes->get('/ub/tambahPelanggan','Pelanggan::createPelanggan',['filter' => 'auth']);
$routes->post('/ub/simpanPelanggan','Pelanggan::simpanPelanggan',['filter' => 'auth']);
$routes->get('/ub/editPelanggan/(:any)','Pelanggan::editPelanggan/$1',['filter' => 'auth']);
$routes->get('/ub/tambahProduk','Produk::createProduk',['filter' => 'auth']);
$routes->get('/ub/produk','Produk::index',['filter' => 'auth']);
$routes->post('/ub/simpanProdukPembiayaan','Produk::simpanProduk',['filter' => 'auth']);
$routes->post('/ub/simpaneditProduk','Produk::saveEdit',['filter' => 'auth']);
$routes->get('/ub/editProduk/(:any)','Produk::editProduk/$1',['filter' => 'auth']);
$routes->delete('/ub/hapusProduk/(:num)', 'Produk::hapus/$1',['filter' => 'auth']);
$routes->get('/ub/pembayaranKredit','Nasabah::nasabahBayar',['filter' => 'auth']);
$routes->get('ub/createBayarKredit/(:num)/(:num)/(:num)','Pembayaran::createBayarKredit/$1/$2/$3');
$routes->post('ub/simpanBayarKredit','Pembayaran::simpanBayarKredit');
$routes->get('ub/rincianBayarKredit/(:num)','Pembayaran::rincianBayarKredit/$1');

//*******Nasabah
$routes->get('/ub/nasabah','Nasabah::index',['filter' => 'auth']);
$routes->get('/ub/tambahNasabah','Nasabah::createNasabah',['filter' => 'auth']);
$routes->post('/ub/simpanNasabah','Nasabah::simpanNasabah',['filter' => 'auth']);
$routes->get('/ub/editNasabah/(:any)','Nasabah::editNasabah/$1',['filter' => 'auth']);
$routes->post('/ub/simpanEditNasabah','Nasabah::saveEdit',['filter' => 'auth']);
$routes->delete('/ub/hapusNasabah/(:num)', 'Nasabah::hapus/$1',['filter' => 'auth']);

//****Mutasi
$routes->get('/ub/mutasi','Mutasi::index',['filter' => 'auth']);
$routes->get('/ub/mutasiSaham/(:any)','Mutasi::formMutasi/$1',['filter' => 'auth']);
$routes->post('/ub/simpanMutasi','Mutasi::simpanMutasi',['filter' => 'auth']);
$routes->get('/ub/historyMutasi','Mutasi::listHistory',['filter' => 'auth']);
$routes->delete('/ub/resign/(:num)', 'Mutasi::formResign/$1',['filter' => 'auth']);
$routes->post('/ub/simpanResign','Mutasi::simpanResign',['filter' => 'auth']);
$routes->get('/ub/historyResign','Mutasi::listResign',['filter' => 'auth']);

//**pos
$routes->get('/ub/posdebet','PosKas::listPOSD',['filter' => 'auth']);
$routes->get('/ub/poskredit','PosKas::listPOSK',['filter' => 'auth']);
$routes->get('/ub/tambahPOSD','PosKas::tambahPOSD',['filter' => 'auth']);
$routes->get('/ub/tambahPOSK','PosKas::tambahPOSK',['filter' => 'auth']);
$routes->post('/ub/simpanPOSK','PosKas::simpanEditPOSK',['filter' => 'auth']);
$routes->post('/ub/simpanPOSD','PosKas::simpanEditPOSD',['filter' => 'auth']);
$routes->get('/ub/editPOSD/(:any)','PosKas::editPOSD/$1',['filter' => 'auth']);
$routes->get('/ub/editPOSK/(:any)','PosKas::editPOSK/$1',['filter' => 'auth']);
$routes->delete('/ub/hapusPOSD/(:num)', 'PosKas::hapusPOSD/$1',['filter' => 'auth']);
$routes->delete('/ub/hapusPOSK/(:num)', 'PosKas::hapusPOSK/$1',['filter' => 'auth']);

//***pdf
$routes->get('/ub/testpdf','PdfController::index');







$routes->get('/ub/createkk','Sahamkk::createkk');
$routes->get('/ub/detail/(:any)','Sahamkk::detail/$1');
$routes->get('/ub/create','Saham::create');
$routes->get('/ub/edit/(:any)','Saham::edit/$1');
$routes->get('/ub/editkk/(:any)','Sahamkk::edit/$1');
$routes->get('/ub/editPenjualan/(:any)','Penjualan::edit/$1');
$routes->get('/ub/editPengeluaran/(:any)','Pengeluaran::edit/$1');
$routes->post('/ub/ubahPengeluaran','Pengeluaran::saveEdit');

$routes->post('/ub/updateSaham','Saham::saveEdit');
$routes->post('/ub/updateSahamKK','SahamKK::saveEdit');
$routes->post('/ub/ubahPelanggan','Pelanggan::saveEdit');

$routes->delete('/ub/hapus/(:num)', 'Saham::hapusSaham/$1');
$routes->delete('/ub/hapuskk/(:num)', 'SahamKK::hapusKK/$1');
$routes->delete('/ub/hapusPelanggan/(:num)', 'Pelanggan::hapus/$1');
$routes->delete('/ub/hapusPenjualan/(:num)', 'Penjualan::hapus/$1');
$routes->delete('/ub/hapusPengeluaran/(:num)', 'Pengeluaran::hapus/$1');
$routes->post('/ub/penjualanBulanan','Penjualan::Bulanan');
$routes->post('/ub/pengeluaranBulanan','Pengeluaran::Bulanan');

$routes->get('/ub/tambahPengeluaran','Pengeluaran::createPengeluaran');

$routes->post('/ub/simpanPengeluaran','pengeluaran::simpanPengeluaran');
$routes->post('/ub/simpanSahamKK','Sahamkk::simpanSahamKK');
$routes->post('/ub/simpanSaham','Saham::simpanSaham');
$routes->get('/ub/kelompok','Kelompok::index');

$routes->get('/ub/report','phpExcel::index');
$routes->get('/ub/excel','phpExcel/exportExcel');
$routes->get('/ub/excelKelompok','phpExcel::exportExcelKelompok');
$routes->get('/ub/hapusKelompok','phpExcel::hapusTableKelompok');
$routes->get('/ub/excelSaham','phpExcel::exportExcelSaham');
$routes->get('/ub/excelSahamKK','phpExcel::exportExcelSahamKK');
$routes->get('/ub/hapusSahamKK','phpExcel::hapusTableSahamKK');

$routes->get('/ub/excelTipeSaham','phpExcel::exportExcelTipeSaham');
$routes->get('/ub/hapusSaham','phpExcel::hapusTableSaham');
$routes->get('/ub/hapusTipeSaham','phpExcel::hapusTipeSaham');

$routes->get('/ub/hapusTablePos/(:any)','phpExcel::hapusTablePos/$1');
$routes->get('/ub/excelPOS/(:any)','phpExcel::exportExcelPos/$1');



$routes->get('/ub/Upload','Upload::index');
$routes->get('/ub/Invoice','Invoice::index');
$routes->post('ub/invoiceKelompokBulanan','Invoice::invoiceBulanan');
$routes->get('/ub/InvoiceDetail/(:num)','Invoice::detailInvoiceId/$1');
$routes->delete('/ub/hapusInvoice/(:num)', 'Invoice::hapus/$1');

$routes->get('ub/tambahInvoice/(:any)/(:any)/(:any)','Invoice::createInvoice/$1/$2/$3');
$routes->post('ub/simpanInvoice','Invoice::simpanInvoice');
$routes->get('/ub/chart','Chart::pie_chart_js');
$routes->get('/ub/chartPie','Chart::pie_highchart');
$routes->get('/ub/chartPie2','Chart::pie_kategoriSaham');
$routes->get('/ub/chartBar','Chart::bar_Saham');
$routes->get('/ub/chart3dDonut','Chart::Donut_Saham');
$routes->get('/ub/chartLine/(:any)','Chart::getDataChartLine/$1');
/***testing */
$routes->get('/ub/pembayaran','Pembayaran::index');
$routes->post('/ub/PostingBayar','Pembayaran::index');
$routes->get('ub/createBayar/(:num)/(:num)','Pembayaran::createBayar/$1/$2');
$routes->post('ub/simpanBayar','Pembayaran::simpanBayar');
$routes->get('/ub/daftarSahamKelompok/(:any)','Sahamkk::daftarSahamKelompok/$1');
$routes->get('/ub/detailBayar/(:any)','Pembayaran::detailBayar/$1');

$routes->get('ub/listConfig','Config::index');
$routes->get('/ub/tambahConfig','Config::tambahConfig');
$routes->get('ub/editConfig/(:num)','Config::editConfig/$1');
$routes->post('ub/simpanEditConfig','Config::simpanEditConfig');
$routes->post('/ub/simpanConfig','Config::simpanConfig');
$routes->delete('/ub/hapusConfig/(:num)', 'Config::deleteConfig/$1');

$routes->post('/ub/simpanExcel','Kelompok::simpanExcel');

// Sahamkk::upload

$routes->post(base_url('Pengeluaran/uploadPengeluaran'),'Pengeluaran::uploadPengeluaran');
$routes->post('/ub/simpanExcelSahamKK','Sahamkk::simpanExcelSahamKK');
$routes->post('/ub/simpanExcelSaham','Saham::simpanExcelSaham');
$routes->post('/ub/simpanExcelTipeSaham','tipeSaham::simpanExcelTipeSaham');
$routes->post('/ub/simpanExcelPos/(:any)','posKas::simpanExcelPos/$1');
$routes->get('/ub/loader','loader::index');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
*/

//$routes->setDefaultController('GoogleBarChart');
$routes->match(['get', 'post'], '/ub/GoogleBarChart/initChart', 'GoogleBarChart::initChart');


$routes->get('/ub/cetakSaham','Saham::listCetakSaham');


