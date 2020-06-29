<!-- Slide -->
<?php
include "config/koneksi.php";

?>
<section class="hero-slider" style="background-image: url(img/hero-slider/main-bg.jpg);height: auto;">
  <div align="center" class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
    <?php
    $sql = mysqli_query($con, "SELECT * FROM tb_slider");
    foreach ($sql as $r) { ?>

      <div class="item">
        <div class="">
          <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
              <img class="img-fluid" alt="Responsive image" style="width: 100%; height: 650px;" src="img/slide/<?php echo $r['gambar_slider'] ?>" alt="Puma Backpack">
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>
<!-- Top Categories-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- banner -->

<!-- kategori -->
<section class="padding-top-2x padding-bottom-2x">
  <!-- <img style="width: 100%" src="foto/banner.png"> -->
  <div class="container">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- Left col -->
      <div class="img-fluid">
        <!-- <div class="card" style="background-color: transparent;">
          <div class="card-body">
            <div id="wrapper">
              <div class="container mb-end">
                <center>
                  <h3>KATEGORI</h3>
                </center>
                <div class="owl-carousel-2 owl-carousel dots-inside owl-loaded owl-drag" data-owl-carousel="{ &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 2000, &quot;items&quot;: 4, &quot;nav&quot;: true }">
                  <?php
                  $ambil = mysqli_query($con, "SELECT * FROM `tb_kategori`");

                  while ($pecah = $ambil->fetch_object()) {
                  ?>
                    <div class="">
                      <center>
                        <table border="0">
                          <tr height="200px" align="center">
                            <td><a href="view-kategori-<?= $pecah->id_kategori ?>"><img src="<?= $base_url; ?>img/kategori/<?php echo $pecah->gambar_kategori ?>" style="width: 150px; height: 180px;"></a></td>
                          </tr>
                          <tr height="" align="center">
                            <td>
                              <hr>
                              <b><a href='view-kategori-<?= $pecah->id_kategori ?>'><?php echo $pecah->nama_kategori; ?></a></b>
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
        </div> -->
        <center>
          <h3 class="padding-bottom-1x" style="font-family: 'quick';">Kategori</h3>
        </center>
        <div class="owl-carousel dots-outside owl-loaded owl-drag owl-theme" data-owl-carousel="{ &quot;loop&quot;: true,&quot;center&quot;: true,&quot;margin&quot;:10, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 2000, &quot;items&quot;: 4, &quot;nav&quot;: true }">
          <?php
          $ambil = mysqli_query($con, "SELECT * FROM `tb_kategori`");

          while ($pecah = $ambil->fetch_object()) {
          ?>
            <!-- <div class="">
                      <center>
                        <table border="0">
                          <tr height="200px" align="center">
                            <td><a href="view-kategori-<?= $pecah->id_kategori ?>"><img src="<?= $base_url; ?>img/kategori/<?php echo $pecah->gambar_kategori ?>" style="width: 150px; height: 180px;"></a></td>
                          </tr>
                          <tr height="" align="center">
                            <td>
                              
                              <h4><a href='view-kategori-<?= $pecah->id_kategori ?>'><?php echo $pecah->nama_kategori; ?></a></h4>
                            </td>
                          </tr>
                        </table>
                      </center>
                    </div> -->
            <div class="img-thumbnail">
              <span style="padding: 0px; margin: 0px; color:white; background: white; border-radius: 5px;">
                <a href="view-kategori-<?= $pecah->id_kategori ?>">
                  <img src="<?= $base_url ?>img/kategori/<?= $pecah->gambar_kategori ?>" alt="Category" class="img-responsive" style="height: 250px; width:90%; border-radius: 5px; display: block; margin-left: auto; margin-right: auto; margin-top:12px">
                </a>
                <br>

                <h4 class="text-center" style="font-family: 'bradley'"><a href='view-kategori-<?= $pecah->id_kategori ?>'><?php echo $pecah->nama_kategori; ?></a></h4>
              </span>
            </div>

          <?php
          }
          ?>
        </div>
      </div>
      <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>


<!-- brand -->
<!-- <section class="padding-top-2x padding-bottom-2x">
  <div class="container">
    <h3 class="text-center mb-30">Brand</h3>
    <?php
    $data = mysqli_query($con, "SELECT * FROM `tb_brand`");
    ?>
    <div class="row">
    <?php foreach ($data as $a) { ?>
      <div class="col-sm-2 padding-top-1x">
        <div class="card">
          <div class="card-body">
            <center>
            <img src="<?= $base_url ?>img/brand/<?= $a['gambar_brand'] ?>" alt="Category" class="img-responsive" style="height: 100px; ">
            </center>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</section> -->

<section class="padding-top-2x padding-bottom-2x" style="background:url(foto/background/sft.jpg)">
  <div class="container">
    <h3 class="text-center mb-30" style="font-family: 'quick';">Brand</h3>
    <?php
    $data = mysqli_query($con, "SELECT * FROM `tb_brand`");
    ?>
    <div class="row">
      <?php foreach ($data as $a) { ?>
        <span style="padding: 10px; margin: 10px; color:white; background: white; border-radius: 5px;">
          <center>
            <img src="<?= $base_url ?>img/brand/<?= $a['gambar_brand'] ?>" alt="Category" class="img-responsive" style="height: 100px; width:150px">
          </center>
        </span>
      <?php } ?>
    </div>
  </div>
</section>

<!-- produk -->
<section class="padding-top-2x padding-bottom-2x">
  <div class="container">
    <h3 class="text-center mb-30" style="font-family: 'quick';">Produk</h3>
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

      $jml_data = mysqli_query($con, "SELECT * FROM tb_produk");
      $total = mysqli_num_rows($jml_data);
      $pages = ceil($total / $batas);

      $sql = mysqli_query($con, "SELECT * FROM tb_produk ORDER BY id_produk desc LIMIT 8");
      while ($r = mysqli_fetch_assoc($sql)) {
        $harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
        $harga_eceran = "Rp. " . number_format($r['harga_eceran'], 0, ',', '.');
        $judul = substr($r['judul'], 0, 23) . "";
      ?>
        <div class="col-sm-3">
          <div class="card mb-30"><a class="card-img-tiles" href="view-produk-<?= $r['id_produk']; ?>">
              <div class="inner">
                <div class="text-center" style="padding:10px">
                  <center>
                    <img src="<?= $base_url ?>img/produk/<?= $r['foto'] ?>" class="img-responsive" style="height: 200px; width:200px">
                  </center>
                </div>
              </div>
            </a>
            <div class="card-body text-center" height="100px">
              <h4 class="card-title" style="font-family: 'quick'; font-size: 15px;"><?= $judul; ?></h4>
              <p class="text-muted">
                <?php
                // if($_SESSION['jenis_toko'] == 'Grosir'){
                //     echo $harga_grosir;
                //   }else{
                //     echo $harga_eceran;
                // }
                echo $harga_eceran;
                ?>
                <?php
                if ($r['status'] == 'Y') {
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
</section>