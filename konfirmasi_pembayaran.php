<?php
$sql = mysqli_query($con, "SELECT * FROM tb_transaksi where id_transaksi='$_GET[id_transaksi]'");
$r = mysqli_fetch_assoc($sql);
?>
<div class="page-title">
	<div class="container">
		<div class="column">
			<h1>Konfirmasi Pembayaran</h1>
		</div>
		<div class="column">
			<ul class="breadcrumbs">
				<li><a href="index.html">Home</a>
				</li>
				<li class="separator">&nbsp;</li>
				<li>Konfirmasi Pembayaran</li>
			</ul>
		</div>
	</div>
</div>

<section class="container " style="padding-bottom:10px;">
	<h3 class="text-center ">Konfirmasi Pembayaran</h3>
	<div class="text center mx-auto d-block">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-lg-12 col-lg-offset-12 " style="border:1px solid #e8e8eb;border-radius:5px;padding:10px;">
				<input type="hidden" name="id_transaksi" value="<?= $r['id_transaksi'] ?>">
				<input type="hidden" name="totalbayar" value="<?= $r['total'] ?>">
				<div class="form-group col-md-12">
					<label for="nama" style="font-size: 16px;">Bukti Pembayaran *</label>
					<input type="file" name="gambar" class="form-control" required>
					<font color="red" size="4">*</font>
					<font size="2"><b>Nb : Ukuran Foto Maksimal 2mb</b></font>
				</div>
				<div class="form-group col-md-12">
					<input type="submit" name="pesan" value="Konfirmasi" class="btn btn-info" required>
				</div>
			</div>
		</form>
	</div>
</section>

<?php
$tgl = date("Y-m-d H:i:s");
if (isset($_POST["pesan"])) {
	$allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
	$lokfoto = $_FILES["gambar"]["tmp_name"];
	$file_tmp = $_FILES["gambar"]["tmp_name"];
	$ukuran_foto = $_FILES['gambar']['size'];
	$file_name = explode('.', $_FILES["gambar"]["name"]);
	$nama_file = end($file_name);
	$file_ext = strtolower($nama_file);

	if ($ukuran_foto < 2048576) {
		if (!in_array($file_ext, $allowed)) {
			echo "<script>
					window.alert('Gambar Tidak Valid');
					window.location='./';
				</script>";
		} else {
			$newbukti = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
			$pindah = move_uploaded_file($lokfoto, "img/bukti/$newbukti");
			$sqlpr = mysqli_query($con, "INSERT INTO `tb_konfirmasi_bayar`(`id_transaksi`, `bukti`, `tgl_bayar`) VALUES ('$_POST[id_transaksi]' , '$newbukti', '$tgl')");

			$update = mysqli_query($con, " UPDATE tb_transaksi set status_order='Menunggu Konfirmasi' where id_transaksi='$_GET[id_transaksi]'");

			echo "<script>
					window.alert('Konfirmasi berhasil');
					window.location='./';	
				</script>";
		}
	} else {
		echo  "<script>
                	alert('Maksimal Upload Foto 2 MB');
                </script>";
	}
}
?>