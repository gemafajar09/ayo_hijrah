<!-- Slide -->
<?php
include "config/koneksi.php";
$sql = mysqli_query($con, "SELECT * FROM tbl_slide");
$r = mysqli_fetch_assoc($sql);
?>
<section class="hero-slider" style="background-image: url(img/hero-slider/main-bg.jpg);height: auto;">
  <div align="center" class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
    <div class="item">
      <div class="">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-12">
            <img class="img-fluid" alt="Responsive image" style="width: 100%; height: 650px;" src="foto/slide/<?php echo $r['gambar_1'] ?>" alt="Puma Backpack"></div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-12">
            <img class="img-fluid" alt="Responsive image" style="width: 100%; height: 650px;" src="foto/slide/<?php echo $r['gambar_2'] ?>" alt="Puma Backpack"></div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-12">
            <img class="img-fluid" alt="Responsive image" style="width: 100%; height: 650px;" src="foto/slide/<?php echo $r['gambar_3'] ?>" alt="Puma Backpack"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Top Categories-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- banner -->
<section class="">
  <img style="width: 100%" src="foto/banner.png"> 
</section>

<section class="padding-top-3x" style="background:url(foto/background/sft.jpg)">

  <div class="container">
    <h3 class="text-center mb-30">Produk</h3>
    <div class="row">
      <?php
      $batas = 4; //jumlah data per halaman
      $pg = isset($_GET['pg']) ? $_GET['pg'] : "";
      if (empty($pg)) {
        $posisi = 0;
        $pg = 1;
      } else {
        $posisi = ($pg - 1) * $batas;
      }

      $jml_data = mysqli_query($con, "SELECT * FROM tbl_produk");
      $total = mysqli_num_rows($jml_data);
      $pages = ceil($total / $batas);

      $sql = mysqli_query($con, "SELECT * FROM tbl_produk ORDER BY id_produk desc LIMIT 8");
      while ($r = mysqli_fetch_assoc($sql)) {
        $harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
        $harga = "Rp. " . number_format($r['harga'], 0, ',', '.');
        $harga_lama = "Rp. " . number_format($r['harga_lama'], 0, ',', '.');
        $judul = substr($r['judul'], 0, 20) . "...";
      ?>
        <div class="col-sm-3">
          <div class="card mb-30"><a class="card-img-tiles" href="view-produk-<?= $r['id_produk']; ?>">
              <div class="inner">
                <div class="text-center" style="padding:10px">
                  <center>
                    <img src="foto/produk/<?= $r['foto'] ?>" alt="Category" class="img-responsive" style="height: 200px; ">
                  </center>
                </div>
              </div>
            </a>
            <div class="card-body text-center">
              <h4 class="card-title"><?= $judul; ?></h4>
              <p class="text-muted">
                <?php
                    if (!empty($r["harga_lama"])) { 
                ?>
                      <del><?= $harga_lama; ?></del>

                <?php 
                    if($_SESSION['jenis_toko'] == 'Grosir'){
                          echo $harga_grosir;
                      }else{
                        echo $harga;
                } ?>
                <?php } ?>
                <?php
                if (empty($r["harga_lama"])) { ?>
                  <?= $harga; ?>
                <?php } ?></p>
                <?php
              if ($r['stok'] > 0) {

                echo "<a class='btn btn-outline-primary' href='view-produk-$r[id_produk]'>View Products</a>";
              } else {
                echo "<a class='btn btn-outline-danger'>SOLD OUT</a>";
              }
              ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <div>
</section>

<section class="padding-top-3x">
  <div class="container">
    <h3 class="text-center mb-30">Brand</h3>
<?php
$data = mysqli_query($con,"SELECT logo, nama_merek FROM `tbl_merek`");
?>
    <div class="row">
<?php foreach($data as $a){ ?>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <img src="<?= $base_url ?>foto/merek/<?= $a['logo'] ?>" alt="Category" class="img-responsive" style="height: 200px; ">
          </div>
        </div>
      </div>
<?php } ?>
    </div>
  </div>
</section>