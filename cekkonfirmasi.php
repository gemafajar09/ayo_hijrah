<style>
	.putih{
		color: #fff;
	}
</style>
<?php
	if(@$_SESSION['idcs']==''){
		echo "<script>window.location='login.php';</script>";
	}

	if(isset($_POST['lanjutkan'])){
			$alamat = $_POST['alamat'];
			mysqli_query($con, "UPDATE tbl_customer SET alamat_aktif='$alamat'");

			$sql = mysqli_query($con, "SELECT * FROM tbl_alamat WHERE id_alamat='$_POST[alamat]'");
			$isial = mysqli_fetch_assoc($sql);
				$idkota = $isial['id_kota'];
				$idprov = $isial['id_prov'];
 				$kdpos = $isial['kodepos'];
 				$almt = $isial['alamat'];
				$nmpenerima = $isial['namaal'];
	}
?>
<!-- Cart -->

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
        <div class="row">
          <!-- Checkout Adress-->
          <div class="col-xl-12 col-lg-12">
			<h4>Review Your Order</h4>
            <hr class="padding-bottom-1x">
            <div class="table-responsive shopping-cart">
              <table class="table">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th class="text-center">Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
				<?php
				error_reporting(0);
										$sql = mysqli_query($con, "SELECT * FROM tbl_keranjang,tbl_produk where tbl_keranjang.id_produk=tbl_produk.id_produk AND tbl_keranjang.id_customer='$_SESSION[idcs]'");
										$cek = mysqli_num_rows($sql);
										if($cek == 0){ ?>
											<tr>
												<td colspan=7>Keranjang Belanja Anda Masih Kosong</td>
											</tr>
									<?php
									}else{
										$no=0;
										while($r=mysqli_fetch_assoc($sql)){
												$no++;
												$harga = "Rp. ".number_format($r['harga']);
												$total = "Rp. ".number_format($r['harga'] * $r['jml']);
												$sub = $r['harga'] * $r['jml'];
												$subtot += $sub;
									?>
                  <tr>
                    <td>
                      <div class="product-item"><a class="product-thumb" href="#"><img src="foto/produk/<?= $r['foto'] ?>" alt="Product"></a>
                        <div class="product-info">
                          <h4 class="product-title"><a href="shop-single.html"><?= $r["judul"];?></a></h4><span><em>Harga:</em> <?= $harga; ?></span>
                        </div>
                      </div>
                    </td>
                    <td class="text-center text-lg text-medium"><?= $sub; ?></td>
                  </tr>
                 
					<?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="shopping-cart-footer">
              <div class="column"></div>
              <div class="column text-lg">Subtotal: <span class="text-medium"><?= $subtot;?></span></div>
            </div>
            <div class="row padding-top-1x mt-3">
              <div class="col-sm-6">
			  <?php 
				$sql = mysqli_query($con, "SELECT * FROM tbl_alamat,tbl_customer where tbl_alamat.id_customer=tbl_customer.id_customer AND
				tbl_customer.id_customer='$_SESSION[idcs]'");
				$r = mysqli_fetch_assoc($sql);
			  ?>
                <h5>Shipping to:</h5>
                <ul class="list-unstyled">
                  <li><span class="text-muted">Client:</span><?= $_SESSION["nama"];?></li>
                  <li><span class="text-muted">Address:</span><?= $r["alamat"];?></li>
                  <li><span class="text-muted">Phone:</span><?= $r["nohp"];?></li>
                </ul>
              </div>
              
            </div>
			<form action="?module=simpantrans" method="POST">
            <div class="">
			<input type="hidden" name="ongkir" value="<?php echo $ongkir ?>">
							<input type="hidden" name="total" value="<?php echo $subtot ?>">
							<input type="hidden" name="idprov" value="<?php echo $r['id_prov'] ?>">
							<input type="hidden" name="idkota" value="<?php echo $r['id_kota'] ?>">
							<input type="hidden" name="almt" value="<?php echo $r['alamat'] ?>">
							<input type="hidden" name="kdpos" value="<?php echo $r['kodepos'] ?>">
							<input type="hidden" name="nmpenerima" value="<?php echo $_SESSION['nama'] ?>">
              <button type="submit" class="btn btn-primary" name="pesan" >Pesan Sekarang</button>
            </div>
			</form>
          </div>
          <!-- Sidebar          -->
          
        </div>
      </div>
      <!-- Site Footer-->
