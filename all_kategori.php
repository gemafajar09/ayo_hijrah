
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Shop Categories</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Shop Categories</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-2x mb-2">
        <div class="row">
          <!-- Sidebar          -->
          <div class="col-lg-3">
            <button class="sidebar-toggle position-left" data-toggle="modal" data-target="#modalShopCategories"><i class="icon-layout"> </i></button>
            <aside class="sidebar sidebar-offcanvas">
              <section class="widget widget-categories">
                <h3 class="widget-title">Popular Brands</h3>
                <ul>
                  <li><a href="#">Adidas</a><span>(254)</span></li>
                  <li><a href="#">Bilabong</a><span>(39)</span></li>
                  <li><a href="#">Brooks</a><span>(205)</span></li>
                  <li><a href="#">Calvin Klein</a><span>(128)</span></li>
                  <li><a href="#">Cole Haan</a><span>(104)</span></li>
                  <li><a href="#">Columbia</a><span>(217)</span></li>
                  <li><a href="#">New Balance</a><span>(95)</span></li>
                  <li><a href="#">Nike</a><span>(310)</span></li>
                  <li><a href="#">Nine West</a><span>(134)</span></li>
                  <li><a href="#">Oakley</a><span>(73)</span></li>
                  <li><a href="#">Puma</a><span>(446)</span></li>
                  <li><a href="#">Scechers</a><span>(87)</span></li>
                  <li><a href="#">Tommy Bahama</a><span>(42)</span></li>
                  <li><a href="#">Tommy Hilfiger</a><span>(289)</span></li>
                  <li><a href="#">Valentino</a><span>(68)</span></li>
                </ul>
              </section>
            </aside>
          </div>
          <!-- Categories-->
          <div class="col-lg-9">
            <!-- Promo banner-->
            <div class="alert alert-image-bg alert-dismissible fade show text-center mb-4" style="background-image: url(img/banners/alert-bg.jpg);"><span class="alert-close text-white" data-dismiss="alert"></span>
              <div class="h3 text-medium text-white padding-top-1x padding-bottom-1x"><i class="icon-clock" style="font-size: 33px; margin-top: -5px;"></i>&nbsp;&nbsp;Check our Limited Offers. Save up to 50%&nbsp;&nbsp;&nbsp;
                <div class="mt-3 hidden-xl-up"></div><a class="btn btn-primary" href="#">View Offers</a>
              </div>
            </div>
            <div class="row">
			<?php
					$batas = 36; //jumlah data per halaman
					$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
					if (empty($pg)){
						$posisi=0;
						$pg=1;
					}else{
						$posisi= ($pg - 1) * $batas;
					}

					$jml_data = mysqli_query($con, "SELECT * FROM tbl_produk");
					$total=mysqli_num_rows($jml_data);
					$pages=ceil($total/$batas);

				$sql = mysqli_query($con, "SELECT * FROM tbl_produk LIMIT $posisi, $batas");
				while($r=mysqli_fetch_assoc($sql)){
					$harga = "Rp. ".number_format($r['harga'],0,',','.');
					$judul = substr($r['judul'],0,20)."...";
			?>
              <div class="col-sm-6">
                <div class="card mb-30"><a class="card-img-tiles" href="shop-grid-ls.html">
                    <div class="inner">
                      <div class="main-img"><center><img src="foto/produk/<?= $r['foto'] ?>" alt="Category" style="height: 185px; width: 75%;"></center></div>
                    </div></a>
                  <div class="card-body text-center">
                    <h4 class="card-title"><?= $judul; ?></h4>
                    <p class="text-muted"><?= $harga; ?></p><a class="btn btn-outline-primary btn-sm" href="shop-grid-ls.html">View Products</a>
                  </div>
                </div>
              </div>
				<?php } ?>
             <nav class="pagination">
              <div class="column">
                <ul class="pages">
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li>...</li>
                  <li><a href="#">12</a></li>
                </ul>
              </div>
              <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="#">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
            </nav>
            </div>
          </div>
        </div>
      </div>
     