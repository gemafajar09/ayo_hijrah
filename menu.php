<?php
error_reporting(0);
$sql = mysqli_query($con, "SELECT * FROM tb_customer where id_customer='$_SESSION[idcs]'");
$r = mysqli_fetch_assoc($sql);
?>
<div class="offcanvas-container" id="shop-categories">
  <div class="offcanvas-header">
    <?php
    if (!empty($_SESSION["email"])) { ?>
      <img src="foto/customer/<?= $r["fotoregis"]; ?>" alt="Ayo Hijrah" style="width:50%">
      <h3 class="offcanvas-title"><?= $r["nama_lengkap"]; ?></h3>
    <?php } ?>

    <?php
    if (empty($_SESSION["email"])) { ?>
      <img src="img/user-default.png" alt="Photo Member" style="width:50%">
      <h3 class="offcanvas-title">Nama Member</h3>
    <?php } ?>
  </div>
  <nav class="offcanvas-menu">
    <?php
    if (!empty($_SESSION["email"])) { ?>
      <ul class="menu">
        <li class="has-children"><span><a href="my-profil">My Profile</a></span>
        </li>
      </ul>
      <ul class="menu">
        <li class="has-children"><span><a href="keranjang">Pesanan Saya</a></span>
        </li>
      </ul>
      <ul class="menu">
        <li class="has-children"><span><a href="histori-pesanan">History Pemesanan</a></span>
        </li>
      </ul>
    <?php } ?>

    <?php
    if (empty($_SESSION["email"])) { ?>
      <ul class="menu">
        <li class="has-children"><span><a href="login">Login</a></span>
        </li>
      </ul>
      <ul class="menu">
        <li class="has-children"><span><a href="registrasi">Register</a></span>
        </li>
      </ul>
    <?php } ?>
  </nav>
</div>
<!-- Off-Canvas Mobile Menu-->
<div class="offcanvas-container" id="mobile-menu"><a class="account-link" href="./">
    <?php if (!empty($_SESSION["email"])) { ?>
      <div class="user-ava">
        <img src="foto/customer/<?= $r["fotoregis"]; ?>">
      </div>
    <?php } ?>
    <?php if (empty($_SESSION["email"])) { ?>
      <div class="user-ava">
        <img src="img/user-default.png" alt="Ayo Hijrah">
      </div>
    <?php } ?>
    <div class="user-info">

    </div>
    <nav class="offcanvas-menu">
      <ul class="menu">
        <li class="has-children active"><span><a href="./"><span>Home</span></a></span>
        </li>
        <li class="has-children"><span><a href="shop"><span>Shop</span></a></span>
        </li>
        <li class="has-children"><span><a href="about">About</a></span>
        </li>
        <!-- <li class="has-children"><span><a href="testimonial"><span>Testimonial</span></a></span></li> -->
        <li class="has-children"><span><a href="info-rek"><span>Info Rekening</span></a></span>
        </li>
        <li class="has-children"><span><a href="faq"><span>FAQ</span></a></span>
        </li>
        <!-- <li class="has-children"><span><a href="garansi"><span>Ketentuan Garansi</span></a></span> -->
        <!-- </li> -->
        <li class="has-children"><span><a href="kontak"><span>Contact US</span></a></span>
        </li>
        <?php
        if (empty($_SESSION["email"])) { ?>
          <li class="has-children"><span><a href="login">Login</a></span>
          </li>
          <li class="has-children"><span><a href="registrasi">Register</a></span>
          </li>
        <?php } ?>
        <?php
        if (!empty($_SESSION["email"])) { ?>
          <li class="has-children"><span><a href="my-profil">My Profil</a></span>
          </li>
          <li class="has-children"><span><a href="keranjang">Keranjang</a></span>
          </li>
          <li class="has-children"><span><a href="histori-pesanan">History Pemesanan</a></span>
          </li>
          <li class="has-children"><span><a href="logout.php">Logout</a></span>
          </li>
        <?php } ?>

      </ul>
    </nav>
