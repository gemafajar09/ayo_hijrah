<style>
	.putih {
		color: #fff;
	}
</style>
<?php
if (@$_SESSION['idcs'] == '') {
	echo "<script>window.location='login.php';</script>";
} else {
	if (isset($_POST['next'])) {
		function isi_keranjang()
		{
			global $con;
			$isikeranjang = array();
			$sid = $_SESSION['idcs'];
			$sql = mysqli_query($con, "SELECT * FROM tb_transaksi_tmp WHERE id_customer='$sid'");
			while ($r = mysqli_fetch_array($sql)) {
				$isikeranjang[] = $r;
			}
			return $isikeranjang;
		}

		$isikeranjang = isi_keranjang();
		$jml          = count($isikeranjang);
		// Merubah stok di tabel produk
		for ($i = 0; $i < $jml; $i++) {
			$sqlpr = mysqli_query($con, "SELECT * FROM tb_produk WHERE id_produk={$isikeranjang[$i]['id_produk']}");
			$rpr = mysqli_fetch_array($sqlpr);
			$stok = $rpr["stok"];
			if ($stok < $isikeranjang[$i]['jml']) { ?>
				<script>
					swal({
							title: "Stok Barang Tidak Mencukupi",
							text: "Mohon Periksa Lagi Stok yang Tersedia",
							icon: "warning"
						})
						.then((value) => {
							window.location = "?module=keranjang";
						});
				</script>
		<?php
			}
		}

		?>

		<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<h3>Detail Pemesanan</h3>
						<div class="cart_container" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
							<div class="table table-responsive">
								<table class="table ">
									<tr class="bg-primary">
										<th class="text-center putih">No</th>
										<th class="putih">Foto</th>
										<th class="putih">Judul</th>
										<th class="text-center putih">Jumlah</th>
										<th class="text-center putih">Ukuran</th>
										<th class="text-right putih">Harga</th>
										<th class="text-right putih">Total</th>
									</tr>
									<?php
									// $sql = mysqli_query($con, "SELECT k.*,p.* FROM tb_transaksi_tmp k LEFT JOIN tb_produk p ON k.kd_produk=p.kd_produk WHERE k.id_customer='$_SESSION[idcs]'");
									// $sql = mysqli_query($con, "
									// 		SELECT *,
									// 		       (SELECT Group_concat(tmp.size ORDER BY tmp.size ASC)
									// 		        FROM   tb_transaksi_tmp tmp
									// 		        WHERE  tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
									// 		               AND tmp.kd_produk = tb_transaksi_tmp.kd_produk) AS size_dibeli,
									// 		       (SELECT Group_concat(size_tersedia.ukuran ORDER BY size_tersedia.ukuran
									// 		               ASC)
									// 		        FROM   tb_produk produk
									// 		               JOIN tb_detail_size size_tersedia
									// 		                 ON produk.kd_produk = size_tersedia.kd_produk
									// 		        WHERE  produk.kd_produk = tb_transaksi_tmp.kd_produk AND size_tersedia.stok != 0)  AS size_tersedia
									// 		FROM   tb_transaksi_tmp,
									// 		       tb_produk,
									// 		       tb_customer
									// 		WHERE  tb_transaksi_tmp.kd_produk = tb_produk.kd_produk
									// 		       AND tb_transaksi_tmp.id_customer = tb_customer.id_customer
									// 			   AND tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'");

									// $sql = mysqli_query($con, "SELECT * FROM (SELECT tb_transaksi_tmp.id_keranjang,
									// 							tb_transaksi_tmp.id_customer,
									// 							tb_produk.judul,
									// 							tb_produk.foto,
									// 							tb_produk.berat,
									// 							tb_produk.harga_eceran,
									// 							tb_produk.harga_grosir,
									// 					(SELECT Group_concat(tmp.size
									// 											ORDER BY tmp.size ASC)
									// 						FROM tb_transaksi_tmp tmp
									// 						WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
									// 						AND tmp.kd_produk = tb_transaksi_tmp.kd_produk) AS size_dibeli,
														
									// 					(SELECT Group_concat(tmp.kd_produk
									// 											ORDER BY tmp.size ASC)
									// 						FROM tb_transaksi_tmp tmp
									// 						WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
									// 						AND tmp.kd_produk = tb_transaksi_tmp.kd_produk) AS kd_produk,
														
									// 					(SELECT Group_concat(tmp.jumlah_beli
									// 											ORDER BY tmp.size ASC)
									// 						FROM tb_transaksi_tmp tmp
									// 						WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
									// 						AND tmp.kd_produk = tb_transaksi_tmp.kd_produk) AS jumlah_beli,
														
									// 					(SELECT Group_concat(size_tersedia.ukuran
									// 											ORDER BY size_tersedia.ukuran ASC)
									// 						FROM tb_produk produk
									// 						JOIN tb_detail_size size_tersedia ON produk.kd_produk = size_tersedia.kd_produk
									// 						WHERE produk.kd_produk = tb_transaksi_tmp.kd_produk
									// 						AND size_tersedia.stok != 0) AS size_tersedia
									// 					FROM tb_transaksi_tmp,
									// 						tb_produk,
									// 						tb_customer
									// 					WHERE tb_transaksi_tmp.kd_produk = tb_produk.kd_produk
									// 					AND tb_transaksi_tmp.id_customer = tb_customer.id_customer
									// 					AND tb_transaksi_tmp.id_customer = '$_SESSION[idcs]') produk GROUP BY produk.kd_produk");


									$sql = mysqli_query($con, "SELECT * FROM (SELECT 
																tb_transaksi_tmp.id_customer,
																tb_produk.judul,
																tb_produk.foto,
																tb_produk.berat,
																tb_produk.harga_eceran,
																tb_produk.harga_grosir,
                                SUM(tb_transaksi_tmp.jumlah_beli) as total_beli,
                                (SELECT Group_concat(tmp.id_keranjang
																				ORDER BY tmp.size ASC)
															FROM tb_transaksi_tmp tmp
															WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
															AND tmp.kd_produk = tb_transaksi_tmp.kd_produk GROUP BY tmp.kd_produk) AS id_keranjang,
														(SELECT Group_concat(tmp.size
																				ORDER BY tmp.size ASC)
															FROM tb_transaksi_tmp tmp
															WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
															AND tmp.kd_produk = tb_transaksi_tmp.kd_produk GROUP BY tmp.kd_produk) AS size_dibeli,
														
														(SELECT Group_concat(tmp.kd_produk
																				ORDER BY tmp.size ASC)
															FROM tb_transaksi_tmp tmp
															WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
															AND tmp.kd_produk = tb_transaksi_tmp.kd_produk GROUP BY tmp.kd_produk) AS kd_produk,
														
														(SELECT Group_concat(tmp.jumlah_beli
																				ORDER BY tmp.size ASC)
															FROM tb_transaksi_tmp tmp
															WHERE tb_transaksi_tmp.id_customer = '$_SESSION[idcs]'
															AND tmp.kd_produk = tb_transaksi_tmp.kd_produk GROUP BY tmp.kd_produk) AS jumlah_beli,
														
														(SELECT Group_concat(size_tersedia.ukuran
																				ORDER BY size_tersedia.ukuran ASC)
															FROM tb_produk produk
															JOIN tb_detail_size size_tersedia ON produk.kd_produk = size_tersedia.kd_produk
															WHERE produk.kd_produk = tb_transaksi_tmp.kd_produk
															AND size_tersedia.stok != 0) AS size_tersedia
														FROM tb_transaksi_tmp,
															tb_produk,
															tb_customer
														WHERE tb_transaksi_tmp.kd_produk = tb_produk.kd_produk
														AND tb_transaksi_tmp.id_customer = tb_customer.id_customer
														AND tb_transaksi_tmp.id_customer = '$_SESSION[idcs]' GROUP BY tb_transaksi_tmp.kd_produk) produk GROUP BY produk.kd_produk");

									$cek = mysqli_num_rows($sql);
									if ($cek == 0) { ?>
										<tr>
											<td colspan=7>Keranjang Belanja Anda Masih Kosong</td>
										</tr>
										<?php
									} else {
										$no = 0;
										$_SESSION['data_detail_transaksi_tmp'] = array();
										$data_detail_transaksi = array();
										while ($r = mysqli_fetch_assoc($sql)) {
											$no++;
											// var_dump($r['size']);
											// exit;
											// if($r['size'] != 'S' && 'M' && 'L' && 'XL'){
											// 	echo 'harga eceran';
											// }else{
											// 	echo 'harga gorsir';
											// }

											$size_tersedia = count(explode(",", $r['size_tersedia']));

											$size = $r['size_dibeli'];
											$ukuran = explode(",", $size);

											$jbeli = $r['jumlah_beli'];
											$jumlah_beli = explode(",", $jbeli);

											$kdproduk1 = $r['kd_produk'];
											$kd_produk = explode(",", $kdproduk1);

											foreach ($ukuran as $no => $u) {
												$harga_asli = 0;
												if ($_SESSION['jenis_toko'] == 'Grosir' && $r['size_dibeli'] == $r['size_tersedia'] && $r['total_beli'] >= (12 * count($size_tersedia) && $r['jumlah_beli'] >= 12)) {
													$harga_asli = $r['harga_grosir'];
													$harga = "Rp. " . number_format($r['harga_grosir']);
													$total = $r['harga_grosir'] * $jumlah_beli[$no];
												} else {
													$harga_asli = $r['harga_eceran'];
													$harga = "Rp. " . number_format($r['harga_eceran']);
													$total = $r['harga_eceran'] * $jumlah_beli[$no];
												}
												$sub = $harga_asli * $jumlah_beli[$no];
												$rand = rand(2, 100);
												@$subtot += $sub + $rand;

												$totalakhir = $subtot;
												$berat = $r['berat'] * $jumlah_beli[$no];
												@$subberat += $berat;

												$data_detail_transaksi[] = array(
													"kd_produk" => $kd_produk[$no],
													"id_customer" => $_SESSION['idcs'],
													"size" => $u,
													"jumlah_beli" => $jumlah_beli[$no],
													"total_harga" => $total,
													"harga" => $harga_asli
												);
										?>
												<tr>
													<td class="text-center"><?php echo $no + 1; ?></td>
													<td><img src="img/produk/<?= $r['foto'] ?>" alt="" style="width : 70px; height: 90px;"></td>
													<td><?= $r['judul'] ?></td>
													<td class="text-center"><?= $jumlah_beli[$no] ?></td>
													<td class="text-center"><?= $u ?></td>
													<td class="text-right"><?= $harga ?></td>
													<td class="text-right">Rp.<?= number_format($total) ?></td>
												</tr>
											<?php
											}
											?>

									<?php }
									}
									$_SESSION['data_detail_transaksi_tmp'] = $data_detail_transaksi;

									?>
								</table>
							</div>
						</div>
						<br><br>

					</div>

					<div class="col-lg-4" style="margin-top: 36px;">
						<form action="simpantrans" method="POST">
							<h3>Alamat Kirim</h3>
							<div class="contact_form_container">
								<div class="form-group col-md-12">
									<label for="nama">Nama *</label>
									<input type="text" id="nama" name="namapenerima" class="form-control" required>
								</div>
								<div class="form-group col-md-12">
									<label for="id_prov">Provinsi *</label>
									<?php
									$curl = curl_init();
									//$url_api = "http://api.rajaongkir.com/starter/province";
									//$key_api = "9d5dfc29026612d5563df0fb3840bf96";

									$url_api = "https://pro.rajaongkir.com/api/province";
									$key_api = "80ebd4a124cc35bd4322a8105e34c20f";

									curl_setopt_array($curl, array(
										CURLOPT_URL => $url_api,
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 30,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "GET",
										CURLOPT_HTTPHEADER => array(
											"key: $key_api"
										),
									));
									$response = curl_exec($curl);
									$err = curl_error($curl);
									?>
									<select class="form-control" name="id_prov" id="provinsi" required>
										<option selected>Pilih Provinsi</option>
										<?php
										$data = json_decode($response, true);
										for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
										?>
											<option value="<?php echo $data['rajaongkir']['results'][$i]['province_id'] ?>"><?php echo $data['rajaongkir']['results'][$i]['province'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label for="id_kota">Kota *</label>
									<select class="form-control" name="id_kota" id="kabupaten" required>
										<option selected>Pilih Kota</option>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label for="kodepos">Kode Pos</label>
									<input type="text" name="kodepos" id="kodepos" class="form-control" onkeypress="return hanyaAngka(event)" required>
								</div>
								<div class="form-group col-md-12">
									<label for="alamat">Alamat *</label>
									<textarea name="alamat" id="alamat" rows="4" cols="80" class="form-control"></textarea>
								</div>

								<h3>Jenis Pengiriman</h3>
								<div>
									<div class="form-group">
										<div class="col-md-10">
											<div class="col-md-auto">
												<?php
												$kurir = array('jne', 'jnt', 'gojek', 'Jemput Toko');
												foreach ($kurir as $rkurir) {
												?>
													<label class="radio-inline" name="pilihan_kurir">
														<input type="radio" name="kurir" class="kurir" value="<?php echo $rkurir; ?>" /> <?php echo strtoupper($rkurir); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													</label>
												<?php
												}
												?>
											</div>
										</div>
									</div><br>
									<div id="kuririnfo" style="display: none; ">
										<div class="form-group">
											<div class="col-md-12">
												<div class='alert alert-info' style='padding:5px; border-radius:0px; margin-bottom:0px'>Service</div>
											</div>
										</div>
										<hr>
										<div class="form-group">
											<div class="col-md-12" style="padding:10px">
												<div class="form-row ml-3 " id="kurirserviceinfo"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
							<h3>Total Pembayaran</h3>
							<div class="order_total_content text-md-right" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
								<div class="order_total_title form-group">
									<div class="">Sub-Total &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <b>Rp. <?= number_format(@$subtot); ?></b></div>
								</div>
								<div class="order_total_title form-group">
									<div class="">Berat &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <b><?= $subberat . " Gram" ?></b></div>
								</div>
								<div class="order_total_title" id="biayap">Biaya Pengiriman &nbsp;:&nbsp; <a class="order_total_amount" id="jmlongkir"></a></div>
								<div class="order_total_title" id="testotal"><b>Total Bayar</b><?= "Rp. " . number_format($totalakhir) ?></div>
								<input type="hidden" id="berat" name="berat" value="<?= $subberat ?>">
								<input type="hidden" name="total" id="total" value="<?php echo $subtot; ?>" />
								<input type="hidden" name="ongkir" id="ongkir" value="0" />
								<input type="hidden" name="totalbayar" id="totalbayar" />
								<div class="form-group col-md-12">
									<button type="submit" class="btn btn-primary btn-block" name="pesan" style="cursor: pointer; display: none;" id="oksimpan">CHECKOUT</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
		<br>
		<br>
		<br>
		<br>
	<?php
	} else { ?>
		<script>
			window.location.href = "keranjang";
			// window.location.href = "?module=keranjang";
		</script>
<?php
	}
}
?>
<script>
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}

	function tampilPilihanGojek() {
		var kota = document.getElementsByName("id_kota")[0].options[document.getElementsByName("id_kota")[0].selectedIndex].text;
		if (kota != "Padang") {
			document.getElementsByName("kurir")[3].disabled = true;
			document.getElementsByName("pilihan_kurir")[3].style.display = "none";
		} else {
			document.getElementsByName("kurir")[3].disabled = false;
			document.getElementsByName("pilihan_kurir")[3].style.display = "inline";
		}
	}

	document.getElementsByName("id_kota")[0].addEventListener("change", tampilPilihanGojek);
	document.getElementsByName("id_prov")[0].addEventListener("change", tampilPilihanGojek);

	tampilPilihanGojek();

	function jemputLokasi() {
		var kota = document.getElementsByName("id_kota")[0].options[document.getElementsByName("id_kota")[0].selectedIndex].text;
		document.getElementsByName("kurir")[4].disabled = false;
		document.getElementsByName("pilihan_kurir")[4].style.display = "inline";

	}

	document.getElementsByName("id_kota")[0].addEventListener("change", jemputLokasi);
	document.getElementsByName("id_prov")[0].addEventListener("change", jemputLokasi);

	jemputLokasi();
</script>