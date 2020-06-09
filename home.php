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
  <!-- <img style="width: 100%" src="foto/banner.png"> -->
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- Left col -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div id="wrapper">
              <div class="container mb-end">
                <center>
                  <h3>KATEGORI</h3>
                </center>
                <div class="owl-carousel-2 owl-carousel dots-inside owl-loaded owl-drag" data-owl-carousel="{ &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 1000, &quot;items&quot;: 4, &quot;nav&quot;: true }">
                  <?php
                  $ambil = mysqli_query($con, "SELECT * FROM `tbl_kategori`");
                  //$no = 0;
                  while ($pecah = $ambil->fetch_object()) {
                  ?>
                    <div class="thumbnail">
                      <center>
                        <table border="0">
                          <tr height="200px" align="center">
                            <td><img src="<?= $base_url; ?>foto/kategori/<?php echo $pecah->foto_kategori ?>" style="width: 150px;"></td>
                          </tr>
                          <tr height="" align="center">
                            <td>
                              <hr>
                              <b><?php echo $pecah->nama_kategori; ?></b>
                            </td>
                          </tr>
                        </table>
                      </center>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- /.Left col -->

    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
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
                    <img src="foto/produk/<?= $r['foto'] ?>" alt="Category" class="img-responsive" style="height: 200px; "></center>
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
                  if ($_SESSION['jenis_toko'] == 'Grosir') {
                    echo $harga_grosir;
                  } else {
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