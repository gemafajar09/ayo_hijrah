<?php

switch($_GET[act]){
  default:
?>

<section class="content-header">
      <h1>
        Kota
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kota</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-lg-6">
                    <input type="file" name="file"><br/>

                    <button type="submit" name="upload" class="btn btn-flat btn-success"><i class="fa fa-upload"></i> Import Data</button>
                  </div>
                </div>
              </form> -->
              <a href="?page=kota&act=add"  class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					           <th>No</th>
					           <th>Nama Provinsi</th>
                     <th>Nama Kota</th>
                     <th>Ongkos Kirim</th>
                     <th></th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_kota LEFT JOIN tbl_provinsi ON tbl_kota.id_prov=tbl_provinsi.id_prov");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						    ?>

						      <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
						          <td><?php echo  $r["nama_prov"]; ?></td>
                      <td><?php echo  $r["nama_kota"]; ?></td>
                      <td><?php echo  $r["ongkir"]; ?></td>
                      <td>
                        <a href="?page=kota&act=update&id=<?php echo"$r[id_kota]" ?>" class="btn btn-primary btn-xs fa fa-pencil"></a>
                        <a href="?page=jota&act=hapus&id=<?php echo"$r[id_kota]" ?>" class="btn btn-danger btn-xs fa fa-remove"></a>
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
      $nama_kota = $_POST['nama_kota'];
      $ongkir = $_POST['ongkir'];

      $save=mysqli_query($con, "INSERT INTO `tbl_kota`(`id_prov`, `nama_kota`) VALUES( '$prov','$nama_kota','$ongkir')");
      if($save) {
        echo "<script>
            window.location='?page=kota';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }

    $ta=mysqli_query($con,"SELECT * FROM tbl_provinsi");
    $ko=mysqli_query($con,"SELECT * FROM tbl_kota");
?>
  <section class="content-header">
      <h1>
        Kota
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Kota</li>
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
                   <select class="form-control" name="prov" onChange='DinamisDaerah(this);' id="d">
                     <?php
                      while ($data=mysqli_fetch_array($ta)) {
                        echo"<option value='$data[id_prov]'>$data[nama_prov]</option>";
                      }
                     ?>
                   </select>
                </div>
              </div>

                <div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Nama Kota</label>
                  <div class="col-sm-4">
                      <input type="text" name="nama_kota" id="nmkat" class="form-control"  placeholder="Nama Kota">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Ongkir</label>
                  <div class="col-sm-4">
                    <input type="text" name="ongkir" id="nmkat" class="form-control"  placeholder="Ongkir">
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

    $t=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_kota LEFT JOIN tbl_provinsi ON tbl_kota.id_prov=tbl_provinsi.id_prov WHERE id_kota='$_GET[id]'"));

    if(isset($_POST['save'])){
      $prov = $_POST['prov'];
      $nama_kota = $_POST['nama_kota'];
      $ongkir = $_POST['ongkir'];

      $save=mysqli_query($con, "UPDATE tbl_kota SET ongkir='$ongkir' WHERE id_kota='$_GET[id]'");
      if($save) {
        echo "<script>
            window.location='?page=kota';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }

    $pr=mysqli_query($con,"SELECT * FROM tbl_provinsi");
?>

<section class="content-header">
      <h1>
        Kota
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kota</li>
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
                    <select class="form-control" name="prov" readonly>
                     <?php
                              while($data=mysqli_fetch_array($pr)) {
                                if($t[id_prov]==$data[id_prov]){
                                    $sel="selected";}else{$sel="";}
                                    echo"<option value='$data[id_prov]' $sel>$data[nama_prov]</option>";
                              }
                            ?>
                   </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Nama Kota</label>
                  <div class="col-sm-4">
                    <input type="text" readonly name="nama_kota" value="<?php echo "$t[nama_kota]"?>" id="nmkat" class="form-control"  placeholder="Nama Kota">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nmkat" class="col-sm-2 control-label">Ongkir</label>
                  <div class="col-sm-4">
                    <input type="text" name="ongkir" value="<?php echo "$t[ongkir]"?>" id="nmkat" class="form-control"  placeholder="Ongkir">
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
      mysqli_query($con, "DELETE FROM tbl_kota where id_kota='$_GET[id]'");
      echo "<script>
              window.location='index.php?page=kota';
            </script>";
    }
  break;
}
?>
