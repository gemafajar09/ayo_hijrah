<?php
session_start();
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.rokaux.com/unishop/v2.2/template-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Apr 2018 05:47:23 GMT -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Ayo Hijrah</title>
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
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/formvalidasi.js"></script>
  <script src="plugins/sweetalert/sweetalert.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="row">
      <!-- Logo -->
      <div class="col-lg-4 col-sm-12 col-md-offset-4 text-center">
        <h2><a href="#">Ayo Hijrah</a></h2>
        <b>
          <h3 style="color: #3c3835;">Masuk Ayo Hijrah</h3>
        </b>
        <p>Belum punya akun Ayo Hijrah ? Daftar <a href="registrasi" style="color: #007bff;">Disini</a></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-offset-4 col-sm-12">
        <div class="row" style="border: 1px solid #ccc; border-radius: 5px;">
          <div class="col-lg-12">
            <br><br>
            <form role="form" action="aksilogin.php" method="POST">
              <div class="form-group form-group-lg">
                <label for="email">Email</label>
                <input type="text" class="form-control input-lg" name="email" placeholder="Email">
              </div>
              <div class="form-group form-group-lg">
                <label for="katasandi">Kata Sandi</label>
                <input type="password" class="form-control input-lg" name="password" placeholder="Kata Sandi">
              </div>
              <div class="form-group" style="float: right;">
                <a href="#"></a>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">Masuk</button>
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