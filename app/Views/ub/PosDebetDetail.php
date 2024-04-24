<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

    <div class="container" style="margin-top: 15px">
      
	<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>      
	    
	  
	  <div class="row">

<div class="col-md-3">

			  <a href="<?php echo base_url() ?>ub/tambahPOSD" class="btn btn-md btn-success" style="margin-bottom: 10px">INPUT POS DEBET</a>
             <?php if(session()->getFlashdata('pesan')): ?>
<div class="alert alert-success" role="alert">
<?=  session()->getFlashdata('pesan'); ?>
</div>
<?php endif ?>

</div>

</div>
<div class="col-md-2">
                
    <input type="hidden" name="_method" value="beli"></input>
 
</div>
<div class="col-md-2">

</div>


        <div class="col-md-12">
          <div class="card">
            
			<div class="card-header">
              <?= $title ?>
            </div>
            
			<div class="card-body">
              
              <table class="table table-bordered" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NAMA POS</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_pos)){
					foreach($data_pos as $p){
				  ?>

                  <tr>
                      <td><?= $no++ ?></td>
  <td><?php echo $p->nama_pos ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editPOSD/<?= $p->id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url() ?>ub/hapusPOSD/<?= $p->id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus Data POS DEBET?')">Delete</button>

  </form>
                      </td>
                  </tr>
                <?php }
                } ?>
                </tbody>
              </table>

            </div>
          </div>
      </div>
    </div>
<script>
$().ready(function(){
  
})

</script>
<?= $this->endSection(); ?>
