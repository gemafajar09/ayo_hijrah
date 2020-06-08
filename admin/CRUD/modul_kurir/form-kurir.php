<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahkurir" :

    if(isset($_POST['save'])){

      $save=mysqli_query($con, "INSERT INTO tbl_kurir VALUES('', '$_POST[nama_kurir]', '$_POST[biaya]', '$_POST[alamat]'
	  , '$_POST[no_telp]')");
      if($save) {
        echo "<script>
            window.location='?page=kurir';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }
?>
<section class="content-header">
      <h1>
        Kategori
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Kategori</li>
      </ol>
</section>
<!-- Content Header (Page header) -->
  <section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">

         </div>
            <!-- form start -->
            <form method="POST" class="form-horizontal" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Nama Kurir</label>
                  <div class="col-sm-4">
                    <input type="text" name="nama_kurir" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>
				<div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Biaya</label>
                  <div class="col-sm-4">
                    <input type="text" name="biaya" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>
				<div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <input type="text" name="alamat" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>
				<div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">No Telephone</label>
                  <div class="col-sm-4">
                    <input type="text" name="no_telp" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                  </div>
                </div>
			         </div>
            </form>
          </div>
        </div>
    </div>
</section>

<?php
    break;
    case "editkurir":
    if(isset($_GET['id_kurir'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_kurir where id_kurir='$_GET[id_kurir]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $save=mysqli_query($con, "UPDATE tbl_kurir set nama_kurir='$_POST[nama_kurir]', biaya='$_POST[biaya]'
,	alamat='$_POST[alamat]', no_telp='$_POST[no_telp]'	  where  id_kurir='$_GET[id_kurir]'");
      if($save) {
        echo "<script>
               window.location='?page=kurir';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Kategori
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kategori</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">

         </div>

            <!-- form start -->
            <form action="" method="POST" class="form-horizontal">
              <div class="box-body ">
                <div class="form-group" >
                  <label for="nmkat" class="col-sm-2 control-label">Nama Kurir</label>
                  <div class="col-sm-4">
                    <input type="text" name="nama_kurir" id="nmkat" class="form-control"  value="<?= $data['nama_kurir']; ?>">
                  </div>
                </div>
				<div class="form-group" >
                  <label for="nmkat" class="col-sm-2 control-label">Biaya</label>
                  <div class="col-sm-4">
                    <input type="text" name="biaya" id="nmkat" class="form-control"  value="<?= $data['biaya']; ?>">
                  </div>
                </div>
				<div class="form-group" >
                  <label for="nmkat" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-4">
                    <input type="text" name="alamat" id="nmkat" class="form-control"  value="<?= $data['alamat']; ?>">
                  </div>
                </div>
				<div class="form-group" >
                  <label for="nmkat" class="col-sm-2 control-label">No Telephone</label>
                  <div class="col-sm-4">
                    <input type="text" name="no_telp" id="nmkat" class="form-control"  value="<?= $data['no_telp']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>
<?php
    break;
    case "hapuskurir" :

    if(isset($_GET['id_kurir'])){
      mysqli_query($con, "DELETE FROM tbl_kurir where id_kurir='$_GET[id_kurir]'");
    	echo "<script>
    					window.location='index.php?page=kurir';
    				</script>";
    }
?>
<?php
break;
}
}else{
?>

<section class="content-header">
      <h1>
        Kategori
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kategori</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?page=kurir&aksi=tambahkurir" class="btn btn-flat btn-primary">Tambah Kurir</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					           <th>No</th>
					           <th>Nama Kurir</th>
							   <th>Biaya</th>
							   <th>Alamat</th>
							   <th>No Telephone</th>
					           <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_kurir");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						    ?>

						      <tr>
						<td width='0' class='center'><?php echo $no; ?></td>
						<td><?php echo  $r["nama_kurir"]; ?></td>
						<td><?php echo  $r["biaya"]; ?></td>
						<td><?php echo  $r["alamat"]; ?></td>
						<td><?php echo  $r["no_telp"]; ?></td>
          				<td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=kurir&aksi=editkurir&id_kurir=<?php echo $r['id_kurir']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
						<a class='btn btn-danger btn-xs' title='Delete Data' href='?page=kurir&aksi=hapuskurir&id_kurir=<?php echo $r['id_kurir'];?>'><span class='glyphicon glyphicon-remove'></span></a>
						</td>
					</tr>
					<?php
						$no++;
          				}
          		    ?>
				      </tbody>
            </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
          <!-- /.box -->
     </section>
<?php } ?>
