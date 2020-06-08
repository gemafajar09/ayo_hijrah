<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Shop List Left Sidebar</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="index.html">Home</a>
					</li>
					<li class="separator">&nbsp;</li>
					<li>Shop List Left Sidebar</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Page Content-->
	<div class="container padding-bottom-3x mb-1">
		<div class="row">
			<!-- Products-->
			<div class="col-lg-10 col-lg-offset-1">
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
								<input type="submit" name="cari2" class="btn btn-info" value="Cari">
							</div>
						</form>
					</div>
					<div class="column">
						<div class="shop-view"><a class="grid-view" href="shop"><span></span><span></span><span></span></a><a class="list-view active" href="shop"><span></span><span></span><span></span></a></div>
					</div>
				</div>
				<!-- Product-->
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

				if (isset($_POST["cari2"])) {
					$cari = $_POST['cari'];
					$sql = mysqli_query($con, "SELECT * FROM tbl_produk,tbl_merek where tbl_produk.id_merek=tbl_merek.id_merek AND tbl_merek.id_merek like '%$cari%'  LIMIT $posisi, $batas");
				} else {
					$sql = mysqli_query($con, "SELECT * FROM tbl_produk LIMIT $posisi, $batas");
				}
				while ($r = mysqli_fetch_assoc($sql)) {
					$harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
					$harga = "Rp. " . number_format($r['harga'], 0, ',', '.');
					$harga_lama = "Rp. " . number_format($r['harga_lama'], 0, ',', '.');
					$judul = substr($r['judul'], 0, 20) . "...";
				?>
					<div class="product-card product-list"><a class="product-thumb" href="?module=shop">
							<img src="foto/produk/<?= $r['foto'] ?>" alt="Product"></a>
						<div class="product-info">
							<h3 class="product-title"><a href="shop-single.html"><?= $r["judul"]; ?></a></h3>
							<h4 class="product-price">
								<?php
								if (!empty($r["harga_lama"])) { ?>
									<del><?= $harga_lama; ?></del>
									<?= $harga; ?>
								<?php } ?>
								<?php
								if (empty($r["harga_lama"])) { ?>
									<?= $harga; ?>
								<?php } ?>
							</h4>
							<p class="hidden-xs-down"> <?= $r["deskripsi"]; ?></p>
							<div class="product-buttons">
								<button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
							<?php
									if ($r['stok'] > 0) {

										echo "<a class='btn btn-outline-primary btn-sm' href='view-produk-$r[id_produk]'>View Products</a>";
									} else {
										echo "<a class='btn btn-outline-danger btn-sm'>SOLD OUT</a>";
									}
									?>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="pt-2">
					<!-- Pagination-->
					<nav class="pagination">
						<div class="column">
							<ul class="pagination">
								<?php
								if ($pg > 1) { ?>
									<li class="page-item">
									<?php
									echo "<a class='page-link' href='" . "?module=shop&pg=" . ($pg - 1) . "'>
										<span aria-hidden='true'>&laquo;</span></a>";
								} ?>
									</a>
									</li>
									<?php for ($i = 1; $i <= $pages; $i++) { ?>
										<li class="page-item">
											<a class="page-link" href="?module=shop_d&pg=<?php echo $i; ?>"><?php echo $i; ?></a>
										</li>
									<?php } ?>
									<?php
									if ($pg < $pages) { ?>
										<li class="page-item">
										<?php
										echo "<a class='page-link' href='" . "?module=shop&pg=" . ($pg + 1) . "'>
									<span aria-hidden='true'>&raquo;</span></a>";
									} ?>
										</a>
										</li>
							</ul>
						</div>
						<div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="#">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
					</nav>
				</div>
			</div>
			<!-- Sidebar          -->

		</div>
	</div>