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
                margin-top:    2cm;
                margin-bottom: 0cm;
                margin-left:   3cm;
                margin-right:  3cm;
            }

            /** 
            * Define the width, height, margins and position of the watermark.
            **/
            #watermark {
                position: fixed;
                bottom:   0px;
                left:     0px;
                /** The width and height may change 
                    according to the dimensions of your letterhead
                **/
                width:    21.8cm;
                height:   28cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
			table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.center {
  text-align: center;
font-family: <?= $data_config['SAHAM_FONT_H1'] ?>;	

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
font-family: <?= $data_config['SAHAM_FONT_H1'] ?>;	
  z-index: 0;

}	
h2{
   color : <?= $data_config['SAHAM_WARNA_H2'] ?>;
   font-family: <?= $data_config['SAHAM_FONT_H2'] ?>;
   font-weight: bold;   
  z-index: 0;

}
.tanggal{
	margin-left: 500px;
	margin-bottom: 500px;	
	font-weight: bold;   

}
	

        </style>
    </head>
<body>
		<?php 
		// This will output the barcode as HTML output to display in the browser
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		?>
        <main> 
            <!-- The content of your PDF here -->
			<div class="barcode">
			<?= $generator->getBarcode($data_saham['nama'], $generator::TYPE_CODE_128) ?>
			</div>
			
			<div class="center">
			<h2>SURAT SAHAM</h2>
			<h1>UB. <?= $data_config['NAMA_UB'] ?></h1>
			</div>
			
			<div class="center">
			<h3>No Seri / No KK / Tgl Join	: <?= $data_saham['id'] ?>/<?= $data_saham['no_kk'] ?>/<?= $data_saham['tgl_join'] ?></h3>
			</div>
			
			<div class="center">
			<h4>Berdasarkan hasil MPPS :</h4>
			<h4>UB.<?= $data_config['NAMA_UB'] ?>&nbsp;Desa : <?= $data_config['NAMA_DESA'] ?>&nbsp;<?= $data_config['NAMA_DAERAH'] ?> menerbitkan Sertifikat Saham senilai Rp. <?= number_format($data_saham['harga_saham']) ?>&nbsp;( <?= $terbilang_nominal ?> )</h4>
			
			<h2>Pemilik Saham</h2>
			<h1><?= $data_saham['nama'] ?></h1>
			<h4><u>Jumlah Saham : <?= $data_saham['jml_saham'] ?> Lembar</u></h4>
			</div>
			
			<div class="kiri">
			<h4>Terbilang		:	<?= $terbilang_total ?></h4>
			<h4>Alamat			:	<?= $data_saham['alamat'] ?></h4>
			<h4>No Telpon		:	<?= $data_saham['hp'] ?></h4>
			</div>
			
        </main>
    </body>
</html>