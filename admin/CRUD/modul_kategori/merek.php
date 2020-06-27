<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "tambahmerek":
      if (isset($_POST['save'])) {
        // upload logo

        // ambil data file
        // $namaFile = $_FILES['logo']['name'];
        // $namaSementara = $_FILES['logo']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        // $dirUpload = "../img/brand/";

        // pindahkan file
        // $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

        // $save = mysqli_query($con, "INSERT INTO `tb_brand`(`nama_brand`, `gambar_brand`) VALUES('$_POST[nama_brand]','$namaFile')");
        // if ($save) {
        //   echo "<script language=javascript>
        //     window.location='?page=merek';
        //     </script>";
        //   exit;
        // } else {
        //   echo "gagal";
        // }

        $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $nama_foto    = $_FILES['logo']['name'];
        $lokasi_foto = $_FILES["logo"]["tmp_name"];
        $ukuran_foto = $_FILES['logo']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

        if ($ukuran_foto < 2048576) {
          if (!in_array($file_ext, $allowed)) {
            echo "<script>
                      window.alert('Gambar Tidak Valid');
                      window.location='?page=merek';
                    </script>";
          } else {
            // $pindah = move_uploaded_file($lokfoto, "img/bukti/$newbukti");
            move_uploaded_file($lokasi_foto, "../img/brand/" . $nama_file_foto);

            $save = mysqli_query($con, "INSERT INTO `tb_brand`(`nama_brand`, `gambar_brand`) VALUES('$_POST[nama_brand]','$nama_file_foto')");

            echo "<script>
              window.location='?page=merek';
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
          Brand
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Tambah Brand</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="box-body ">

                  <div class="form-group">
                    <label for="nmsub" class="col-sm-2 control-label">Merek</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_brand" id="nmsub" class="form-control" placeholder="Merek">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nmsub" class="col-sm-2 control-label">Logo</label>
                    <div class="col-sm-4">
                      <input type="file" name="logo" id="logo" class="form-control">
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
        if (isset($_GET['id_brand'])) {
          $judulseo = seo_title($_POST['nama_merek']);
          $sqlk = mysqli_query($con, "SELECT * FROM tb_brand where id_brand='$_GET[id_brand]'");
          $data = mysqli_fetch_assoc($sqlk);
        }

        if (isset($_POST['save'])) {
          $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
          $nama_foto    = $_FILES['logo']['name'];
          $lokasi_foto  = $_FILES['logo']['tmp_name'];
          $ukuran_foto  = $_FILES['logo']['size'];
          $file_name = explode('.', $nama_foto);
          $nama_file = end($file_name);
          $file_ext = strtolower($nama_file);
          $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;


          if ($ukuran_foto < 2048576 && $ukuran_foto != 0) {
            if (!in_array($file_ext, $allowed)) {
              echo "<script>
                    window.alert('Gambar Tidak Valid');
                    window.location='?page=merek';
                  </script>";
            } else {
              if ($ukuran_foto != '0') {

                unlink('../img/brand/' . $data['gambar_brand']);

                move_uploaded_file($lokasi_foto, "../img/brand/" . $nama_file_foto);
                $save = mysqli_query($con, "UPDATE tb_brand set nama_brand='$_POST[nama_brand]', gambar_brand='$nama_file_foto' where id_brand='$_GET[id_brand]'");
              } else {
                $save = mysqli_query($con, "UPDATE tb_brand set nama_brand='$_POST[nama_brand]' where id_brand='$_GET[id_brand]'");
              }
              echo "<script>
               window.location='?page=merek';
              </script>";
            }
          } else {
            echo  "<script>
                	alert('Maksimal Upload Foto 2 MB');
                </script>";
          }
        }





        // if (isset($_POST['save'])) {
        //   if ($namaFile == NULL) {
        //     $save = mysqli_query($con, "UPDATE tb_brand set nama_brand='$_POST[nama_brand]' where id_brand='$_GET[id_brand]'");
        //   } else {
        //     $save = mysqli_query($con, "UPDATE tb_brand set nama_brand='$_POST[nama_brand]', gambar_brand='$namaFile' where id_brand='$_GET[id_brand]'");
        //   }
        //   if ($save) {
        //     echo "<script language=javascript>
        //       window.location='?page=merek';
        //       </script>";
        //   } else {
        //     echo "<script>alert('Gagal');
        //           </script>";
        //   }
        // }
        ?>
          <section class="content-header">
            <h1>
              Merek
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Edit Brand</li>
            </ol>
          </section>

          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box box-info">
                  <!-- form start -->
                  <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="nmsub" class="col-sm-2 control-label">Merek</label>
                        <div class="col-sm-4">
                          <input type="text" name="nama_brand" id="nmsub" class="form-control" value="<?= $data['nama_brand']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="nmsub" class="col-sm-2 control-label">Logo</label>
                        <div class="col-sm-4">
                          <input type="file" name="logo" id="logo" class="form-control">
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
      case "hapusmerek":
        if (isset($_GET['id_brand'])) {
          $sql = mysqli_query($con, "SELECT * FROM tb_brand where id_brand='$_GET[id_brand]'");
          $data = mysqli_fetch_assoc($sql);
          unlink('../img/brand/' . $data['gambar_brand']);
          mysqli_query($con, "DELETE FROM tb_brand where id_brand='$_GET[id_brand]'");
          echo "<script>
    					window.location='index.php?page=merek';
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
          Brand
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Brand</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <a href="?page=merek&aksi=tambahmerek" class="btn btn-flat btn-primary">Tambah Brand</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>Logo</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $q = mysqli_query($con, "SELECT * FROM tb_brand ");
                      $no = 1;
                      while ($r = mysqli_fetch_array($q)) {
                      ?>

                        <tr>
                          <td width='0' class='center'><?php echo $no; ?></td>
                          <td><?php echo  $r["nama_brand"]; ?></td>
                          <td><img src="<?= $base_url ?>/img/brand/<?= $r['gambar_brand'] ?>" width="120px"></td>
                          <td>
                            <a class='btn btn-success btn-xs' title='Edit Data' href='?page=merek&aksi=editmerek&id_brand=<?php echo $r['id_brand']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=merek&aksi=hapusmerek&id_brand=<?php echo $r['id_brand']; ?>'><span class='glyphicon glyphicon-remove'></span></a>
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