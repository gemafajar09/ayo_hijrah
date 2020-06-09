<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "tambahkategori":

      if (isset($_POST['save'])) {
        $judulseo = seo_title($_POST['nama_kategori']);
        // $nama_foto    = $_FILES['foto_kategori']['name'];
        $nama_foto    = $_FILES['foto_kategori']['name'];
        $lokasi_foto  = $_FILES['foto_kategori']['tmp_name'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

        move_uploaded_file($lokasi_foto, "../foto/kategori/" . $nama_file_foto);
        $save = mysqli_query($con, "INSERT INTO `tbl_kategori`(`nama_kategori`, `seo_kategori`, `foto_kategori`) VALUES('$_POST[nama_kategori]','$judulseo','$nama_file_foto')");
        if ($save) {
          echo "<script>
            window.location='?page=kategori';
            </script>";
          exit;
        } else {
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
              <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nmkat" class="col-sm-2 control-label">Nama Kategori</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_kategori" id="nmkat" class="form-control" placeholder="Nama Kategori">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fotokat" class="col-sm-2 control-label">Foto Kategori</label>
                    <div class="col-sm-4">
                      <input type="file" name="foto_kategori" id="foto_kategori" class="form-control" placeholder="Foto Kategori">
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
    case "editkategori":
      if (isset($_GET['id_kategori'])) {
        $sql = mysqli_query($con, "SELECT * FROM tbl_kategori where id_kategori='$_GET[id_kategori]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {

        $judulseo = seo_title($_POST['nama_kategori']);

        $nama_foto    = $_FILES['foto_kategori']['name'];
        $lokasi_foto  = $_FILES['foto_kategori']['tmp_name'];
        $ukuran_foto  = $_FILES['foto_kategori']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

        if ($ukuran_foto != '0') {

          unlink('../foto/kategori/' . $data['foto_kategori']);

          move_uploaded_file($lokasi_foto, "../foto/kategori/" . $nama_file_foto);
          $save = mysqli_query($con, "UPDATE tbl_kategori set nama_kategori='$_POST[nama_kategori]',seo_kategori='$judulseo', foto_kategori='$nama_file_foto' where  id_kategori='$_GET[id_kategori]'");
        } else {
          $save = mysqli_query($con, "UPDATE tbl_kategori set nama_kategori='$_POST[nama_kategori]',seo_kategori='$judulseo' where  id_kategori='$_GET[id_kategori]'");
        }
        if ($save) {
          echo "<script>
               window.location='?page=kategori';
              </script>";
        } else {
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
              <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="box-body ">
                  <div class="form-group">
                    <label for="nmkat" class="col-sm-2 control-label">Nama Kategori</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_kategori" id="nmkat" class="form-control" value="<?= $data['nama_kategori']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fotokat" class="col-sm-2 control-label">Foto Kategori</label>
                    <div class="col-sm-4">
                      <center>
                        <img src="../foto/kategori/<?php echo $data['foto_kategori'] ?>" alt="" width="150px">
                      </center>
                      <input type="file" name="foto_kategori" id="foto_kategori" class="form-control" placeholder="Foto Kategori">
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
    case "hapuskategori":

      if (isset($_GET['id_kategori'])) {
        $sql = mysqli_query($con, "SELECT * FROM tbl_kategori where id_kategori='$_GET[id_kategori]'");
        $data = mysqli_fetch_assoc($sql);
        unlink('../foto/kategori/' . $data['foto_kategori']);

        mysqli_query($con, "DELETE FROM tbl_kategori where id_kategori='$_GET[id_kategori]'");
        echo "<script>
    					window.location='index.php?page=kategori';
    				</script>";
      }
    ?>
  <?php
      break;
  }
} else {
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
            <a href="?page=kategori&aksi=tambahkategori" class="btn btn-flat btn-primary">Tambah Kategori</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Foto Kategori</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tbl_kategori");
                  $no = 1;
                  while ($r = mysqli_fetch_array($q)) {
                  ?>

                    <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
                      <td><?php echo  $r["nama_kategori"]; ?></td>
                      <td>
                        <img src="../foto/kategori/<?php echo  $r["foto_kategori"]; ?>" alt="<?php echo  $r["foto_kategori"]; ?>" width="150px">
                      </td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=kategori&aksi=editkategori&id_kategori=<?php echo $r['id_kategori']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=kategori&aksi=hapuskategori&id_kategori=<?php echo $r['id_kategori']; ?>'><span class='glyphicon glyphicon-remove'></span></a>
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