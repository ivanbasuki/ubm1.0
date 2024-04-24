<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #000000;
			  text-align: center;
			  height: 20px;
			  margin: 8px;
			}

			.kanan {
			    margin-left: 400px;
                margin-top: 10px;				
			}	

		</style>
	</head>
			<?php 
		// This will output the barcode as HTML output to display in the browser
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		?>

	<body>
		<div style="font-size:64px; color:'#dddddd'"><i>Kuitansi</i></div>			
			<?php //$generator->getBarcode($data_kredit['nama_pelanggan'], $generator::TYPE_CODE_128) ?>
		<div class="kanan">
		<i>UB. Bina Syirkah Mandiri</i><br>
		Desa KembangArum & Tugu Semarang Barat
		</div>
		<hr>
		<p>
			Nama: <?= $data_kredit['nama_pelanggan'] ?><br>
			Kelompok : <?= $data_kredit['nama_klp'] ?><br>
			Transaksi No : <?= $data_kredit['no_bayar'] ?><br>
			Tanggal : <?= date('Y-m-d', strtotime($data_kredit['tgl_bayar'])) ?><br> 
		</p>
		<table cellpadding="6" >
			<tr>
				<th><strong>Nama Barang</strong></th>
				<th><strong>Harga Jual</strong></th>
				<th><strong>DP</strong></th>
				<th><strong>Pembayaran</strong></th>
				<th><strong>Keterangan</strong></th>
			</tr>
			<tr>
				<td><?= $data_kredit['nama_barang'] ?></td>
				<td><?= "Rp " . number_format($data_kredit['harga_jual'],2,',','.')  ?></td>
				<td><?= "Rp " . number_format($data_kredit['dp'],2,',','.')  ?></td>
				<td><?= "Rp " . number_format($data_kredit['jumlah'],2,',','.')  ?></td>
				<td><?= $data_kredit['keterangan'] ?></td>
			
			</tr>
			<tr>
			<td>Terbilang</td>
			<td colspan="4"><?= $terbilang ?></td>
			
			</tr>
			<tr>
			<td>Sisa Hutang</td>
			<td colspan="4"><?= "Rp " . number_format($terhutang,2,',','.') ?></td>
			
			</tr>

		</table>
	</body>
</html>