<?php
session_start();
if (@$_SESSION['idcs'] == '') {
	echo "<script>window.location='login';</script>";
}
include "config/koneksi.php";
include "config/fungsi_id.php";

if (isset($_POST['pesan'])) {
	$kurir      = $_POST['kurir'];
	$service    = $_POST['service'];
	$nmpenerima = $_POST['namapenerima'];
	$idprov     = $_POST['id_prov'];
	$idkota     = $_POST['id_kota'];
	$kdpos      = $_POST['kodepos'];
	$almt       = $_POST['alamat'];
	$berat      = $_POST['berat'];
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

	// fungsi untuk mendapatkan isi keranjang belanja
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

	// $transaksi = "INSERT INTO tbl_orders(id_order,status_ord,tgl_order,jam_order,id_customer,kurir,service,ongkir,total,expired,id_prov,id_kota,kodepos,alamat_o,nmpenerima,jmlberat) VALUES ('$invoice','Menunggu Pembayaran','$tanggal','$jam_order','$_SESSION[idcs]','$kurir','$service','$ongkir','$total','$duahari','$idprov','$idkota','$kdpos', '$almt','$nmpenerima','$berat')";
	// echo $transaksi;
	// exit;
	// simpan data pemesanan

	$transaksi = mysqli_query($con, "INSERT INTO `tbl_orders`(
	`id_order`, 
	`status_ord`, 
	`tgl_order`, 
	`jam_order`, 
	`id_customer`, 
	`kurir`, 
	`service`, 
	`ongkir`, 
	`total`, 
	`expired`, 
	`id_prov`, 
	`id_kota`, 
	`kodepos`, 
	`alamat_o`, 
	`nmpenerima`, 
	`jmlberat`,
	`no_res`) VALUES
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
	    '$idprov',
	    '$idkota',
	    '$kdpos', 
	    '$almt',
	    '$nmpenerima',
	    '$berat',
	    '')");


	// $status = "INSERT INTO tbl_status_orders(id_order,status_order,tgl_status) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')";
	// echo $status;
	// exit;

	// simpan data status
	$status = mysqli_query($con, "INSERT INTO `tbl_status_orders`(`id_order`, `status_order`, `tgl_status`) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')");


	// // mendapatkan nomor orders
	// $id_trans=mysqli_insert_id();

	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml          = count($isikeranjang);
	// simpan data detail pemesanan
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($con, "INSERT INTO `tbl_orders_detail`(`id_order`, `id_produk`, `jml`) VALUES  ('$invoice',{$isikeranjang[$i]['id_produk']},{$isikeranjang[$i]['jml']})");
	}

	// Merubah stok di tabel produk
	for ($i = 0; $i < $jml; $i++) {
		$sqlpr = mysqli_query($con, "SELECT * FROM tbl_produk WHERE id_produk={$isikeranjang[$i]['id_produk']}");
		$rpr = mysqli_fetch_array($sqlpr);
		$stok = $rpr["stok"];
		$terjual = $rpr["terjual"];
		$jumlahbeli = "{$isikeranjang[$i]['jml']}";
		$stokakhir = $stok - $jumlahbeli;

		mysqli_query($con, "UPDATE tbl_produk SET stok='$stokakhir' WHERE id_produk={$isikeranjang[$i]['id_produk']}");
	}

	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (keranjang)
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($con, "DELETE FROM tbl_keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");
	}

	$sql = mysqli_query($con, "SELECT * FROM tbl_customer,tbl_orders where tbl_customer.id_customer=tbl_orders.id_customer AND id_order='$invoice' AND
	tbl_customer.id_customer='$_SESSION[idcs]'");
	$r = mysqli_fetch_assoc($sql);
	$email = $r['email'];
	$nama = $r['nama_lengkap'];
	$total = number_format($r['total']);
	$tgl = tgl_indo($r['tgl_order']);
	$status = $r['status_ord'];

	// require 'PHPMailerAutoload.php';
	// require 'credential.php';


	// $mail = new PHPMailer(true);
	// $mail->SMTPOptions = array(
	// 	'ssl' => array(
	// 		'verify_peer' => false,
	// 		'verify_peer_name' => false,
	// 		'allow_self_signed' => true
	// 	)
	// );
	// try {
	// 	//Server settings
	// 	//$mail->SMTPDebug = 4;                                 
	// 	$mail->isSMTP();
	// 	$mail->Host = 'smtp.gmail.com';
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = EMAIL;
	// 	$mail->Password = PASS;
	// 	$mail->SMTPSecure = 'tls';
	// 	$mail->SMTPAuth = true;
	// 	$mail->Port = 587;
	// 	//Recipients
	// 	$mail->setFrom(EMAIL, 'Sumbar Smartphone');
	// 	$mail->addAddress($email);     // Add a recipient    // Add a recipient
	// 	$mail->addAddress('sumbarsmartphone@gmail.com');     // Add a recipient    // Add a recipient

	// 	$mail->addReplyTo(EMAIL);
	// 	#DBDBDB
	// 	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	// 	//Content
	// 	$mail->isHTML(true);                                  // Set email format to HTML
	// 	$mail->Subject = 'Sumbar Smartphone informasi pembelian';
	// 	$mail->Body    = "<body style='background-color: #EBEBEB;' align='center'><div Style='background-color: #f5f2f2; padding: 20px; font-color:#fe7676; width:500px; font-weight:bold;  font-size: 25px; text-align:center;'>Sumbarsmartphone</div>
	// 	  <div style= 'background-color: #fff; width:500px; padding: 20px; font-size: 15px;' align='left'>Dear.. $nama <p>Pesanan Produk Anda Telah Kami Terima dengan no order <font color='#fb9143'>#$invoice</font> pada tanggal <font color='#fb9143'> $tgl</font> . Silahkan transfer biaya pembelian produk sesuai yang tertera di <b>Total Pembayaran</b><font color='#fb9143'> Rp. $total</font></p><p>Status Pembelian : <b>$status</b> Segera Lakukan Pembayaran.</p><p>Terima Kasih Atas Perhatian dan Kerjasama Anda</p><p>Salam,<br></p></div></body>";
	// 	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// 	$mail->send();
	// } catch (Exception $e) {
	// 	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	// }


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
	$idprov     = 999;
	$idkota     = 999;
	$kdpos      = 9999;
	$almt       = $_POST['alamat'];
	$berat      = $_POST['berat'];
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

	// fungsi untuk mendapatkan isi keranjang belanja
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

	// $transaksi = "INSERT INTO tbl_orders(id_order,status_ord,tgl_order,jam_order,id_customer,kurir,service,ongkir,total,expired,id_prov,id_kota,kodepos,alamat_o,nmpenerima,jmlberat) VALUES ('$invoice','Menunggu Pembayaran','$tanggal','$jam_order','$_SESSION[idcs]','$kurir','$service','$ongkir','$total','$duahari','$idprov','$idkota','$kdpos', '$almt','$nmpenerima','$berat')";
	// echo $transaksi;
	// exit;
	// simpan data pemesanan
	$transaksi = mysqli_query($con, "INSERT INTO `tbl_orders`(
	`id_order`, 
	`status_ord`, 
	`tgl_order`, 
	`jam_order`, 
	`id_customer`, 
	`kurir`, 
	`service`, 
	`ongkir`, 
	`total`, 
	`expired`, 
	`id_prov`, 
	`id_kota`, 
	`kodepos`, 
	`alamat_o`, 
	`nmpenerima`, 
	`jmlberat`,
	`no_res`) VALUES
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
	    '$idprov',
	    '$idkota',
	    '$kdpos', 
	    '$almt',
	    '$nmpenerima',
	    '$berat',
	    '')");


	// $status = "INSERT INTO tbl_status_orders(id_order,status_order,tgl_status) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')";
	// echo $status;
	// exit;

	// simpan data status
	$status = mysqli_query($con, "INSERT INTO `tbl_status_orders`(`id_order`, `status_order`, `tgl_status`) VALUES ('$invoice','Menunggu Pembayaran','$tglskrg')");


	// // mendapatkan nomor orders
	// $id_trans=mysqli_insert_id();

	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml          = count($isikeranjang);
	// simpan data detail pemesanan
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($con, "INSERT INTO `tbl_orders_detail`(`id_order`, `id_produk`, `jml`) VALUES ('$invoice',{$isikeranjang[$i]['id_produk']},{$isikeranjang[$i]['jml']})");
	}

	// Merubah stok di tabel produk
	for ($i = 0; $i < $jml; $i++) {
		$sqlpr = mysqli_query($con, "SELECT * FROM tbl_produk WHERE id_produk={$isikeranjang[$i]['id_produk']}");
		$rpr = mysqli_fetch_array($sqlpr);
		$stok = $rpr["stok"];
		$terjual = $rpr["terjual"];
		$jumlahbeli = "{$isikeranjang[$i]['jml']}";
		$stokakhir = $stok - $jumlahbeli;

		mysqli_query($con, "UPDATE tbl_produk SET stok='$stokakhir' WHERE id_produk={$isikeranjang[$i]['id_produk']}");
	}

	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (keranjang)
	for ($i = 0; $i < $jml; $i++) {
		mysqli_query($con, "DELETE FROM tbl_keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");
	}

	$sql = mysqli_query($con, "SELECT * FROM tbl_customer,tbl_orders where tbl_customer.id_customer=tbl_orders.id_customer AND id_order='$invoice' AND
	tbl_customer.id_customer='$_SESSION[idcs]'");
	$r = mysqli_fetch_assoc($sql);
	$email = $r['email'];
	$nama = $r['nama_lengkap'];
	$total = number_format($r['total']);
	$tgl = tgl_indo($r['tgl_order']);
	$status = $r['status_ord'];

	// require 'PHPMailerAutoload.php';
	// require 'credential.php';


	// $mail = new PHPMailer(true);
	// $mail->SMTPOptions = array(
	// 	'ssl' => array(
	// 		'verify_peer' => false,
	// 		'verify_peer_name' => false,
	// 		'allow_self_signed' => true
	// 	)
	// );
	// try {
	// 	//Server settings
	// 	//$mail->SMTPDebug = 4;                                 
	// 	$mail->isSMTP();
	// 	$mail->Host = 'smtp.gmail.com';
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = EMAIL;
	// 	$mail->Password = PASS;
	// 	$mail->SMTPSecure = 'tls';
	// 	$mail->SMTPAuth = true;
	// 	$mail->Port = 587;
	// 	//Recipients
	// 	$mail->setFrom(EMAIL, 'Sumbar Smartphone');
	// 	$mail->addAddress($email);     // Add a recipient    // Add a recipient
	// 	$mail->addAddress('sumbarsmartphone@gmail.com');     // Add a recipient    // Add a recipient

	// 	$mail->addReplyTo(EMAIL);
	// 	#DBDBDB
	// 	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	// 	//Content
	// 	$mail->isHTML(true);                                  // Set email format to HTML
	// 	$mail->Subject = 'Sumbar Smartphone informasi pembelian';
	// 	$mail->Body    = "<body style='background-color: #EBEBEB;' align='center'><div Style='background-color: #f5f2f2; padding: 20px; font-color:#fe7676; width:500px; font-weight:bold;  font-size: 25px; text-align:center;'>Sumbarsmartphone</div>
	// 	  <div style= 'background-color: #fff; width:500px; padding: 20px; font-size: 15px;' align='left'>Dear.. $nama <p>Pesanan Produk Anda Telah Kami Terima dengan no order <font color='#fb9143'>#$invoice</font> pada tanggal <font color='#fb9143'> $tgl</font> . Silahkan transfer biaya pembelian produk sesuai yang tertera di <b>Total Pembayaran</b><font color='#fb9143'> Rp. $total</font></p><p>Status Pembelian : <b>$status</b> Segera Lakukan Pembayaran.</p><p>Terima Kasih Atas Perhatian dan Kerjasama Anda</p><p>Salam,<br></p></div></body>";
	// 	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// 	$mail->send();
	// } catch (Exception $e) {
	// 	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	// }
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