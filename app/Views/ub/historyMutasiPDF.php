<html>
<head>
<style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>
    <div class="container-fluid px-4">
       <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?= $title ?>
            </div>

			<div class="card-body">
              <table id="datatablesSimple" border=1>
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NO KK LAMA</th>
                    <th scope="col">NO KK BARU</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">TGL MUTASI</th>
                    <th scope="col">ALASAN</th>
                    
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    foreach($data_history as $saham){
                  ?>

                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $saham->no_kk_lama ?></td>
                      <td><?= $saham->no_kk ?></td>
                      <td><?= $saham->nama ?></td>
                      <td><?= $saham->tgl_mutasi ?></td>
                      <td><?= $saham->alasan ?></td>
                      
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
</body>
</html>