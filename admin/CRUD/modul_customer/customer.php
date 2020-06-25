<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "hapuscustomer":
      if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM tb_customer where id_customer='$_GET[id]'");
        echo "<script>alert('Data Berhasil Dihapus');
    					window.location='index.php?page=customer';
    				</script>";
      }
?>
    <?php
      break;
    case "editcustomer":
      if (isset($_GET['id'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_customer where id_customer='$_GET[id]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {
        if (!empty($_POST['password'])) {
          $password = $_POST['password'];
          $save = mysqli_query($con, "UPDATE tb_customer set email='$_POST[email]', password='$password' where  id_customer='$_GET[id]'");
        } else if (empty($_POST['password'])) {
          $save = mysqli_query($con, "UPDATE tb_customer set email='$_POST[email]'  where  id_customer='$_GET[id]'");
        }
        if ($save) {
          echo "<script>
                 window.location='?page=customer';
                </script>";
        } else {
          echo "<script>alert('Gagal');
                </script>";
        }
      }
    ?>
      <section class="content-header">
        <h1>
          Customer
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Customer</li>
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
                    <label for="nmkat" class="col-sm-2 control-label">Email Customer</label>
                    <div class="col-sm-4">
                      <input type="text" name="email" id="nmkat" class="form-control" value="<?= $data['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-6">
                      <input name="username" id="user" class="form-control " value="<?= $data['nama_lengkap']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-6">
                      <input name="password" id="pass" value="" class="form-control ">
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
} else {
  ?>
  <section class="content-header">
    <h1>
      Customer
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customer</li>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>No Hp</th>
                    <th>Nama Toko</th>
                    <th>Alamat</th>
                    <th>Tanggal Daftar</th>
                    <th>Kategori Toko</th>
                    <th>Opsi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tb_customer");
                  $no = 1;
                  while ($r = mysqli_fetch_array($q)) {
                  ?>

                    <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
                      <td><?php echo  $r["nama_lengkap"]; ?></td>
                      <td><?php echo  $r["email"]; ?></td>
                      <td><?php echo  $r["password"]; ?></td>
                      <td><?php echo  $r["nohp"]; ?></td>
                      <td><?php echo  $r["nama_toko"]; ?></td>
                      <td><?php echo  $r["alamat"]; ?></td>
                      <td><?php echo  $r["tgl_daftar"]; ?></td>
                      <?php if ($r['jenis_toko'] == NULL) { ?>
                        <td>
                          <button type="button" data-target="#set" data-toggle="modal" class="btn btn-primary" name="cektoko">Set Toko</button>
                        </td>
                      <?php } else { ?>
                        <td>
                          <?php echo $r['jenis_toko'] ?>
                        </td>
                      <?php } ?>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='?page=customer&aksi=editcustomer&id=<?php echo $r['id_customer']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Delete Data' href='?page=customer&aksi=hapuscustomer&id=<?php echo $r['id_customer']; ?>'><span class='glyphicon glyphicon-remove'></span></a>

                      </td>
                    </tr>
                  <?php
                    $no++;
                    $id = $r['id_customer'];
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

  <div id="set" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Set Toko Sebagai</h3>
            </div>
            <div class="panel-content">
              <form action="" method="POST">
                <center>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="checkbox" name="cek" value="Grosir">Grosir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="cek" value="Grosir">Eceran
                  <br><br>
                  <div align="right">
                    <button type="submit" name="simpanSet" class="btn btn-primary">Set Toko</button>
                  </div>

                </center>
              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php
if (isset($_POST['simpanSet'])) {
  $id = $_POST['id'];
  $jenis_toko = $_POST['cek'];
  $update = mysqli_query($con, "UPDATE tb_customer set jenis_toko='$jenis_toko'  where  id_customer='$id'");
  if ($update) {
    echo "<script>
                 window.location='?page=customer';
                </script>";
  } else {
    echo "<script>alert('Gagal');
                </script>";
  }
}

?>