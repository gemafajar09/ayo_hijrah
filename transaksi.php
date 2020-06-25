<?php
if (@$_SESSION['idcs'] == '') {
  echo "<script>window.location='login';</script>";
}
include "config/koneksi.php";
include "config/fungsi_id.php";

$sql = mysqli_query($con, "SELECT * FROM tb_transaksi where id_transaksi='$_GET[id]'");
$r = mysqli_fetch_assoc($sql);

// var_dump($r);

?>
<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
  <!-- Page Title-->
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>Checkout</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="index.html">Home</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li>Checkout</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-2">
    <div class="card text-center">
      <div class="card-body padding-top-2x">
        <h3 class="card-title">Terima kasih atas pesanan anda!</h3>
        <h3 class="card-title">Waktu Pembayaran Anda 3 Jam, Jika Belum Melakukan Pembayaran, <br> Pesanan Akan Dibatalkan!</h3>
        <p class="card-text">Pesanan Anda telah ditempatkan dan akan diproses sesegera mungkin.</p>
        <!-- <p class="card-text">Pastikan Anda mencatat nomor pesanan Anda, yaitu <span class="text-medium"><?= $r["id_order"] ?>.</span> -->
        <p>Transfer Dana Sesuai Dengan Nominal Yang Tertera <b>Rp.<?= number_format($r["total"], 2, ',', '.'); ?></b></p>
        </p>
        <!-- Account / Shipping Info-->
        <section class="widget widget-light-skin">
          <h4>Silahkan Transfer Ke Rekening Kami Di Bawah Ini</h4>

          <?php
          $no = 1;
          $ambil = $con->query("SELECT * FROM tb_bank, tb_bank_detail WHERE tb_bank.id_bank = tb_bank_detail.id_bank");
          while ($pecah = $ambil->fetch_object()) {
          ?>
            <!-- <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:50px;"></span></li> -->
            <ul class="list-unstyled text-sm">
              <li><span><img src="img/bank/<?= $pecah->logo_bank ?>" alt="" style="width:150px;"></span></li>
              <!-- <li style="color: black;"><span style=" color: black;" class="opacity-50">Mandiri</span></li> -->
              <li style="color: black;"><span style=" color: black;">No Rekening : </span><?= $pecah->no_rek ?></li>
              <li style="color: black;"><span style=" color: black;">Atas Nama &nbsp;&nbsp; : </span><?= $pecah->atas_nama ?></li>

            </ul>
          <?php } ?>

          <!-- <ul class="list-unstyled text-sm">
            <li><span class=" "><img src="foto/bank/bni.png" style="width:50px;"></span> </li>
            <li><b>No Rekening : 0585-811955</b></li>
            <li><b>Atas Nama : Rafika Sary</b></li>
          </ul>
          <ul class="list-unstyled text-sm ">
            <li><span class=" text-white"><img src="foto/bank/mandiri.png" style="width:100px;"></span></li>
            <li><b>No Rekening : 111-002-333-444-0</b></li>
            <li><b>Atas Nama : Rafika Sary</b></li>
          </ul>
          <ul class="list-unstyled text-sm ">
            <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:100px;"></span></li>
            <li><b>No Rekening : 032.221.587.6</b></li>
            <li><b>Atas Nama : Rafika Sary</b></li>
          </ul> -->
        </section>
        <div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-secondary" href="shop">Go Back Shopping</a><a class="btn btn-outline-primary" href="histori-pesanan"><i class="icon-location"></i>&nbsp;Konfirmasi Pembayaran</a></div>
      </div>
    </div>
  </div>
  <!-- Site Footer-->