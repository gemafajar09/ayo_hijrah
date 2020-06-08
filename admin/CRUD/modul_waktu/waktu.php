<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "tambah":

      if (isset($_POST['save'])) {
        $waktu = $_POST['waktu'];
        $save = mysqli_query($con, "INSERT INTO `tb_waktu`(`set_waktu`) VALUES('$waktu')");
        $data = mysqli_query($con, "SELECT * FROM tb_waktu");
        $hitung = mysqli_fetch_assoc($data);
        // $_SESSION['waktu'] = $hitung['set_waktu'];
        if ($save) {
          echo "<script>
            window.location='?page=waktu';
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
          Waktu Tunggu
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Set Waktu</li>
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
                    <label for="waktu" class="col-sm-2 control-label">Set Waktu</label>
                    <div class="col-sm-4">
                      <input type="number" name="waktu" id="waktu" class="form-control" placeholder="Set Waktu">
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
    case "edit":
      if (isset($_GET['id_pengaturan'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_pengaturan where id_pengaturan='$_GET[id_pengaturan]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {
        $nilai = $_POST['nilai'];
        $save = mysqli_query($con, "UPDATE tb_pengaturan set nilai='$nilai' where  id_pengaturan='$_GET[id_pengaturan]'");
        if ($save) {
          echo "<script>
               window.location='?page=waktu';
              </script>";
        } else {
          echo "<script>alert('Gagal');
              </script>";
        }

        // reset pengaturan yang ada pada session
        $sql_pengaturan = mysqli_query($con, "SELECT * FROM tb_pengaturan");
        while ($pengaturan = mysqli_fetch_assoc($sql_pengaturan)) {
          $_SESSION['pengaturan'][$pengaturan['nama_pengaturan']] = $pengaturan['nilai'];
        }
      }
    ?>
      <section class="content-header">
        <h1>
          Edit Pengaturan
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Pengaturan</li>
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
                    <label for="nilai" class="col-sm-2 control-label">Nilai</label>
                    <div class="col-sm-4">
                      <?php
                      if ($data['tipe_data'] == "Tanggal") {
                      ?>
                        <input type="date" name="nilai" id="nilai" class="form-control" value="<?= $data['nilai']; ?>">
                      <?php
                      } elseif ($data['tipe_data'] == "Waktu dan Tanggal") {
                      ?>
                        <input type="datetime-local" name="nilai" id="nilai" class="form-control" value="<?= $data['nilai']; ?>">
                      <?php
                      } elseif ($data['tipe_data'] == "Angka") {
                      ?>
                        <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $data['nilai']; ?>">
                      <?php
                      } elseif ($data['tipe_data'] == "Karakter") {
                      ?>
                        <input type="text" name="nilai" id="nilai" class="form-control" value="<?= $data['nilai']; ?>">
                      <?php
                      }
                      ?>
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
    case "hapusfaq":

      if (isset($_GET['id_faq'])) {
        mysqli_query($con, "DELETE FROM tbl_faq where id_faq='$_GET[id_faq]'");
        echo "<script>
    					window.location='index.php?page=faq';
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
      Pengaturan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengaturan</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <a href="?page=waktu&aksi=tambah" class="btn btn-flat btn-primary">Set Waktu</a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Set Waktu</th>
                    <th>Nilai</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tb_pengaturan");
                  $no = 1;
                  while ($r = mysqli_fetch_array($q)) {
                  ?>

                    <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
                      <td><?php echo  $r["nama_pengaturan"]; ?></td>
                      <td><?php echo  $r["nilai"]; ?></td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Pengaturan' href='?page=waktu&aksi=edit&id_pengaturan=<?php echo $r['id_pengaturan']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                        <!-- <span class='btn btn-danger btn-xs' title='Delete Data' href='?page=faq&aksi=hapusfaq&id_faq=<?php echo $r['id_faq']; ?>'><span class='glyphicon glyphicon-remove'></span></a> -->
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