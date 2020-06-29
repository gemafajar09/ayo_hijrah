<?php
session_start();

if (@$_SESSION['idcs'] == '') {
	echo "<script>window.location='login';</script>";
}
include "config/koneksi.php";
include "config/fungsi_id.php";

// fungsi untuk mendapatkan isi keranjang belanja
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

if (isset($_POST['pesan'])) {
	$kurir      = $_POST['kurir'];
	$service    = $_POST['service'];
	$nmpenerima = $_POST['namapenerima'];
	$kdpos      = $_POST['kodepos'];
	$almt       = $_POST['alamat'];
	$berat      = $_POST['berat'];
	$id_prov      = $_POST['id_prov'];
	$id_kota      = $_POST['id_kota'];
	$ongkir     = $_POST['ongkir'];
	$total      = $_POST['totalbayar'];
	$idcust     = $_SESSION['idcs'];

	$tanggal = date('Y-m-d');
	$jam_order = date('H:i:s');
	$tglskrg = date('Y-m-d H:i:s');
	$duahari = date('Y-m-d H:i:s', time() + (60 * 60 * 3));
	$dt = str_replace('-', '', substr($tanggal, 5, 5));
	$dj = str_replace(':', '', $jam_order);
	$invoice = $idcust . generateRandomUser(2, 1) . $dt . $dj;

	$transaksi = mysqli_query($con, "INSERT INTO `tb_transaksi`(
	`id_transaksi`, 
	`status_order`, 
	`tgl_order`, 
	`jam_order`, 
	`id_customer`, 
	`kurir`, 
	`service`,
	`ongkir`, 
	`total`, 
	`expired`, 
	`kodepos`, 
	`alamat_pengiriman`, 
	`penerima`, 
	`jumlah_berat`,
	`no_resi`,
	`id_prov`,
	`id_kota`) VALUES
	    ('$invoice',
	    'Menunggu Pembayaran',
	    '$tanggal',
	    '$jam_order',
	    '$_SESSION[idcs]',
	    '$kurir',
	    '$service',
	    '$ongkir',
	    '$total',
	    '$duahari',
	    '$kdpos', 
	    '$almt',
	    '$nmpenerima',
	    '$berat',
	    '',
		'$id_prov',
		'$id_kota')");

	// simpan data status
	// $status = mysqli_query($con, "INSERT INTO `tbl_status_transaksi`(`id_order`, `status_order`, `tgl_status`) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')");

	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml          = count($isikeranjang);
	// simpan data detail pemesanan
	// var_dump($_SESSION['data_detail_transaksi_tmp']);
	// exit;
	// simpan data detail pemesanan
	// for ($i = 0; $i < $jml; $i++) {
	// 	mysqli_query($con, "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`) VALUES  ('$invoice','{$isikeranjang[$i]['kd_produk']}',{$isikeranjang[$i]['id_customer']},'{$isikeranjang[$i]['size']}',{$isikeranjang[$i]['jumlah_beli']})");
	// }	



	foreach ($_SESSION['data_detail_transaksi_tmp'] as $isikeranjang) {

		mysqli_query($con, "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`, `harga`, `total_harga`) VALUES ('$invoice','{$isikeranjang['kd_produk']}',{$isikeranjang['id_customer']},'{$isikeranjang['size']}',{$isikeranjang['jumlah_beli']}, {$isikeranjang['harga']}, {$isikeranjang['total_harga']})");


		// echo "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`, `harga`, `total_harga`) VALUES ('$invoice','{$isikeranjang['kd_produk']}',{$isikeranjang['id_customer']},'{$isikeranjang['size']}',{$isikeranjang['jumlah_beli']}, {$isikeranjang['harga']}, {$isikeranjang['total_harga']})";
	}
	// exit;
	// Merubah stok di tabel produk
	for ($i = 0; $i < $jml; $i++) {
		$sqlpr = mysqli_query($con, "SELECT * FROM tb_detail_size WHERE kd_produk={$isikeranjang[$i]['kd_produk']}");
		$rpr = mysqli_fetch_array($sqlpr);
		$stok = $rpr["stok"];
		$terjual = $rpr["terjual"];
		$jumlahbeli = "{$isikeranjang[$i]['jumlah_beli']}";
		$stokakhir = $stok - $jumlahbeli;

		mysqli_query($con, "UPDATE tb_detail_size SET stok='$stokakhir' WHERE kd_produk={$isikeranjang[$i]['kd_produk']} AND ukuran = {$isikeranjang[$i]['ukuran']}");
	}

	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (keranjang)
	mysqli_query($con, "DELETE FROM tb_transaksi_tmp WHERE id_customer = '$_SESSION[idcs]'");
	// for ($i = 0; $i < $jml; $i++) {
	// 	mysqli_query($con, "DELETE FROM tb_transaksi_tmp WHERE id_customer = '$_SESSION[idcs]'");
	// }
	// exit;

	$sql = mysqli_query($con, "SELECT * FROM tb_customer,tb_transaksi where tb_customer.id_customer=tb_transaksi.id_customer AND id_transaksi='$invoice' AND
	tb_customer.id_customer='$_SESSION[idcs]'");
	$r = mysqli_fetch_assoc($sql);
	$email = $r['email'];
	$nama = $r['nama_lengkap'];
	$total = number_format($r['total']);
	$tgl = tgl_indo($r['tgl_order']);
	$status = $r['status_order'];

?>

	<script>
		window.location.href = "transaksi-<?= $invoice ?>";
	</script>

<?php
} elseif (isset($_POST['pesan2'])) {
	// 
	$kurir      = $_POST['kurir'];
	$service    = "GJK";
	$nmpenerima = $_POST['namapenerima'];
	$kdpos      = 9999;
	$almt       = $_POST['alamat'];
	$berat      = $_POST['berat'];
	$id_prov      = $_POST['id_prov'];
	$id_kota      = $_POST['id_kota'];
	$ongkir     = 0;
	$total      = $_POST['total'];
	$idcust     = $_SESSION['idcs'];
	$tanggal    = date('Y-m-d');
	$jam_order  = date('H:i:s');
	$tglskrg    = date('Y-m-d H:i:s');
	$duahari    = date('Y-m-d H:i:s', time() + (60 * 60 * 3));
	$dt         = str_replace('-', '', substr($tanggal, 5, 5));
	$dj         = str_replace(':', '', $jam_order);
	$invoice    = $idcust . generateRandomUser(2, 1) . $dt . $dj;


	// simpan data pemesanan
	$transaksi = mysqli_query($con, "INSERT INTO `tb_transaksi`(
	`id_transaksi`, 
	`status_order`, 
	`tgl_order`, 
	`jam_order`, 
	`id_customer`, 
	`kurir`, 
	`service`, 
	`ongkir`, 
	`total`, 
	`expired`, 
	`kodepos`, 
	`alamat_pengiriman`, 
	`penerima`, 
	`jumlah_berat`,
	`no_resi`,
	`id_prov`,
	`id_kota`) VALUES
	    ('$invoice',
	    'Menunggu Pembayaran',
	    '$tanggal',
	    '$jam_order',
	    '$_SESSION[idcs]',
	    '$kurir',
	    '$service',
	    '$ongkir',
	    '$total',
	    '$duahari',
	    '$kdpos', 
	    '$almt',
	    '$nmpenerima',
	    '$berat',
	    '',
		'$id_prov',
		'$id_kota')");

	// simpan data status
	// $status = mysqli_query($con, "INSERT INTO `tbl_status_transaksi`(`id_order`, `status_order`, `tgl_status`) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')");

	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml          = count($isikeranjang);
	// simpan data detail pemesanan
	// for ($i = 0; $i < $jml; $i++) {
	// echo "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`, `total_harga`) VALUES  ('$invoice','{$isikeranjang[$i]['kd_produk']}',{$isikeranjang[$i]['id_customer']},'{$isikeranjang[$i]['size']}',{$isikeranjang[$i]['jumlah_beli']})";
	// mysqli_query($con, "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`) VALUES  ('$invoice',{$isikeranjang[$i]['kd_produk']},{$isikeranjang[$i]['id_customer']},{$isikeranjang[$i]['size']},{$isikeranjang[$i]['jumlah_beli']})");
	// }
	foreach ($_SESSION['data_detail_transaksi_tmp'] as $isikeranjang) {
		mysqli_query($con, "INSERT INTO `tb_transaksi_detail`(`id_transaksi`, `kd_produk`, `id_customer`, `size`, `jumlah_beli`, `harga`, `total_harga`) VALUES  ('$invoice','{$isikeranjang['kd_produk']}',{$isikeranjang['id_customer']},'{$isikeranjang['size']}',{$isikeranjang['jumlah_beli']}, {$isikeranjang['harga']}, {$isikeranjang['total_harga']})");
	}

	// Merubah stok di tabel produk
	for ($i = 0; $i < $jml; $i++) {
		$sqlpr = mysqli_query($con, "SELECT * FROM tb_detail_size WHERE kd_produk={$isikeranjang[$i]['kd_produk']}");
		$rpr = mysqli_fetch_array($sqlpr);
		$stok = $rpr["stok"];
		$terjual = $rpr["terjual"];
		$jumlahbeli = "{$isikeranjang[$i]['jumlah_beli']}";
		$stokakhir = $stok - $jumlahbeli;

		mysqli_query($con, "UPDATE tb_detail_size SET stok='$stokakhir' WHERE kd_produk={$isikeranjang[$i]['kd_produk']} AND ukuran = {$isikeranjang[$i]['ukuran']}");
	}

	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (keranjang)
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($con, "DELETE FROM tb_transaksi_tmp WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");
	}

	$sql = mysqli_query($con, "SELECT * FROM tb_customer,tb_transaksi where tb_customer.id_customer=tbl_orders.id_customer AND id_transaksi='$invoice' AND
	tb_customer.id_customer='$_SESSION[idcs]'");
	$r = mysqli_fetch_assoc($sql);
	$email = $r['email'];
	$nama = $r['nama_lengkap'];
	$total = number_format($r['total']);
	$tgl = tgl_indo($r['tgl_order']);
	$status = $r['status_order'];

?>

	<script>
		window.location.href = "transaksi-<?= $invoice ?>";
	</script>

<?php
} else {
?>
	<script>
		window.location = "index.php";
	</script>

<?php
}

?>