</div>
<!-- Topbar-->
<div class="topbar" style="background-color: #f2e9d8;">
  <div class="topbar-column">

    <a class="social-button sb-instagram shape-none sb-dark" href="https://www.instagram.com/ayohijrah.indonesia/" target="_blank"><i class="socicon-instagram"></i></a>
    <a class="social-button sb-youtube shape-none sb-dark" href="#" target="_blank"><i class="socicon-youtube"></i></a>
  </div>
  <?php
  if (!empty($_SESSION["email"])) { ?>
    <div class="toolbar">
      <div class="inner">
        <div class="tools">
          <!--<div class="search"><i class="icon-search"></i></div>-->
          <!-- Setelah Login -->
          <div class="account"><a href="#"></a><i class="icon-head"></i>
            <ul class="toolbar-dropdown">
              <li class="sub-menu-user">
                <div class="user-ava"><img src="foto/customer/<?= $r["fotoregis"]; ?>">
                </div>
                <div class="user-info">
                  <h6 class="user-name"><?= $r["nama_lengkap"]; ?></h6>
                </div>
              </li>
              <hr>
              <li><a href="my-profil">My Profile</a></li>
              <!--<li><a href="account-orders.html">Orders List</a></li>-->
              <li><a href="keranjang">Keranjang</a></li>
              <li><a href="histori-pesanan">History</a></li>
              <li class="sub-menu-separator"></li>
              <!-- <li><a href="logout.php"> <i class="icon-unlock"></i>Logout</a></li> -->
            </ul>
          </div>
          <!-- END -->

        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <?php
  if (empty($_SESSION["email"])) { ?>

    <div class="topbar-column"><a class="hidden-md-down" href="login"><i class="icon-download"></i>&nbsp; Login</a>
      <a style="color:#cbcbcc;">|</a>
      <a class="hidden-md-down" href="registrasi"><i class="icon-head"></i>&nbsp; Register</a>
    </div>

  <?php
  }
  ?>
</div>
<!-- Navbar-->
<!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
<header class="navbar navbar-sticky" style="border-bottom:none">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Search-->
  <form class="site-search" method="get">
    <input type="text" name="site_search" placeholder="Type to search...">
    <div class="search-tools"><span class="clear-search">Clear</span><span class="close-search"><i class="icon-cross"></i></span></div>
  </form>
  <div class="site-branding">
    <div class="inner">
      <!-- Off-Canvas Toggle (#shop-categories)--><a class="offcanvas-toggle cats-toggle" href="#shop-categories" data-toggle="offcanvas"></a>
      <!-- Off-Canvas Toggle (#mobile-menu)--><a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
      <!-- Site Logo-->
      <a class="site-logo" href="index.php">
        <!-- <img src="foto/logo.png" alt="Unishop" style="width:100%"> -->
        <h3 style="font-family: 'bradley'; font-size: '25px';">Ayo Hijrah</h3>
      </a>
    </div>
  </div>
  <!-- Main Navigation-->
  <nav class="site-menu ">
    <ul>
      <li <?php if (@$_GET['module'] == 'home' or @$_GET['module'] == "") {
            echo 'class=active';
          } ?>><a href="./"><span>Home</span></a>
      </li>
      <li <?php if (@$_GET['module'] == 'shop') {
            echo 'class=active';
          } ?>><a href="shop"><span>Shop</span></a>
      </li>
      <li <?php if (@$_GET['module'] == 'about') {
            echo 'class=active';
          } ?>><a href="about"><span>About</span></a>
        <ul class="sub-menu">
          <li><a href="faq">FAQ</a></li>
          <!-- <a><a href="garansi">Garansi</a></li> -->
        </ul>
      </li>
      <!-- <li <?php if (@$_GET['module'] == 'testimonial') {
                  echo 'class=active';
                } ?>><a href="testimonial"><span>Testimonial</span></a>
      </li> -->
      <li <?php if (@$_GET['module'] == 'info_rek') {
            echo 'class=active';
          } ?>><a href="info-rek"><span>Info Rekening</span></a>
      </li>
      <li <?php if (@$_GET['module'] == 'contact') {
            echo 'class=active';
          } ?>><a href="kontak"><span>Contact US</span></a>
      </li>
      <?php
      if (!empty($_SESSION["email"])) {
      ?>
        <li <?php if (@$_GET['module'] == 'histori_pesanan') {
              echo 'class=active';
            } ?>><a href="histori-pesanan"><span>Histori Pesanan</span></a>
        </li>


        <li><a href="logout.php"><span>Logout</span></a></li>
      <?php
      }
      ?>
    </ul>
  </nav>
  <!-- Toolbar-->

</header>