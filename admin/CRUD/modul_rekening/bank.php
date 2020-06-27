<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "editbank":
      if (isset($_GET['id'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_bank where id_bank='$_GET[id]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {

        // $namaFile = $_FILES['logo_bank']['name'];
        // $namaSementara = $_FILES['logo_bank']['tmp_name'];
        // $ukuran_foto  = $_FILES['logo_bank']['size'];
        // $dirUpload = "../img/bank/";
        // if ($ukuran_foto != '0') {
        //   unlink('../img/bank/' . $data['logo_bank']);
        //   $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);
        //   $save = mysqli_query($con, "UPDATE tb_bank set nama_bank='$_POST[nama_bank]', logo_bank = '$namaFile' where id_bank='$_GET[id]'");
        // } else {
        //   $save = mysqli_query($con, "UPDATE tb_bank set nama_bank='$_POST[nama_bank]' where id_bank='$_GET[id]'");
        // }

        // if ($save) {
        //   echo "<script>
        //        window.location='?page=bank';
        //       </script>";
        // } else {
        //   echo "<script>alert('Gagal');
        //       </script>";
        // }

        $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $nama_foto    = $_FILES['logo_bank']['name'];
        $lokasi_foto  = $_FILES['logo_bank']['tmp_name'];
        $ukuran_foto  = $_FILES['logo_bank']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

        if ($ukuran_foto < 2048576 && $ukuran_foto != 0) {
          if (!in_array($file_ext, $allowed)) {
            echo "<script>
                    window.alert('Gambar Tidak Valid');
                    window.location='?page=bank';
                  </script>";
          } else {
            if ($ukuran_foto != '0') {
              unlink('../img/bank/' . $data['logo_bank']);

              move_uploaded_file($lokasi_foto, "../img/bank/" . $nama_file_foto);
              $save = mysqli_query($con, "UPDATE tb_bank set nama_bank='$_POST[nama_bank]', logo_bank = '$nama_file_foto' where id_bank='$_GET[id]'");
            } else {
              $save = mysqli_query($con, "UPDATE tb_bank set nama_bank='$_POST[nama_bank]' where id_bank='$_GET[id]'");
            }
            echo "<script>
             window.location='?page=bank';
            </script>";
          }
        } else {
          echo  "<script>
                	alert('Maksimal Upload Foto 2 MB');
                </script>";
        }
      }
?>
      <section class="content-header">
        <h1>
          Informasi Bank
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Informasi Bank</li>
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
                    <label for="nm_bank" class="col-sm-2 control-label">Nama Bank</label>
                    <div class="col-sm-8">
                      <input type="text" id="nama_bank" name="nama_bank" class="form-control" value="<?= $data['nama_bank'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="no_rek" class="col-sm-2 control-label">Logo Bank</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="foto_lama" value="<?= $data['logo_bank'] ?>">
                      <img src="../img/bank/<?= $data['logo_bank'] ?>" alt="" width="150px" height="150px">
                      <input type="file" name="logo_bank" class="form-control">
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
    case "tambahbank":
      if (isset($_POST['save'])) {
        // $namaFile = $_FILES['logo_bank']['name'];
        // $namaSementara = $_FILES['logo_bank']['tmp_name'];
        // $dirUpload = "../img/bank/";
        // $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);
        // $save = mysqli_query($con, "INSERT INTO tb_bank (nama_bank, logo_bank) VALUES('$_POST[nama_bank]','$namaFile')");

        // if ($save) {
        //   echo "<script>alert('Tambah Data Berhasil');
        //   window.location='?page=bank';
        //   </script>";
        //   exit;
        // } else {
        //   echo "<script>alert('Gagal');
        //   </script>";
        // }

        $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $nama_foto    = $_FILES['logo_bank']['name'];
        $lokasi_foto = $_FILES["logo_bank"]["tmp_name"];
        $ukuran_foto = $_FILES['logo_bank']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

        if ($ukuran_foto < 2048576) {
          if (!in_array($file_ext, $allowed)) {
            echo "<script>
                    window.alert('Gambar Tidak Valid');
                    window.location='?page=bank';
                  </script>";
          } else {
            // $pindah = move_uploaded_file($lokfoto, "img/bukti/$newbukti");
            move_uploaded_file($lokasi_foto, "../img/bank/" . $nama_file_foto);
            $save = mysqli_query($con, "INSERT INTO tb_bank (nama_bank, logo_bank) VALUES('$_POST[nama_bank]','$nama_file_foto')");

            echo "<script>
            window.location='?page=bank';
            </script>";
          }
        } else {
          echo  "<script>
                	alert('Maksimal Upload Foto 2 MB');
                </script>";
        }
      }
    ?>
      <section class="content-header">
        <h1>
          Informasi Bank
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Informasi Bank</li>
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
                    <label for="" class="col-sm-2 control-label">Nama Bank</label>
                    <div class="col-sm-8">
                      <input type="text" id="nama_bank" name="nama_bank" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Logo</label>
                    <div class="col-sm-8">
                      <input type="file" id="logo_bank" name="logo_bank" class="form-control">
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
    case "hapusbank":

      if (isset($_GET['id'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_bank where id_bank='$_GET[id]'");
        $data = mysqli_fetch_assoc($sql);
        unlink('../img/bank/' . $data['logo_bank']);
        mysqli_query($con, "DELETE FROM tb_bank where id_bank='$_GET[id]'");
        echo "<script>
    					window.location='index.php?page=bank';
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
      Informasi Bank
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Informasi Bank</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <a href="?page=bank&aksi=tambahbank" class="btn btn-flat btn-primary">Tambah Bank</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Bank</th>
                    <th>Logo Bank</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tb_bank");
                  $no = 0;
                  while ($r = mysqli_fetch_array($q)) {
                    $no++;
                  ?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r['nama_bank']; ?></td>
                      <td><img src="../img/bank/<?= $r['logo_bank'] ?>" alt="" width="150px" height="150px">
                      </td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=bank&aksi=editbank&id=<?php echo $r['id_bank']; ?>' onclick="return confirm('ANDA YAKIN AKAN EDIT DATA INI ... ?')"><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Hapus Produk' href='?page=bank&aksi=hapusbank&id=<?php echo $r['id_bank']; ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><span class='glyphicon glyphicon-remove'></span></a>
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