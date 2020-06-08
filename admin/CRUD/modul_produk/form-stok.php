<section class="content-header">
  <h1>
    Stok Produk
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Stok Produk</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Status</th>
                  <th>Stok</th>
                  <th>Terjual</th>
                  <th>Tambah Stok</th>
                  <th>Kurangi Stok</th>
                </tr>
              </thead>

              <tbody>
                <?php
          				$q=mysqli_query($con, "SELECT * from tbl_produk ");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
                      if($r['status']=="Y"){
                          $status = "<i class='glyphicon glyphicon-ok' style='color: #37c779;'></i>";
                      }else{
                          $status = "<i class='glyphicon glyphicon-remove' style='color: #d5280a;'></i>";
                      }
						    ?>
                <tr>
                  <td width='0' class='center'><?php echo $no; ?></td>
                  <td><?php echo  $r["judul"]; ?></td>
                  <td><?php echo  $status ?></td>
                  <td><?php echo  $r["stok"]; ?></td>
                  <td><?php echo  $r["terjual"]; ?></td>
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="id_produk" class="form-control" size=1 value="<?= $r['id_produk']?>">
                      <input type="hidden" name="stok" class="form-control" size=1 value="<?= $r['stok']?>">
                      <input type="text" name="tambah" class="form-control" size=1>
                      <button type="submit" name="simpanP" class="btn btn-success"><span
                          class='glyphicon glyphicon-plus'></button>
                    </form>
                    <?php
                          if(isset($_POST['simpanP'])){
                              $stok = $_POST['stok'] + $_POST['tambah'];
                              if($stok > 0 ){
                                  $status = 'Y';
                              }else{
                                  $status = 'T';
                              }
                              mysqli_query($con, "UPDATE tbl_produk SET stok='$stok', status='$status' WHERE id_produk='$_POST[id_produk]'");

                              echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?page=stok'>";
                          }
                        ?>
                  </td>
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="id_produk" class="form-control" size=1 value="<?= $r['id_produk']?>">
                      <input type="hidden" name="stok" class="form-control" size=1 value="<?= $r['stok']?>">
                      <input type="text" name="tambah" class="form-control" size=1>
                      <button type="submit" name="kurang" class="btn btn-danger"><span
                          class='glyphicon glyphicon-minus'></button>
                    </form>
                    <?php
                          if(isset($_POST['kurang'])){
                              $stok = $_POST['stok'] - $_POST['tambah'];
                              if($stok > 0 ){
                                  $status = 'Y';
                              }else{
                                  $status = 'T';
                              }
                              mysqli_query($con, "UPDATE tbl_produk SET stok='$stok', status='$status' WHERE id_produk='$_POST[id_produk]'");

                              echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?page=stok'>";
                          }
                        ?>
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