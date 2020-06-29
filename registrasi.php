<?php
include "config/koneksi.php";;
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.rokaux.com/unishop/v2.2/template-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Apr 2018 05:47:23 GMT -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>Ayo Hijrah
  </title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="Unishop - Universal E-Commerce Template">
  <meta name="keywords" content="shop, e-commerce, modern, flat style, responsive, online store, business, mobile, blog, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Rokaux">
  <!-- Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- Favicon and Apple Icons-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- <link rel="icon" type="image/x-icon" href="foto/logo.png">
  <link rel="icon" type="image/png" href="foto/logo.png">
  <link rel="apple-touch-icon" href="touch-icon-iphone.png">
  <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
  <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
  <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png"> -->
  <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
  <link rel="stylesheet" media="screen" href="css/vendor.min.css">
  <!-- Main Template Styles-->
  <link id="mainStyles" rel="stylesheet" media="screen" href="css/styles.min.css">
  <!-- Customizer Styles-->
  <link rel="stylesheet" media="screen" href="customizer/customizer.min.css">
  <script src="js/formvalidasi.js"></script>
  <script src="plugins/sweetalert/sweetalert.min.js"></script>

</head>

<body style="background:url(foto/background/sft.jpg)">
  <div class="container">
    <div class="row">
      <!-- Logo -->
      <div class="col-lg-4 col-sm-12 col-md-offset-4 text-center">
        <h2><a href="#">Ayo Hijrah</a></h2>
        <b>
          <h3 style="color: #3c3835;">Registrasi Account Ayo Hijrah</h3>
        </b>
        <p>Sudah punya akun Ayo Hijrah? Masuk <a href="login" style="color: #007bff;">Disini</a></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-offset-2 col-sm-12">
        <div class="row" style="border: 1px solid #ccc; border-radius: 5px;">
          <div class="col-lg-12">
            <h4 class="mt-3 mb-4" style="color: #3c3835;">Daftar / Register</h4>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group form-group-lg has-feedback">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control input-lg textbox" name="nama_lengkap" id="nama" placeholder="Nama Lengkap" autofocus>
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <div class="form-group form-group-lg has-feedback">
                <label for="nohp">No Telepon</label>
                <input type="text" class="form-control input-lg textbox" name="nohp" id="nohp" placeholder="No Telepon">
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <div class="form-group form-group-lg has-feedback">
                <label for="email">Email</label>
                <input type="text" class="form-control input-lg textbox" name="email" id="email" placeholder="Email">
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <div class="form-group form-group-lg has-feedback">
                <label for="katasandi">Kata Sandi</label>
                <input type="password" class="form-control input-lg textbox" name="password" id="katasandi" placeholder="Kata Sandi">
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <div class="form-group form-group-lg has-feedback">
                <label for="katasandi">Nama Toko Online / Offline <span style="color:red; font-size:9px">*kosongkan jika tidak ada</span></label>
                <input type="text" class="form-control input-lg textbox" name="nama_toko" id="nama_toko" placeholder="Nama Toko">
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <div class="form-group form-group-lg has-feedback">
                <label for="katasandi">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                <i class="form-control-feedback"></i>
                <span class="text-warning"></span>
              </div>
              <!--  <div class="form-group form-group-lg has-feedback">-->
              <!--  <label for="fotoregis">Foto</label>-->
              <!--  <input type="file" class="form-control input-lg textbox" name="fotoregis" id="fotoregis">-->
              <!--  <i class="form-control-feedback"></i>-->
              <!--  <span class="text-warning"></span>-->
              <!--</div>-->
              <div class="form-group">
                <div class="form-check">
                  <label for="demo-checkbox-1">Dengan menekan Daftar, saya mengkonfirmasi telah menyetujui
                    <a href="#">Syarat dan Ketentuan,</a> Ayo Hijrah.</label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="registrasi" class="btn btn-primary btn-lg btn-block">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <br><br>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST["registrasi"])) {
  $password = $_POST['password'];
  $tgl = date("Y-m-d");
  // $fotoregis    =$_FILES['fotoregis']['name'];
  //   $lokasi       = $_FILES['fotoregis']['tmp_name'];

  //   move_uploaded_file($lokasi, "foto/customer/$fotoregis");

  $cek = mysqli_query($con, "select * from tb_customer where email='$_POST[email]'");
  $jumlah = mysqli_fetch_assoc($cek);
  if ($jumlah) {
    echo "<script>alert('Maaf, Email ini sudah terdaftar,silahkan masukan email yang lain !');window.location.href='registrasi'</script>";
  } else {
    $sqlpr = mysqli_query($con, "INSERT INTO `tb_customer`(`email`, `password`, `nama_lengkap`, `nohp`, `tgl_daftar`, `fotoregis`,`nama_toko`,`alamat`) VALUES ('$_POST[email]','$password','$_POST[nama_lengkap]','$_POST[nohp]','$tgl','default.jpg','$_POST[nama_toko]','$_POST[alamat]')");
    echo "<script>
			window.alert('Registrasi berhasil');
			window.location='login';
			</script>";
    exit;
  }
}
?>