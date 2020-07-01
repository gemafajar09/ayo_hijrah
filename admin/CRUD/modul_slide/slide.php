<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "editslide":

      if (isset($_GET['id'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_slider WHERE id_slider='$_GET[id]'");
        $r = mysqli_fetch_assoc($sql);
      }

      if (isset($_POST['save'])) {

        $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $nama_foto    = $_FILES['gambar_slider']['name'];
        $lokasi_foto  = $_FILES['gambar_slider']['tmp_name'];
        $ukuran_foto  = $_FILES['gambar_slider']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;


        if ($ukuran_foto < 2048576 && $ukuran_foto != 0) {
          if (!in_array($file_ext, $allowed)) {
            echo "<script>
                    window.alert('Gambar Tidak Valid');
                    window.location='?page=slide';
                  </script>";
          } else {
            unlink('../img/slider/' . $r['gambar_slider']);

            move_uploaded_file($lokasi_foto, "../img/slider/" . $nama_file_foto);
            $save = mysqli_query($con, "UPDATE tb_slider SET 
            gambar_slider='$nama_file_foto' WHERE id_slider='$_GET[id]'");

            echo "<script>
               window.location='?page=slide';
              </script>";
          }
        } else {
          echo  "<script>
                    window.location='?page=slide';
                </script>";
        }
      }
?>
      <section class="content-header">
        <h1>
          Slide
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Slide</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <!-- form start -->
              <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Gambar Slider</label>
                    <div class="col-sm-4">
                      <input type="hidden" name="foto_lama1" value="<?= $r['gambar_slider'] ?>">
                      <img src="../img/slider/<?= $r['gambar_slider'] ?>" style="width: 100%; height: 200px;"><br><br>
                      <input type="file" name="gambar_slider">
                      <font color="red">**<span>Ukuran foto sebaiknya 1139px * 399px</span></font>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-4 col-md-offset-2">
                      <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                    </div>
                  </div>
                </div>
                <hr>
                <div>
                  <font color="red"><b></b>&nbsp;&nbsp;&nbsp;Notice :&nbsp; ** </font><b></b>File Foto di bawah 1MB</b>
                </div>
                <hr>
              </form>
            </div>
          </div>
        </div>
      </section>
  <?php
      break;
  }
} else {
  ?>
  <section class="content-header">
    <h1>
      Slide
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Slide</li>
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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $q = mysqli_query($con, "SELECT * from tb_slider");
                foreach ($q as $no => $r) {
                ?>

                  <tr>
                    <td><?php echo $no + 1 ?></td>
                    <td><img src="../img/slider/<?= $r['gambar_slider'] ?>" style="width: 100px; height: 70px;"></td>
                    <td><a class='btn btn-success btn-xs' title='Edit Data' href='?page=slide&aksi=editslide&id=<?php echo $r['id_slider']; ?>'><span class='glyphicon glyphicon-edit'></span></a></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>
<?php } ?>