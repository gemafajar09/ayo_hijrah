
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Shop All Kategori</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="./">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Shop All Kategori</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Products-->
          <div class="col-xl-12 col-lg-12 order-lg-2">
            <!-- Shop Toolbar-->
            <div class="shop-toolbar padding-bottom-1x mb-2">
              <div class="column">
               
			   <form action="" method="POST">
				<div class="shop-sorting">
                  <select class="form-control" name="cari" id="sorting">
					<option value="">--Pilih Merek--</option>
					<?php
						$result = mysqli_query($con, "select * from tbl_merek");   
						$jsArray = "var dtind = new Array();\n";       
						while ($row = mysqli_fetch_array($result)) {   
							echo '<option value="' . $row['id_merek'] . '">' . $row['nama_merek'] . '</option>';   
						}							
					?>
					  
				  </select>
				   <input name='q' type='text' id="q"  placeholder="Tipe Hp" class="form-control input-small">
				  <input type="submit" name="cari2" class="btn btn-info" value="Cari">
                </div>
				</form>
				
              </div>
              <div class="column">
                <div class="shop-view"><a class="grid-view active" href="shop-d"><span></span><span></span><span></span></a><a class="list-view" href="shop-d"><span></span><span></span><span></span></a></div>
              </div>
            </div>
            <!-- Products Grid-->
            <div class="isotope-grid cols-4 mb-2">
              <div class="gutter-sizer"></div>
              <div class="grid-sizer"></div>
              <!-- Product-->
			  <?php
					$batas = 16; //jumlah data per halaman
					$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
					if (empty($pg)){
						$posisi=0;
						$pg=1;
					}else{
						$posisi= ($pg - 1) * $batas;
					}

					$jml_data = mysqli_query($con, "SELECT * FROM tbl_produk where stok > 0 AND jenis='Bekas'");
					$total=mysqli_num_rows($jml_data);
					$pages=ceil($total/$batas);
					
				if (isset($_POST["cari2"])){
					$cari =$_POST['cari'];
					$q =$_POST['q'];
					$sql = mysqli_query($con, "SELECT * FROM tbl_produk,tbl_merek where tbl_produk.id_merek=tbl_merek.id_merek AND tbl_merek.id_merek like '%$cari%' and tbl_produk.judul like '%$q%' and tbl_produk.stok > 0 AND jenis='Bekas' LIMIT $posisi, $batas");
				} else{
				$sql = mysqli_query($con, "SELECT * FROM tbl_produk where jenis='Bekas' AND stok > 0 LIMIT $posisi, $batas");
				}
				while($r=mysqli_fetch_assoc($sql)){
					$harga = "Rp. ".number_format($r['harga'],0,',','.');
					$judul = substr($r['judul'],0,20)."...";
			?>
			  
              <div class="grid-item">
                <div class="product-card " >
                  <a class="product-thumb" href="view-produk-<?= $r['id_produk'];?>" ><center><img src="foto/produk/<?= $r['foto'] ?>" alt="Product" style="height: 185px;"></center></a>
                  <h3 class="product-title"><a href="view-produk-<?= $r['id_produk'];?>"><?= $judul; ?></a></h3>
                  <h4 class="product-price">
                  <?= $harga; ?>
                  </h4>
                  <div class="product-buttons">
                    <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                    <a class="btn btn-outline-primary btn-sm" href="view-produk-<?= $r['id_produk'];?>">View Products</a>
                  </div>
                </div>
              </div>
						  <?php } ?>
              
            </div>
            <!-- Pagination-->
            <nav class="pagination">
              <div class="column">
                <ul class="pagination">
								<?php
									if ($pg > 1){?>
									<li class="page-item">
									<?php
									echo "<a class='page-link' href='"."?module=shop&pg=".($pg-1)."'>
										<span aria-hidden='true'>&laquo;</span></a>";
									 } ?>
									</a>
								</li>
								  <?php for($i=1; $i<=$pages; $i++){ ?>
								  <li class="page-item">
									<a class="page-link" href="shop-<?php echo $i; ?>"><?php echo $i; ?></a>
								  </li>
								  <?php } ?>
								  <?php
								  if ($pg < $pages){ ?>
								  <li class="page-item">
									<?php
									echo "<a class='page-link' href='"."?module=shop&pg=".($pg+1)."'>
									<span aria-hidden='true'>&raquo;</span></a>";
								  } ?>
								</a>
							  </li>
							</ul>
              </div>
              <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
            </nav>
          </div>
          <!-- Sidebar          -->
          
        </div>
      </div>
      