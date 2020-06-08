<?php
session_start();
error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_seo.php";
include "confiq/fungsi_indotgl.php";

if (empty($_SESSION['useradmn']) and empty($_SESSION['passadmn'])) {
  echo "<script>window.location=('login.html')</script>";
} else {
?>
<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/x-icon" href="../foto/logo.png">
  <link rel="icon" type="image/png" href="../foto/logo.png">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>R</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>Sistem</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle">
                Hari Ini :
                <span class="hidden-xs"><?php echo tgl_indo(date('Y-m-d')); ?></span>
              </a></li>
            <li class="dropdown user user-menu">
              <a href="index.php" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  if ($foto == "") { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="images/user/profiledummy.png"
                  class="user-image" alt="User Image">
                <?php
                  } else { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="images/user/<?php echo $foto; ?>"
                  class="user-image" alt="User Image">
                <?php
                  }
                  ?>
                <span class="hidden-xs"><?php echo "$_SESSION[namaad] "; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img style="border:1px solid #eaeaea;border-radius:50px;" src="images/user/profiledummy.png"
                    class="img-circle">
                  <p>
                    <?php echo "$_SESSION[namaadmn] "; ?>
                  </p>
                </li>
            </li>


            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="images/user/profiledummy.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['namaadmn']; ?></p>
            <a href=""><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="active treeview">

          </li>
          <?php 
              if($_SESSION['level']=='admin'){
            ?>
          <li><a href="?page=home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li><a href="?page=admin"><i class="fa fa-user"></i><span>Data Admin</span></a></li>
          <li><a href="?page=customer"><i class="fa fa-user"></i><span>Data Customer</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Kategori</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?page=kategori"><i class="fa fa-circle-o"></i><span>Kategori</span></a></li>
            </ul>
          </li>
          <li><a href="?page=merek"><i class="fa fa-cart-plus"></i>Merek</a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Produk</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?page=produk"><i class="fa fa-circle-o"></i><span>Produk</span></a></li>
              <li><a href="?page=stok"><i class="fa fa-circle-o"></i>Stok Produk</a></li>
            </ul>
          </li>
          <li><a href="?page=penjualan"><i class="fa fa-cart-plus"></i>Data Penjualan</a></li>
          <li><a href="?page=laporan"><i class="fa fa-book"></i>Laporan Penjualan</a></li>
          <li><a href="?page=rekening"><i class="fa fa-credit-card"></i>Informasi No Rekening</a></li>
          <li><a href="?page=slide"><i class="fa fa-image"></i>Slide</a></li>
          <li><a href="?page=garansi"><i class="fa fa-info"></i>Ketentuan Garansi</a></li>
          <li><a href="?page=faq"><i class="fa fa-info"></i>Faq</a></li>
          <li><a href="?page=waktu"><i class="fa fa-cogs"></i>Waktu Pengaturan</a></li>
          <?php } ?>
          <?php 
              if($_SESSION['level']=='user'){
            ?>
          <li><a href="?page=penjualan"><i class="fa fa-cart-plus"></i>Data Penjualan</a></li>
          <li><a href="?page=stok2"><i class="fa fa-circle-o"></i>Stok Produk</a></li>
          <?php } ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php

        if ($_GET['page'] == "" || $_GET['page'] == "home") {
          include "home.php";
        } elseif ($_GET['page'] == "kategori") {
          include "CRUD/modul_kategori/kategori.php";
        } elseif ($_GET['page'] == "merek") {
          include "CRUD/modul_kategori/merek.php";
        } elseif ($_GET['page'] == "faq") {
          include "CRUD/modul_faq/faq.php";
        } elseif ($_GET['page'] == "admin") {
          include "CRUD/modul_admin/admin.php";
        } elseif ($_GET['page'] == "garansi") {
          include "CRUD/modul_garansi/garansi.php";
        } elseif ($_GET['page'] == "kurir") {
          include "CRUD/modul_kurir/form-kurir.php";
          
        } elseif ($_GET['page'] == "stok") {
          include "CRUD/modul_produk/form-stok.php";
        } elseif ($_GET['page'] == "stok2") {
          include "CRUD/modul_produk/form-stok-user.php";
          
        } elseif ($_GET['page'] == "customer") {
          include "CRUD/modul_customer/customer.php";
        } elseif ($_GET['page'] == "produk") {
          include "CRUD/modul_produk/form-produk.php";
        } elseif ($_GET['page'] == "provinsi") {
          include "CRUD/modul_provinsi/provinsi.php";
        } elseif ($_GET['page'] == "kota") {
          include "CRUD/modul_kota/kota.php";
        } elseif ($_GET['page'] == "login") {
          include "login.html";
        } elseif ($_GET['page'] == "penjualan") {
          include "CRUD/modul_penjualan/penjualan.php";
        } elseif ($_GET['page'] == "laporan") {
          include "CRUD/modul_laporan/laporan_penjualan.php";
        } elseif ($_GET['page'] == "slide") {
          include "CRUD/modul_slide/slide.php";
        } elseif ($_GET['page'] == "profil") {
          include "CRUD/modul_profil/profil.php";
        } elseif ($_GET['page'] == "waktu") {
          include "CRUD/modul_waktu/waktu.php";
        } elseif ($_GET['page'] == "rekening") {
          include "CRUD/modul_rekening/rekening.php";
        } elseif ($_GET['page'] == "proses_login") {
          include "proses_login.php";
        }
        ?>
      <!-- /.content -->
    </div>
  </div>


  <script src="./plugins/jQuery/jquery-3.1.1.min.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./plugins/fastclick/fastclick.js"></script>
  <script src="./dist/js/adminlte.min.js"></script>
  <script src="./dist/js/demo.js"></script>
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="dist/js/bootstrap-datepicker.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(function () {
      // datepicker plugin
      $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
      });

      $('#elbuku').hide();

      $('#kategori').change(function () {
        var jml = $("#kategori").val();
        if (jml == 1) {
          $('#elbuku').show();
          $('#isbn').show();
        } else {
          $('#elbuku').hide();
          $('#kdp').show();
          $('#isbn').hide();
        }
      });
      $('.textarea').wysihtml5()
    });
  </script>
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>

</body>

</html>
<?php } ?>