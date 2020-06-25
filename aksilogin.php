<?php
include "config/koneksi.php";

$email = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['email'])))));
$password = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))));

$sql = mysqli_query($con, "SELECT * FROM tb_customer where email='$email' and password='$password'");
$r = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
if ($row > 0) {
	session_start();
	$_SESSION["idcs"] = $r["id_customer"];
	$_SESSION['email'] = $r["email"];
	$_SESSION['password'] = $r["password"];
	$_SESSION['nama'] = $r["nama_lengkap"];
	$_SESSION['fotoregis'] 	= $r["fotoregis"];
	$_SESSION['nama_toko'] 	= $r["nama_toko"];
	$_SESSION['alamat'] 	= $r["alamat"];
	$_SESSION['jenis_toko'] 	= $r["jenis_toko"];

	echo "<script>
					window.alert('Anda Berhasil Login.!');
					window.location='./';
				</script>";
} else {
	echo "<script>
					window.alert('Email atau Password salah. Silahkan Anda coba Kembali');
					window.location='login';
				</script>";
}
