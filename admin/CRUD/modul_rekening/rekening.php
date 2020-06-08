
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editrekening":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_bank where id_bank='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $save=mysqli_query($con, "UPDATE tbl_bank set nm_bank='$_POST[nm_bank]', no_rek='$_POST[no_rek]',atas_nama='$_POST[atas_nama]'  where  id_bank='$_GET[id]'");
      if($save) {
        echo "<script>
               window.location='?page=rekening';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Informasi No Rekening
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi No Rekening</li>
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
                <div class="form-group">
                     <label for="nm_bank" class="col-sm-2 control-label">Nama Bank</label>
                     <div class="col-sm-8">
                       <input type="text" id="nm_bank" name="nm_bank" class="form-control" value="<?= $data['nm_bank']?>">
                     </div>
                 </div>
                 <div class="form-group">
                      <label for="no_rek" class="col-sm-2 control-label">No Rekening</label>
                      <div class="col-sm-8">
                        <input type="text" id="no_rek" name="no_rek" class="form-control" value="<?= $data['no_rek']?>">
                      </div>
                  </div>
                  <div class="form-group">
                       <label for="atas_nama" class="col-sm-2 control-label">Atas Nama</label>
                       <div class="col-sm-8">
                         <input type="text" id="atas_nama" name="atas_nama" class="form-control" value="<?= $data['atas_nama']?>">
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
  case "tambahrekening":
  if(isset($_POST['save'])){
        $save=mysqli_query($con, "INSERT INTO `tbl_bank`(`nm_bank`, `no_rek`, `atas_nama`) VALUES( '$_POST[nm_bank]','$_POST[no_rek]','$_POST[atas_nama]')");
    if($save) {
      echo "<script>alert('Tambah Data Berhasil');
          window.location='?page=rekening';
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
        Informasi No Rekening
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi No Rekening</li>
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
                <div class="form-group">
                     <label for="nm_bank" class="col-sm-2 control-label">Nama Bank</label>
                     <div class="col-sm-8">
                       <input type="text" id="nm_bank" name="nm_bank" class="form-control">
                     </div>
                 </div>
                 <div class="form-group">
                      <label for="no_rek" class="col-sm-2 control-label">No Rekening</label>
                      <div class="col-sm-8">
                        <input type="text" id="no_rek" name="no_rek" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                       <label for="atas_nama" class="col-sm-2 control-label">Atas Nama</label>
                       <div class="col-sm-8">
                         <input type="text" id="atas_nama" name="atas_nama" class="form-control">
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
    case "hapusrekening" :

    if(isset($_GET['id'])){
      mysqli_query($con, "DELETE FROM tbl_bank where id_bank='$_GET[id]'");
    	echo "<script>
    					window.location='index.php?page=rekening';
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
        Informasi No Rekening
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi No Rekening</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?page=rekening&aksi=tambahrekening" class="btn btn-flat btn-primary">Tambah Rekening</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama Bank</th>
                     <th>No Rekening</th>
					           <th>Atas Nama</th>
					           <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_bank");
                  $no = 0;
          				while($r=mysqli_fetch_array($q)){
                    $no++;
						    ?>

						      <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['nm_bank']; ?></td>
                      <td><?= $r['no_rek'] ?></td>
						          <td><?= $r['atas_nama']; ?></td>
          				    <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=rekening&aksi=editrekening&id=<?php echo $r['id_bank']; ?>' onclick="return confirm('ANDA YAKIN AKAN EDIT DATA INI ... ?')"><span class='glyphicon glyphicon-edit'></span></a>
                         <a class='btn btn-danger btn-xs' title='Hapus Produk' href='?page=rekening&aksi=hapusrekening&id=<?php echo $r['id_bank']; ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><span class='glyphicon glyphicon-remove'></span></a>
                      </td>
						      </tr>
                <?php } ?>
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
