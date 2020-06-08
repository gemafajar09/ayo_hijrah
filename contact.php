<?php
$sql = mysqli_query($con, "SELECT * FROM tbl_customer where id_customer='$_SESSION[idcs]'");
$r = mysqli_fetch_assoc($sql);
?>
<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
  <!-- Page Title-->
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>Help / FAQ</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="index.php">Home</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li>Help / FAQ</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->

  <div class="container padding-bottom-2x mb-2">
    <h3 class="margin-top-3x text-center mb-30">Location</h3>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="card mb-30">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2825100277!2d100.35463891475365!3d-0.9390126993150075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b9cd98f7c6bb%3A0x713977c9e4d5ebed!2sRafika%20stores%20by%20FIKA!5e0!3m2!1sid!2sid!4v1580950473833!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          <div class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <!-- Side Menu-->
      <!-- Content-->
      <div class="col-md-7">

        <h3 class="padding-top-2x">Belum menemukan jawabannya? Tanya kami.</h3>
        <p class="text-muted mb-30">Kami biasanya merespons dalam 2 hari kerja. Mohon bersabar</p>
        <form action="" method="POST">
          <div class="col-6">
            <div class="form-group">
              <label for="help_name">Nama</label>
              <input class="form-control form-control-rounded" name="nama_lengkap" type="text" id="help_name" value="<?= $r['nama_lengkap'] ?>" required>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="subject">Subject </label>
              <input class="form-control form-control-rounded" id="subject" name="subjek" type="text" required>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="help_question">Question </label>
              <textarea class="form-control form-control-rounded" id="help_question" name="pesan" rows="8" required></textarea>
            </div>
          </div>
          <div class="col-12 text-right">
            <button class="btn btn-primary btn-rounded" name="kirim" type="submit">Submit Question</button>
          </div>
        </form>
      </div>

      <div class="col-md-4 col-md-offset-1">

        <h3 class="padding-top-2x">INFORMASI </h3>
        <p class="padding-top-1x">Claim / Reject / Refund (Retur) : 082283848752</p>
        <h5 class="padding-top-1x">JAM OPERASIONAL</h5>
        <p>Buka Setiap Hari<br>
          11:00 WIB – 22:00 WIB</p>
        <h5 class="padding-top-1x">CONNECT WITH US.</h5>
      </div>
    </div>
  </div>
  <!-- Site Footer-->
  <?php
  $tgl = date("Y-m-d H:i:s");
  if (isset($_POST["kirim"])) {
     mysqli_query($con, "INSERT INTO `tbl_kontak`(`nama`, `subjek`, `pesan`, `tgl_kontak`) VALUES('$_POST[nama_lengkap]','$_POST[subjek]','$_POST[pesan]','$tgl')");
    echo "<script>window.location='index.php';</script>";
  }
  ?>