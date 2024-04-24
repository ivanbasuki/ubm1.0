<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
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
                margin-top:    3.5cm;
                margin-bottom: 1cm;
                margin-left:   1cm;
                margin-right:  1cm;
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
        </style>

</head>
	
<body>
<div id="watermark">
            <img src="/img/ldii.jpg" height="50%" width="50%" />
        </div>

<main>
              <table border=1>
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">ID KK</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">HP</th>
                    <th scope="col">Tgl Join</th>
					<th scope="col">Kode Saham</th>
					<th scope="col">Jumlah</th>
					<th scope="col">Harga Saham</th>
					<th scope="col">Total</th>
					
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
					$total=0;
                    foreach($data_saham as $saham){
					$total=$saham['jml_saham']*$saham['harga_saham'];
				  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $saham['no_kk'] ?></td>
                      <td><?= $saham['nama'] ?></td>
                      <td><?= $saham['alamat'] ?></td>
                      <td><?= $saham['hp'] ?></td>
                      <td><?= $saham['tgl_join'] ?></td>
					  <td><?= $saham['kode_saham'] ?></td>
					  <td><?= $saham['jml_saham'] ?></td>
                      <td><?= number_format($saham['harga_saham']) ?></td>
                      <td><?= number_format($total) ?></td>
                     
                  </tr>
                <?php } ?>
                </tbody>
              </table>
 </main>
 
 </body>
</html>