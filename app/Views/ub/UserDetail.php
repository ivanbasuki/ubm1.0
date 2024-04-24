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

			  <a href="<?php echo base_url() ?>ub/register" class="btn btn-md btn-success" style="margin-bottom: 10px">User Baru</a>
             
</div>

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
                    <th scope="col">NAMA USER</th>
					<th scope="col">EMAIL</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    $no = 1;
                    if(!empty($data_user)){
					foreach($data_user as $p){
				  ?>

                  <tr>
                      <td><?= $no++ ?></td>
  <td><?php echo $p->user_name ?></td>
  <td><?php echo $p->user_email ?></td>
  
                      <td class="text-center">
                        <a href="<?php echo base_url() ?>ub/editUser/<?= $p->user_id ?>" class="btn btn-sm btn-primary">EDIT</a>
                        
                        <form method="post" action="<?php echo base_url() ?>ub/hapusUser/<?= $p->user_id ?>" class="d-inline">
    <input type="hidden" name="_method" value="delete"></input>
    <button id="konfirm" type="submit" class="btn btn-danger" onclick="return confirm('Mau Hapus User?')">Delete</button>

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
