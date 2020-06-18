<div class="offcanvas-wrapper">
  <!-- Page Title-->
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>Single Product</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="index.html">Home</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li><a href="shop-grid-ls.html">Shop</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li>Single Product</li>
        </ul>
      </div>
    </div>
  </div>

  <section class="container">
    <h3 class="text-center mb-30">View Produk</h3>
    <div class="row">
      <?php
      $sql = mysqli_query($con, "SELECT * FROM tb_produk where id_produk='$_GET[id_produk]'");
      $r = mysqli_fetch_assoc($sql);
      $harga_eceran = "Rp. " . number_format($r['harga_eceran'], 0, ',', '.');
      $harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
      $judul = substr($r['judul'], 0, 23) . "..";
      // var_dump($r);
      $total = $r['diskon']-$r['harga_eceran'];
      ?>

      <!-- Off-Canvas Wrapper-->

      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <form action="" method="POST">
          <div class="row">
            <!-- Poduct Gallery-->

            <div class="col-md-6">
              <div class="product-gallery"><span class="product-badge text-danger"><?php echo "Rp. " . number_format($total, 0, ',', '.') ?> Off</span>
                <div class="gallery-wrapper">
                  <div class="gallery-item active"><a href="img/produk/<?= $r['foto'] ?>" data-hash="one" data-size="1000x667"></a></div>
                  <?php 
                    $no = 2;
                    $data = mysqli_query($con,"SELECT * FROM tb_gambar WHERE kd_produk='$r[kd_produk]'");
                    foreach($data as $a){
                  ?>
                  <div class="gallery-item"><a href="img/produk_detail/<?= $a['gambar_produk'] ?>.jpg" data-hash="<?= $no++ ?>" data-size="1000x667"></a></div>
                  <?php } ?>
                </div>
                <div class="product-carousel owl-carousel">
                  <div data-hash="one"><img src="img/produk/<?= $r['foto'] ?>" alt="Product"></div>
                  <?php 
                    $no = 2;
                    $data = mysqli_query($con,"SELECT * FROM tb_gambar WHERE kd_produk='$r[kd_produk]'");
                    foreach($data as $a){
                  ?>
                    <div data-hash="<?= $no++ ?>"><img src="img/produk_detail/<?= $a['gambar_produk'] ?>" alt="Product"></div>
                  <?php } ?>
                </div>
                <ul class="product-thumbnails">
                  <?php if (empty($r["foto"])) { ?> &nbsp;
                  <?php } else { ?>
                    <li class="active"><a href="#one"><img src="img/produk/<?= $r['foto'] ?>"></a></li>
                  <?php } ?>

                  <?php 
                  $no = 2;
                  $data = mysqli_query($con,"SELECT * FROM tb_gambar WHERE kd_produk='$r[kd_produk]'");
                  foreach($data as $a){
                  ?>
                    <li><a href="#<?= $no++ ?>"><img src="img/produk_detail/<?= $a['gambar_produk'] ?>"></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <!-- Product Info-->
            <input type="hidden" name="id_customer" value="<?= $_SESSION['idcs']; ?>">
            <input type="hidden" name="id_produk" id="id_produk" value="<?= $r['id_produk']; ?>">
            <input type="hidden" name="kd_produk" id="kd_produk" value="<?= $r['kd_produk']; ?>">
            <div class="col-md-6">
              <div class="padding-top-2x mt-2 hidden-md-up"></div>
              <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
              </div><span class="text-muted align-middle">&nbsp;&nbsp;4.2 | 3 customer reviews</span>
              <h2 class="padding-top-1x text-normal"><?= $r["judul"]; ?></h2>
              <!-- cek grosir atau tidak -->
             <!--  <?php 
              if($_SESSION['jenis_toko'] == 'Grosir'){ ?>
                <span class="h2 d-block"><?= $harga_grosir; ?></span>
              <?php }else{ ?>
                <span class="h2 d-block"><?= $harga_eceran; ?></span>
              <?php } ?> -->
              <span class="h2 d-block"><?= $harga_eceran; ?></span>
              <p><?= $r["deskripsi"]; ?></p>
              <div class="row margin-top-1x">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input id="quantity_input" type="text" pattern="[0-9]*" name="jml" value="1" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="radio" name="ukuran" class="ukuran" onclick="cekStok('S')" value="S"><label>S</label>&nbsp;&nbsp;
                    <input type="radio" name="ukuran" class="ukuran" onclick="cekStok('M')" value="M"><label>M</label>&nbsp;&nbsp;
                    <input type="radio" name="ukuran" class="ukuran" onclick="cekStok('L')" value="L"><label>L</label>&nbsp;&nbsp;
                    <input type="radio" name="ukuran" class="ukuran" onclick="cekStok('XL')" value="XL"><label>XL</label>&nbsp;&nbsp;
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="quantity">Stok</label>
                    <input type="text" pattern="[0-9]*" name="stok" id="stok" readonly value="0" class="form-control">
                  </div>
                </div>
              </div>
              <hr class="mb-3">
              <div class="d-flex flex-wrap justify-content-between">
                <div class="entry-share mt-2 mb-2"><span class="text-muted">Share:</span>
                  <div class="share-links"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
                </div>
                <div class="sp-buttons mt-2 mb-2">
                  <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                  <?php if (!empty($_SESSION["email"])) { ?>
                  
                   <?php
                    if ($r['status'] != 'T') {

                      echo "<button class='btn btn-primary' id='klik' name='pesan' type='submit'><i class='icon-bag'></i> Beli</button>";
                    } else {
                      echo "<a class='btn btn-outline-danger btn-sm'>SOLD OUT</a>";
                    }
                    ?>
                  
                  <?php } ?>
                  <?php if (empty($_SESSION["email"])) { ?>
                   <?php
                    if ($r['status'] != 'T') {
                      if ($_SESSION['pengaturan']['mode_maintenance'] == "1") {
                        echo "Silahkan Tunggu Sampai Waktu Berakhir";
                      } else {
                        echo "<button class='btn btn-primary' id='klik'><i class='icon-bag'></i> <a href='login' onclick='return confirm('ANDA BELUM LOGIN. SILAHKAN LOGIN TERLEBIH DAHULU ... ?')' style='color:#fff;'>Beli</a></button>";
                      }
                    } else {
                      echo "<a class='btn btn-outline-danger btn-sm'>SOLD OUT</a>";
                    }
                    ?>

                  
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        if (isset($_POST["pesan"])) {
          mysqli_query($con, "INSERT INTO `tb_transaksi_tmp`( `kd_produk`, `id_customer`, `size`, `jumlah_beli`) VALUES ('$_POST[kd_produk]', '$_POST[id_customer]','$_POST[ukuran]','$_POST[jml]')");
          echo "<script>
						window.location='keranjang';
						</script>";
          exit;
        }
        ?>
        <!-- Product Tabs--><br>
        <hr>


      </div>
      <!-- Site Footer-->

    </div>
  </section>

  <section class="bg-faded padding-top-2x padding-bottom-3x">
    <div class="container">
      <!-- Related Products Carousel-->

      <h3 class="text-center  mt-2 padding-bottom-1x">Produk Lainnya</h3>
      <!-- Carousel-->
      <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <?php
        $batas = 10; //jumlah data per halaman
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

        $sql = mysqli_query($con, "SELECT * FROM tb_produk LIMIT $posisi, $batas");
        while ($r = mysqli_fetch_assoc($sql)) {
          $harga_eceran = "Rp. " . number_format($r['harga_eceran'], 0, ',', '.');
          $harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
          $judul = substr($r['judul'], 0, 20) . "...";
        ?>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
              <a class="product-thumb" href="view-produk-<?= $r['id_produk']; ?>">
                <center><img src="img/produk/<?= $r['foto'] ?>" style="height: 185px; width: 75%;"></center>
              </a>
              <h3 class="product-title"><a href="view-produk-<?= $r['id_produk']; ?>"><?= $judul; ?></a></h3>
              <?php if($_SESSION['jenis_toko'] == 'Grosir'){ ?>
              <h4 class="product-price">
                <?= $harga_grosir; ?>
              </h4>
              <?php }else{ ?>
              <h4 class="product-price">
                <?= $harga_eceran; ?>
              </h4>
              <?php } ?>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                
                 <?php
                if ($r['status'] != 'T') {
                  echo "<a class='btn btn-outline-primary btn-sm' href='view-produk-$r[id_produk]'>View Products</a>";
                } else {
                  echo "<a class='btn btn-outline-danger btn-sm'>SOLD OUT</a>";
                }
                ?>
              
              </div>
            </div>
          </div>
        <?php } ?>
        <!-- Product-->
      </div>
    </div>

  </section>

</div>

<?php
if (isset($_POST["pesan"])) {
  mysqli_query($con, "INSERT INTO `tbl_keranjang`(`id_produk`, `id_customer`, `jml`) VALUES ('$_POST[id_produk]', '$_POST[id_customer]','$_POST[jml]')");
  echo "<script>
				window.location='index.php?module=keranjang';
				</script>";
  exit;
}
?>


<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>

<script>
  function cekStok(id)
  {
    var kd_produk = $('#kd_produk').val()
    
    $.ajax({
      url: 'cariStokBarang.php',
      type: 'POST',
      data: {'ukuran':id , 'kd_produk':kd_produk},
      dataType: 'JSON',
      success: function(data)
      {
        if(data != null)
        {
          $('#stok').val(data.stok)
          document.getElementById('klik').style.visibility = 'visible';
          cekRead()
        }
        else
        {
          $('#stok').val(0)
        }
      }
    })
  }

  function cekRead()
  {
    var cekstok = $('#stok').val()
   if(cekstok == 0)
    {
      document.getElementById('klik').style.visibility = 'hidden';
      document.getElementById('quantity_input').readOnly = true;
    }else{
      document.getElementById('quantity_input').readOnly = false;
    } 
  }

  var cekstok = $('#stok').val()

  if(cekstok == 0)
  {
    document.getElementById('klik').style.visibility = 'hidden';
  }
</script>