<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahmerek" :
    if(isset($_POST['save'])){
      $judulseo = seo_title($_POST['nama_merek']);
      $save = mysqli_query($con, "INSERT INTO `tbl_merek`(`id_kategori`, `nama_merek`, `seo_merek`) VALUES( '$_POST[id_kategori]','$_POST[nama_merek]','$judulseo')");
      if($save) {
      echo"<script language=javascript>
            window.location='?page=merek';
            </script>";
            exit;
          }else{
            echo"gagal";
          }
    }
?>
<section class="content-header">
      <h1>
        Merek
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Merek</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
            <!-- form start -->
            <form action="" method="POST" class="form-horizontal">
              <div class="box-body ">
                <div class="form-group" >
                  <label for="nmkat" class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-4">
                      <select type="text" name="id_kategori" id="nmkat" class="form-control"  >
					             <option value="">--Pilih Kategori--</option>
						            <?php
							           $result = mysqli_query($con, "select * from tbl_kategori");
							           while ($row = mysqli_fetch_array($result)) {
								          echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . '</option>';
							            }
						            ?>
					           </select>
				          </div>
              </div>
        			<div class="form-group" >
                <label for="nmsub" class="col-sm-2 control-label">Merek</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_merek" id="nmsub" class="form-control"  placeholder="Merek">
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
<section>
<?php
      break;
      case "editmerek":
      if(isset($_GET['id_merek'])){
        $judulseo = seo_title($_POST['nama_merek']);
        $sqlk = mysqli_query($con, "SELECT * FROM tbl_merek,tbl_kategori where tbl_merek.id_kategori=tbl_kategori.id_kategori AND id_merek='$_GET[id_merek]'");
        $data=mysqli_fetch_assoc($sqlk);
      }

      if(isset($_POST['save'])){
        $save=mysqli_query($con, "UPDATE tbl_merek set nama_merek='$_POST[nama_merek]',seo_merek='$judulseo' where id_merek='$_GET[id_merek]'");
        if($save) {
        echo"<script language=javascript>
              window.location='?page=merek';
              </script>";
            }else{
              echo "<script>alert('Gagal');
                  </script>";
            }
      }
?>
<section class="content-header">
      <h1>
        Merek
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Merek</li>
      </ol>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
   <div class="box box-info">
        <!-- form start -->
        <form action="" method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group" >
              <label class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-4">
                <input type="text" name="id_kategori" class="form-control"  value="<?= $data['nama_kategori']; ?>" disabled>
              </div>
            </div>

            <div class="form-group" >
              <label for="nmsub" class="col-sm-2 control-label">Merek</label>
              <div class="col-sm-4">
                <input type="text" name="nama_merek" id="nmsub" class="form-control"  value="<?= $data['nama_merek']; ?>">
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
    case "hapusmerek" :
    if(isset($_GET['id_merek'])){
      mysqli_query($con, "DELETE FROM tbl_merek where id_merek='$_GET[id_merek]'");
    	echo "<script>
    					window.location='index.php?page=merek';
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
        Merek
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Merek</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?page=merek&aksi=tambahmerek" class="btn btn-flat btn-primary">Tambah Merek</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
					               <th>No</th>
					               <th>Nama Kategori</th>
					               <th>Merek</th>
					               <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>
              			<?php
              				$q=mysqli_query($con, "SELECT * from tbl_merek,tbl_kategori where tbl_merek.id_kategori=tbl_kategori.id_kategori");
              				$no=1;
              				while($r=mysqli_fetch_array($q)){
    						    ?>

						        <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
						          <td><?php echo  $r["nama_kategori"]; ?></td>
						          <td><?php echo  $r["nama_merek"]; ?></td>
          				    <td>
                          <a class='btn btn-success btn-xs' title='Edit Data' href='?page=merek&aksi=editmerek&id_merek=<?php echo $r['id_merek']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
							           <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=merek&aksi=hapusmerek&id_merek=<?php echo $r['id_merek'];?>'><span class='glyphicon glyphicon-remove'></span></a>
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
