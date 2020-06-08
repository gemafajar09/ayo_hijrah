<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahfaq" :

    if(isset($_POST['save'])){
      $judulseo = seo_title($_POST['seo_garansi']);
       $save = mysqli_query($con, "INSERT INTO `tbl_garansi`(`judul_garansi`, `isi_tex`, `seo_garansi`) VALUES ('$_POST[judul_garansi]', '$_POST[isi_tex]','$judulseo')");
      if($save) {
        echo "<script>
            window.location='?page=garansi';
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
        Garansi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Garansi</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Judul</label>
                  <div class="col-sm-4">
                    <input type="text" name="judul_faq" id="nmkat" class="form-control"  placeholder="Nama Kategori">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="des" class="col-sm-2 control-label">Isi </label>
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
    case "editgaransi":
    if(isset($_GET['id_garansi'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_garansi where id_garansi='$_GET[id_garansi]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $judulseo = seo_title($_POST['seo_garansi']);
      $save=mysqli_query($con, "UPDATE tbl_garansi set judul_garansi='$_POST[judul_garansi]',isi_tex='$_POST[isi_tex]', seo_garansi='$judulseo' where  id_garansi='$_GET[id_garansi]'");
      if($save) {
        echo "<script>
               window.location='?page=garansi';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Garansi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Garansi</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Judul </label>
                  <div class="col-sm-4">
                    <input type="text" name="judul_garansi" id="nmkat" class="form-control"  value="<?= $data['judul_garansi']; ?>">
                  </div>
                </div>

				<div class="form-group">
            <label for="des" class="col-sm-2 control-label">Isi</label>
              <div class="col-sm-6">
                <textarea name="isi_tex" id="des" class="form-control textarea" cols="5" rows="10"><?= $data['isi_tex']; ?></textarea>
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
          				$q=mysqli_query($con, "SELECT * from tbl_garansi");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						    ?>

						<tr>
						<td width='0' class='center'><?php echo $no; ?></td>
						<td><?php echo  $r["judul_garansi"]; ?></td>
						<td><?php echo  $r["isi_tex"]; ?></td>
          				    <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=garansi&aksi=editgaransi&id_garansi=<?php echo $r['id_garansi']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
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
