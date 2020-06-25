<?php
if ($_SESSION['level'] == 'admin') {
?>
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <?php
        $sql = mysqli_query($con, "SELECT COUNT(status_ord) AS jmlh_order FROM tbl_orders where status_ord='Menunggu Pembayaran'");
        $r = mysqli_fetch_assoc($sql);
        ?>
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= $r["jmlh_order"]; ?></h3>

            <p>Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="?page=penjualan" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <?php
        $sql = mysqli_query($con, "SELECT COUNT(id_produk) AS jmlh_produk FROM tbl_produk ");
        $r = mysqli_fetch_assoc($sql);
        ?>
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $r["jmlh_produk"]; ?></h3>

            <p>Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="?page=produk" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <?php
        $sql = mysqli_query($con, "SELECT COUNT(id_customer) AS jmlh_customer FROM tb_customer ");
        $r = mysqli_fetch_assoc($sql);
        ?>
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?= $r["jmlh_customer"]; ?></h3>

            <p>Customers</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-people"></i>
          </div>
          <a href="?page=customer" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <?php
        $sql = mysqli_query($con, "SELECT COUNT(*) AS jmlh_kat FROM tbl_kategori ");
        $r = mysqli_fetch_assoc($sql);
        ?>
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= $r["jmlh_kat"]; ?></h3>

            <p>Kategori</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-keypad"></i>
          </div>
          <a href="?page=kategori" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>
<?php } ?>
<?php
if ($_SESSION['level'] == 'user') {
?>
  <div class="pull-left info">
    <marquee behavior="" direction="">
      <h2 style="font-family: fantasy; font-size: 50px">&nbsp;&nbsp;&nbsp;Selamat Datang Karyawan <?php echo $_SESSION['namaadmn']; ?></h2>
    </marquee>
    <table align="center">
      <tr>
        <td width="200px"> &nbsp;</td>
        <td> <img class="center" src="../foto/logo.png" alt=""></td>
        <td>&nbsp; </td>
      </tr>
    </table>

  </div>
<?php } ?>