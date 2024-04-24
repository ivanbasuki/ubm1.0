<html>
    <head>
        <style>
            /** 
            * Set the margins of the PDF to 0
            * so the background image will cover the entire page.
            **/
            @page {
                margin: 0cm 0cm;
            }

            /**
            * Define the real margins of the content of your PDF
            * Here you will fix the margins of the header and footer
            * Of your background image.
            **/
            body {
                margin-top:    <?= $data_config['SAHAM_MT'] ?>;
                margin-bottom: <?= $data_config['SAHAM_MB'] ?>;
                margin-left:   <?= $data_config['SAHAM_ML'] ?>;
                margin-right:  <?= $data_config['SAHAM_MR'] ?>;
            }

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.center {
  text-align: center;
  margin-left: auto;
  margin-right: auto;
   font-weight: bold;   

}

.kiri{
	margin-left: 25px;	
   font-weight: bold;   

  z-index: 0;

}
h1{
   color : <?= $data_config['SAHAM_WARNA_H1'] ?>;
   font-weight: bold;	
  z-index: 0;

}	
h2{
   color : <?= $data_config['SAHAM_WARNA_H2'] ?>;
   font-weight: bold;   
  z-index: 0;

}	

        </style>
    </head>
<body>
        <div id="watermark">
		<img src="<?= $file ?>"></img>
         </div>

        <main> 
            <!-- The content of your PDF here -->
			<div class="center">
			<p>
			<h2>SURAT SAHAM</h2>
			<h1>UB. <?= $data_config['NAMA_UB'] ?></h1>
			</div>
			
			<div class="kiri">
			<h3>No Seri 	: <?= $data_saham['id'] ?></h3>
			<h3>No KK 		: <?= $data_saham['no_kk'] ?></h3>
			<h3>Tgl Join	: <?= $data_saham['tgl_join'] ?></h3>
			</div>
			
			<div class="center">
			<h4>Berdasarkan hasil MPPS :</h4>
			<h4>UB.<?= $data_config['NAMA_UB'] ?>&nbsp;Desa : <?= $data_config['NAMA_DESA'] ?>&nbsp;<?= $data_config['NAMA_DAERAH'] ?> telah menerbitkan Sertifikat Saham senilai Rp. <?= number_format($data_saham['harga_saham']) ?>&nbsp;( <?= $terbilang_nominal ?> )</h4>
			
			<h2>Pemilik Saham</h2>
			<h1><?= $data_saham['nama'] ?></h1>
			<h4><u>Jumlah Saham : <?= $data_saham['jml_saham'] ?> Lembar</u></h1>
			
			<h4>
			</div>
			
			<div class="kiri">
			<h4>Terbilang		:	<?= $terbilang_total ?></h4>
			<h4>Alamat			:	<?= $data_saham['alamat'] ?></h4>
			<h4>No Telpon		:	<?= $data_saham['hp'] ?></h4>
			
			</div>
			
        </main>
    </body>
</html>