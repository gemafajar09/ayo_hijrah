<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahfaq" :

    if(isset($_POST['save'])){
      $judulseo = seo_title($_POST['judul_faq']);
      $save = mysqli_query($con, "INSERT INTO `tbl_faq`(`judul_faq`, `isi_faq`, `judul_seo`) VALUES('$_POST[judul_faq]', '$_POST[isi_faq]','$judulseo')");
      if($save) {
        echo "<script>
            window.location='?page=faq';
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
        Faq
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Faq</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Judul Faq</label>
                  <div class="col-sm-4">
                    <input type="text" name="judul_faq" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="des" class="col-sm-2 control-label">Isi Faq</label>
                  <div class="col-sm-6">
                    <textarea name="isi_faq" id="des" class="form-control textarea"  placeholder="Deskripsi" col="5" rows="10"></textarea>
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
    case "editfaq":
    if(isset($_GET['id_faq'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_faq where id_faq='$_GET[id_faq]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $judulseo = seo_title($_POST['judul_faq']);
      $save=mysqli_query($con, "UPDATE tbl_faq set judul_faq='$_POST[judul_faq]',isi_faq='$_POST[isi_faq]', judul_seo='$judulseo' where  id_faq='$_GET[id_faq]'");
      if($save) {
        echo "<script>
               window.location='?page=faq';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Faq
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Faq</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Judul Faq</label>
                  <div class="col-sm-4">
                    <input type="text" name="judul_faq" id="nmkat" class="form-control"  value="<?= $data['judul_faq']; ?>">
                  </div>
                </div>

				<div class="form-group">
            <label for="des" class="col-sm-2 control-label">Isi</label>
              <div class="col-sm-6">
                <textarea name="isi_faq" id="des" class="form-control textarea" cols="5" rows="10"><?= $data['isi_faq']; ?></textarea>
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
    case "hapusfaq" :

    if(isset($_GET['id_faq'])){
      mysqli_query($con, "DELETE FROM tbl_faq where id_faq='$_GET[id_faq]'");
    	echo "<script>
    					window.location='index.php?page=faq';
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
        faq
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">faq</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?page=faq&aksi=tambahfaq" class="btn btn-flat btn-primary">Tambah Faq</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					           <th>No</th>
					           <th>Judul</th>
							   <th>Isi</th>
					           <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_faq");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						    ?>

						<tr>
						<td width='0' class='center'><?php echo $no; ?></td>
						<td><?php echo  $r["judul_faq"]; ?></td>
						<td><?php echo  $r["isi_faq"]; ?></td>
          				    <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=faq&aksi=editfaq&id_faq=<?php echo $r['id_faq']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
							          <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=faq&aksi=hapusfaq&id_faq=<?php echo $r['id_faq'];?>'><span class='glyphicon glyphicon-remove'></span></a>
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
