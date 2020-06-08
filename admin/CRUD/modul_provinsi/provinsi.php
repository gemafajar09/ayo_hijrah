<?php
switch($_GET[act]){

  default:


  if(isset($_POST["upload"]))
  {
   $file = $_FILES['file']['tmp_name'];
   $handle = fopen($file, "r");
   $c = 0;
   while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
   {
   $id_prov = $filesop[0];
   $nama_prov = $filesop[1];

   $sql = mysqli_query($con, "INSERT INTO tbl_provinsi (id_prov,nama_prov) VALUES ('$id_prov','$nama_prov')");
   }

   if($sql){
     echo "<script>alert('Data Berhasil di Import');
             window.location='index.php?page=provinsi';
           </script>";
   }else{
   echo "<script>alert('Data Gagal di Import');
           window.location='index.php?page=provinsi';
         </script>";
   }
  }

  if(isset($_POST["exp"]))
  {
    ExportExcel("tbl_provinsi");
  }
?>

<section class="content-header">
      <h1>
        Provinsi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Provinsi</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data" >
                <div class="form-group">
                  <div class="col-lg-6">
                    <input type="file" name="file" ><br/>
                    <button type="submit" name="upload" class="btn btn-flat btn-success"><i class="fa fa-upload"></i> Import Data</button>
                  </div>
                </div>
              </form>
               <a href="?page=provinsi&act=add"  class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					           <th>No</th>
					           <th>Nama Provinsi</th>
                     <th></th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_provinsi");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						    ?>

						      <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
						          <td><?php echo  $r["nama_prov"]; ?></td>
                      <td>
                        <a href="?page=provinsi&act=update&id=<?php echo"$r[id_prov]" ?>" class="btn btn-primary btn-xs fa fa-pencil"></a>
                        <a href="?page=provinsi&act=hapus&id=<?php echo"$r[id_prov]" ?>" class="btn btn-danger btn-xs fa fa-remove"></a>
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

<?php 
  break;
  case "add":

  if(isset($_POST['save'])){
      $prov = $_POST['prov'];
      $save = mysqli_query($con, "INSERT INTO `tbl_provinsi`(`nama_prov`) VALUES( '$prov')");
      if($save) {
        echo "<script>
            window.location='?page=provinsi';
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
        Provinsi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Provinsi</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Nama Provinsi</label>
                  <div class="col-sm-4">
                    <input type="text" name="prov" id="nmkat" class="form-control"  placeholder="Nama Provinsi">
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
    case "update";

    $t=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_provinsi WHERE id_prov='$_GET[id]'"));

    if(isset($_POST['save'])){
      $prov = $_POST['prov'];
      $save=mysqli_query($con, "UPDATE tbl_provinsi SET nama_prov='$prov' WHERE id_prov='$_GET[id]'");
      if($save) {
        echo "<script>
            window.location='?page=provinsi';
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
        Provinsi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Provinsi</li>
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
                  <label for="nmkat" class="col-sm-2 control-label">Nama Provinsi</label>
                  <div class="col-sm-4">
                    <input type="text" name="prov" value="<?php echo "$t[nama_prov]"?>" id="nmkat" class="form-control"  placeholder="Nama Provinsi">
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
    case "hapus" :

    if(isset($_GET['id'])){
      mysqli_query($con, "DELETE FROM tbl_provinsi where id_prov='$_GET[id]'");
      echo "<script>
              window.location='index.php?page=provinsi';
            </script>";
    }
  break;
}
?>