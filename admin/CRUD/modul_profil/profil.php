
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editdata":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_data where id_data='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $save=mysqli_query($con, "UPDATE tbl_data set isi='$_POST[isi]' where  id_data='$_GET[id]'");
      if($save) {
        echo "<script>
               window.location='?page=profil';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Informasi <?= $data['kategori'] ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi <?= $data['kategori'] ?></li>
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
                     <label for="isi" class="col-sm-2 control-label">Isi</label>
                     <div class="col-sm-8">
                       <textarea name="isi" id="isi" class="form-control textarea"  placeholder="Deskripsi" cols="15" rows="20"><?= $data['isi'] ?></textarea>
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
}
}else{
?>

<section class="content-header">
      <h1>
        Informasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi</li>
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
                     <th>Kategori</th>
					           <th>Isi</th>
					           <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_data");
                  $no=0;
          				while($r=mysqli_fetch_array($q)){
                    $no++;
						    ?>

						      <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['kategori'] ?></td>
						          <td style="width: 60em;"><?php echo  $r["isi"]; ?></td>
          				    <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=profil&aksi=editdata&id=<?php echo $r['id_data']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
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
