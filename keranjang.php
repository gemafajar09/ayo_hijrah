<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
  <!-- Page Title-->
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>Cart</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="./">Home</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li>Cart</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
    <!-- Alert-->
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
      <table class="table">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Ukuran</th>
            <th class="text-center">Subtotal</th>
            <th class="text-center"><a class="btn btn-sm btn-outline-danger">Hapus</a></th>
          </tr>
        </thead>
        <?php
        error_reporting(0);
        $sql = mysqli_query($con, "SELECT * FROM tb_transaksi_tmp,tb_produk,tbl_customer where tb_transaksi_tmp.kd_produk=tb_produk.kd_produk AND tb_transaksi_tmp.id_customer=tbl_customer.id_customer AND tb_transaksi_tmp.id_customer='$_SESSION[idcs]'");
        $cek = mysqli_num_rows($sql);
        if ($cek == 0) { ?>
          <tr>
            <td colspan=7>Keranjang Belanja Anda Masih Kosong</td>
          </tr>
          <?php
        } else {
          $no = 0;
          $arr = array();
          $arrHarga = array();
          while ($r = mysqli_fetch_assoc($sql)) {
            $no++;
            if($r['jenis_toko'] == 'Grosir')
            {
              $harga = "Rp. " . number_format($r['harga_grosir']);
              $total = "Rp. " . number_format($r['harga_grosir'] * $r['jumlah_beli']);
              $sub = $r['harga_grosir'] * $r['jumlah_beli'];
            }else{
              $harga = "Rp. " . number_format($r['harga_eceran']);
              $total = "Rp. " . number_format($r['harga_eceran'] * $r['jumlah_beli']);
              $sub = $r['harga_eceran'] * $r['jumlah_beli'];
            }
            $subtot += $sub;
            $arr[] = $r;
          ?>
            <tbody>
              <tr>
                <td>
                  <div class="product-item"><a class="product-thumb" href="#"><img src="img/produk/<?= $r['foto'] ?>" alt="Product" style="width : 110px; height: 130px;"></a>
                    <div class="product-info">
                      <h4 class="product-title"><a href="#"><?= $r["judul"]; ?></a></h4><span><em>Harga:</em> <?= $harga; ?></span>
                    </div>
                  </div>
                </td>
                <td class="text-center">
                  <div class="count-input">
                    <form action="update-keranjang-<?= $r['id_keranjang'] ?>" method="POST">
                      <input class="form-control col-sm-7" name="jml" value="<?= $r['jumlah_beli']; ?>">
                      <button type="submit" name="simpanP" class="btn-success col-sm-4 text-center" style="height:45px"><span class='glyphicon glyphicon-plus' style="margin-left:-5px;"></button>
                    </form>
                  </div>

                </td>
                <td class="text-center text-lg text-medium"><?= $r['size']; ?></td>
                <td class="text-center text-lg text-medium"><?= $sub; ?></td>
                <td class="text-center"><a class="remove-from-cart" href="del-keranjang-<?= $r['id_keranjang']; ?>" data-toggle="tooltip" title="Remove item">
                    <i class="icon-cross"></i></a></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
      </table>
    </div>
    <div class="shopping-cart-footer">
      <div class="column text-lg">Subtotal: <span class="text-medium"><?= $subtot; ?></span></div>
    </div>
    <div class="shopping-cart-footer">
      <div class="column"><a class="btn btn-outline-secondary" href="shop">
          <i class="icon-arrow-left"></i>&nbsp;Lanjut Belanja</a>
      </div>
      <?php //var_dump($arr); 
      ?>
      <!-- <div class="column"><a class="btn btn-primary" href="https://api.whatsapp.com/send?phone=62819629431&text=Saya ingin membeli produk ini <?php // foreach ($arr as $ar) : 
                                                                                                                                                    ?>
        <?php //echo $ar['judul'] . ", "; 
        ?>
      <?php // endforeach; 
      ?> Apakah masih tersedia ?">
      </div> -->
    <?php } ?>
    <form action="pembayaran3" method="POST">
      <!-- <div class="column"><button type="submit" class="btn btn-primary " name="next">Lanjut Kepembayaran (Gojek)</button>
      </div> -->
    </form>
    <form action="pembayaran" method="POST">
      <div class="column"><button type="submit" class="btn btn-primary " name="next">Lanjut Kepembayaran</button>
      </div>
    </form>
    </div>
    <br>
    <hr>
    <!-- Related Products Carousel-->
    <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">Produk Lainnya</h3>
    <!-- Carousel-->
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
      <!-- Product-->
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
        $harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
        $harga = "Rp. " . number_format($r['harga'], 0, ',', '.');
        $judul = substr($r['judul'], 0, 20) . "...";
      ?>
        <!-- Product-->
        <div class="grid-item">
          <div class="product-card">
            <a class="product-thumb" href="view-produk-<?= $r['id_produk']; ?>">
              <center><img src="img/produk/<?= $r['foto'] ?>" alt="Product" style="height: 185px; width: 75%;"></center>
            </a>
            <h3 class="product-title"><a href="view-produk-<?= $r['id_produk']; ?>"><?= $judul; ?></a></h3>
            <h4 class="product-price">
              <?php 
                    if($_SESSION['jenis_toko'] == 'Grosir'){
                          echo $harga_grosir;
                      }else{
                        echo $harga;
                } ?>
            </h4>
            <div class="product-buttons">
              <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
              <a class="btn btn-outline-primary btn-sm" href="view-produk-<?= $r['id_produk']; ?>">View Products</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <!-- Site Footer-->