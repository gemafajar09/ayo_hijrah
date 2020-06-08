<?php
include "../../../config/koneksi.php";
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "tambahadmin":

      if (isset($_POST['save'])) {
        $nama_admin = $_POST["nama_admin"];
        $level      = $_POST["level"];
        $username   = $_POST["username"];
        $password   = md5($_POST["password"]);
        $save = mysqli_query($con, "INSERT INTO `tbl_admin`(`nama_admin`, `level`, `username`, `password`) VALUES('$nama_admin','$level','$username','$password')");
        if ($save) {
          echo "<script>
            window.location='?page=admin';
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
          Data Admin
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Tambah Admin</li>
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
                    <label for="nmkat" class="col-sm-2 control-label">Nama Admin</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_admin" id="nmkat" class="form-control" placeholder="Nama Admin">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
                      <input type="text" name="username" id="user" class="form-control" placeholder="Username">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="pas" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                      <input type="text" name="password" id="pas" class="form-control" placeholder="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pas" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-4">
                      <select name="level" id="" class="form-control">
                        <option value="">--Silahkan Pilih--</option>
                        <option value="admin">Admin</option>
                        <option value="user">Karyawan</option>
                      </select>
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
    case "editadmin":
      if (isset($_GET['kd_admin'])) {
        $sql = mysqli_query($con, "SELECT * FROM tbl_admin where kd_admin='$_GET[kd_admin]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {
        if (!empty($_POST['password'])) {
          $password = md5($_POST['password']);
          // $level1    = $_POST['level1'];
          $save = mysqli_query($con, "UPDATE tbl_admin set nama_admin='$_POST[nama_admin]', password='$password' where  kd_admin='$_GET[kd_admin]'");
        } else if (empty($_POST['password'])) {
          // $level    = $_POST['level1'];
          $save = mysqli_query($con, "UPDATE tbl_admin set nama_admin='$_POST[nama_admin]'  where  kd_admin='$_GET[kd_admin]'");
        }
        if ($save) {
          echo "<script>
               window.location='?page=admin';
              </script>";
        } else {
          echo "<script>alert('Gagal');
              </script>";
        }
      }
    ?>
      <section class="content-header">
        <h1>
          Admin
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Admin</li>
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
                    <label for="nmkat" class="col-sm-2 control-label">Nama Admin</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_admin" id="nmkat" class="form-control" value="<?= $data['nama_admin']; ?>">
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-4">
                      <select name="level1" id="" class="form-control">
                        <option value="admin" <?php if ($data['level'] == 'admin') {
                                                echo 'selected';
                                              } ?>>Admin</option>
                        <option value="user" <?php if ($data['level'] == 'user') {
                                                echo 'selected';
                                              } ?>>Karyawan</option>
                      </select>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-6">
                      <input name="username" id="user" class="form-control " value="<?= $data['username']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-6">
                      <input name="password" id="pass" class="form-control ">
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
    case "hapusadmin":

      if (isset($_GET['kd_admin'])) {
        mysqli_query($con, "DELETE FROM tbl_admin where kd_admin='$_GET[kd_admin]'");
        echo "<script>
    					window.location='index.php?page=admin';
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
      Admin
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Admin</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <a href="?page=admin&aksi=tambahadmin" class="btn btn-flat btn-primary">Tambah Admin</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tbl_admin");
                  $no = 1;
                  while ($r = mysqli_fetch_array($q)) {
                  ?>

                    <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
                      <td><?php echo  $r["nama_admin"]; ?></td>
                      <td><?php echo  $r["username"]; ?></td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=admin&aksi=editadmin&kd_admin=<?php echo $r['kd_admin']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=admin&aksi=hapusadmin&kd_admin=<?php echo $r['kd_admin']; ?>'><span class='glyphicon glyphicon-remove'></span></a>
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