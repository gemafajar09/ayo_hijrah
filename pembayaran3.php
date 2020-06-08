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
			$sql = mysqli_query($con, "SELECT * FROM tbl_keranjang WHERE id_customer='$sid'");
			while ($r = mysqli_fetch_array($sql)) {
				$isikeranjang[] = $r;
			}
			return $isikeranjang;
		}

		$isikeranjang = isi_keranjang();
		$jml          = count($isikeranjang);
		// Merubah stok di tabel produk
		for ($i = 0; $i < $jml; $i++) {
			$sqlpr = mysqli_query($con, "SELECT * FROM tbl_produk WHERE id_produk={$isikeranjang[$i]['id_produk']}");
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
										<th class="text-right putih">Harga</th>
										<th class="text-right putih">Total</th>
									</tr>
									<?php
									$sql = mysqli_query($con, "SELECT k.*,p.* FROM tbl_keranjang k LEFT JOIN tbl_produk p ON k.id_produk=p.id_produk WHERE k.id_customer='$_SESSION[idcs]'");

									$cek = mysqli_num_rows($sql);
									if ($cek == 0) { ?>
										<tr>
											<td colspan=7>Keranjang Belanja Anda Masih Kosong</td>
										</tr>
										<?php
									} else {
										$no = 0;
										while ($r = mysqli_fetch_assoc($sql)) {
											$no++;
											$harga = "Rp. " . number_format($r['harga']);
											$total = "Rp. " . number_format($r['harga'] * $r['jml']);
											$sub = $r['harga'] * $r['jml'];
											// $rand = rand(2, 100);
											@$subtot += $sub;

											$totalakhir = $subtot;
											$berat = $r['berat'] * $r['jml'];
											@$subberat += $berat;

										?>
											<tr>
												<td class="text-center"><?php echo $no; ?></td>
												<td><img src="foto/produk/<?= $r['foto'] ?>" alt="" style="width : 70px; height: 90px;"></td>
												<td><?= $r['judul'] ?></td>
												<td class="text-center"><?= $r['jml'] ?></td>
												<td class="text-right"><?= $harga ?></td>
												<td class="text-right"><?= $total ?></td>
											</tr>
									<?php }
									} ?>
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
									<label for="alamat">Alamat *</label>
									<textarea name="alamat" id="alamat" rows="4" cols="80" class="form-control"></textarea>
								</div>

								<h3>Jenis Pengiriman</h3>
								<div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="radio-inline">
												<input type="text" name="kurir" class="form-control" readonly value="Gojek" />
											</label>
										</div>
									</div>
								</div>

							</div>
							<br>
							<h3>Total Pembayaran</h3>
							<div class="order_total_content text-md-right" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
								<div class="order_total_title form-group">
									<div class="">Sub-Total &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <b>Rp. <?= number_format(@$subtot); ?></b></div>
								</div>
								<div class="order_total_title form-group">
									<div class="">Berat &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <b><?= $subberat . " Gram" ?></b></div>
								</div>
								<div class="order_total_title" id="biayap">Belum Termasuk Biaya Pengiriman<a class="order_total_amount" id="jmlongkir"></a></div>
								<div class="order_total_title" id="testotal"><b>Total Bayar </b><?= "Rp. " . number_format($subtot) ?></div>
								<input type="hidden" name="total" readonly value="<?= $totalakhir ?>">
								<input type="hidden" name="berat" readonly value="<?= $subberat ?>">
								<div class="form-group col-md-12">
									<button type="submit" class="btn btn-primary btn-block" name="pesan2">CHECKOUT</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	<?php
	} else { ?>
		<script>
			window.location.href = "?module=keranjang";
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
</script>