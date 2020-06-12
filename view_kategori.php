<?php

$id = $_GET['id_kategori'];
// var_dump($id);
// exit;

// $sql = mysqli_query($con, "SELECT id_produk,kd_produk,tb_kategori.id_kategori,id_brand,judul,berat,
//                             deskripsi, harga_grosir, harga_eceran, diskon, foto, status, jenis, judul_seo
//                             tgl_input, nama_kategori, seo_kategori
//                             FROM tb_produk 
//                             JOIN tb_kategori
//                             ON tb_kategori.id_kategori = tb_produk.id_kategori
//                             where tb_kategori.id_kategori='$id'");
$sql = mysqli_query($con, "SELECT * FROM tb_kategori WHERE id_kategori = '$id'");
$r = mysqli_fetch_assoc($sql);
// var_dump($r);

?>
<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper" style="background:url(foto/background/sft.jpg)">
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Shop Kategori <?= $r['nama_kategori'] ?> </h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="index.php">Home</a>
					</li>
					<li class="separator">&nbsp;</li>
					<li>Shop Kategori <?= $r['nama_kategori'] ?></li>
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

						<!-- <form action="" method="POST">
							<div class="shop-sorting">
								<select class="form-control" name="cari" id="sorting">
									<option value="">--Pilih Merek--</option> -->
						<?php
						// $result = mysqli_query($con, "select * from tbl_merek");
						// $jsArray = "var dtind = new Array();\n";
						// while ($row = mysqli_fetch_array($result)) {
						// 	echo '<option value="' . $row['id_merek'] . '">' . $row['nama_merek'] . '</option>';
						// }
						?>

						<!-- </select> -->
						<!-- <input name='q' type='text' id="q" placeholder="Tipe Hp" class="form-control input-small"> -->
						<!-- <input type="submit" name="cari2" class="btn btn-info" value="Cari">
					</div>
					</form> -->

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
					$pg = isset($_GET['pg']) ? $_GET['pg'] : "";
					if (empty($pg)) {
						$posisi = 0;
						$pg = 1;
					} else {
						$posisi = ($pg - 1) * $batas;
					}

					$jml_data = mysqli_query($con, "SELECT * FROM tb_produk where id_kategori ='$id'");
                    $total = mysqli_num_rows($jml_data);
                    $pages = ceil($total / $batas);

                    if($total == 0){
                        echo "<h1>Data Barang Sedang Kosong...</h1>";
                    }

					if (isset($_POST["cari2"])) {
						$cari = $_POST['cari'];
						$q = $_POST['q'];
						$sql = mysqli_query($con, "SELECT * FROM tb_produk,tb_brand where tb_produk.id_merek=tb_brand.id_merek AND tb_brand.id_merek like '%$cari%' and tb_produk.judul like '%$q%' and tb_produk.stok > 0 LIMIT $posisi, $batas");
					} else {
						$sql = mysqli_query($con, "SELECT * FROM tb_produk WHERE id_kategori = $id LIMIT $posisi, $batas");
					}
					while ($r = mysqli_fetch_assoc($sql)) {
						$harga_grosir = "Rp. " . number_format($r['harga_grosir'], 0, ',', '.');
						$harga_eceran = "Rp. " . number_format($r['harga_eceran'], 0, ',', '.');
						$judul = substr($r['judul'], 0, 25) . "...";
						$status = $r['status'];
					?>

						<div class="grid-item">
							<div class="product-card ">
								<a class="product-thumb" href="view-produk-<?= $r['id_produk']; ?>">
									<center><img src="img/produk/<?= $r['foto'] ?>"  style="height: 185px;"></center>
								</a>
								<h3 class="product-title"><a href="view-produk-<?= $r['id_produk']; ?>"><?= $judul; ?></a></h3>
								<h4 class="product-price">
								
								<?php 
				                    if($_SESSION['jenis_toko'] == 'Grosir'){
				                          echo $harga_grosir;
				                      }else{
				                        echo $harga_eceran;
				                } ?>
								</h4>
								<div class="product-buttons">
									<button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
								<?php
									if ($status != 'T') {

										echo "<a class='btn btn-outline-primary btn-sm' href='view-produk-$r[id_produk]'>View Products</a>";
									} else {
										echo "<a class='btn btn-outline-danger btn-sm'>SOLD OUT</a>";
									}
									?>
								</div>
							</div>
						</div>
                    <?php }
                    ?>

				</div>
				<!-- Pagination-->
				<nav class="pagination">
					<div class="column">
						<ul class="pagination">
							<?php
							if ($pg > 1) { ?>
								<li class="page-item">
								<?php
								echo "<a class='page-link' href='kategori-<?= $id?>-page" . ($pg - 1) . "'>
										<span aria-hidden='true'>&laquo;</span></a>";
							} ?>
								</li>
							<?php for ($i = 1; $i <= $pages; $i++) { ?>
								<li class="page-item">
									<a class="page-link" href="kategori-<?= $id?>-page-<?php echo $i; ?>"><?php echo $i; ?></a>
								</li>
							<?php } ?>
							<?php
							if ($pg < $pages) { ?>
								<li class="page-item">
							<?php
									echo "<a class='page-link' href='kategori-<?= $id?>-page-" . ($pg + 1) . "'>
									<span aria-hidden='true'>&raquo;</span></a>";
							} ?>
								</li>
						</ul>
					</div>
				</nav>
			</div>
			<!-- Sidebar          -->

		</div>
	</div>