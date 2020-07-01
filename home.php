<!-- Slide -->
<?php
include "config/koneksi.php";

?>

<section class="hero-slider" class="col span_3_of_3" style="position: relative;">
    <ul class="rslides">
      <?php
      $sql = mysqli_query($con, "SELECT * FROM tb_slider");
      foreach ($sql as $r) { ?>
        <li><img width="100%" src="img/slider/<?php echo $r['gambar_slider'] ?>"></li>
        <?php } ?>
      </ul>
      <a href="#" class="rslides_nav rslides1_nav prev">Previous</a><a href="#" class="rslides_nav rslides1_nav next">Next</a>
</section>




<!-- <section class="hero-slider">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <?php
      $sqls = mysqli_query($con, "SELECT * FROM tb_slider");
      foreach ($sqls as $i => $r) { ?>
      <li data-target="#myCarousel" data-slide-to="<?= $i+1 ?>"></li>
      <?php } ?>
    </ol>

    <div class="carousel-inner">
      <?php $sqli = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_slider ORDER BY id_slider DESC LIMIT 1")); ?>
      <div class="item active">
        <img width="100%" src="img/slider/<?php echo $sqli['gambar_slider'] ?>">
      </div>
      <?php
      $sql = mysqli_query($con, "SELECT * FROM tb_slider");
      foreach ($sql as $r) { ?>
        <div class="item">
          <img width="100%" src="img/slider/<?php echo $r['gambar_slider'] ?>">
        </div>
      <?php } ?>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section> -->
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
        <center>
          <h3 class="padding-bottom-1x" style="font-family: 'quick';">Kategori</h3>
        </center>
        <div class="owl-carousel dots-outside owl-loaded owl-drag owl-theme" 
        data-owl-carousel="{&quot;loop&quot;:true,&quot;margin&quot;:5,&quot;responsiveClass&quot;:true,&quot;responsive&quot;:
          {
          &quot;0&quot;:
          {
            &quot;items&quot;:2,&quot;nav&quot;:true,&quot;loop&quot;:true
          },
          &quot;600&quot;:
          {
            &quot;items&quot;:4,&quot;nav&quot;:true,&quot;loop&quot;:true
          },
          &quot;1000&quot;:
          {
            &quot;items&quot;:5,&quot;nav&quot;:true,&quot;loop&quot;:true
          }
        }
      }">
          <?php
          $ambil = mysqli_query($con, "SELECT * FROM `tb_kategori`");

          while ($pecah = $ambil->fetch_object()) {
          ?>
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
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
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