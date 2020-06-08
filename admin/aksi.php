<?php
	include "../config/koneksi.php";

	$username = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
	$password = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim(md5($_POST['password']))))));

		$sql = mysqli_query($con, "SELECT * FROM tbl_admin where username='$username' and password='$password'");
		$r = mysqli_fetch_array($sql);
		$row = mysqli_num_rows($sql);
		if ($row > 0){
			session_start();
			$_SESSION['useradmn']= $r["username"];
			$_SESSION['passadmn']= $r["password"];
			$_SESSION['namaadmn']= $r["nama_admin"];
			$_SESSION['level']	= $r["level"];

			echo"<script>
					window.alert('Anda Berhasil Login.!');
					window.location='index.php?page=home';
				</script>";
		} else {
			echo"<script>
					window.alert('Anda Belum Beruntung untuk Login. Silahkan Anda coba Kembali');
					window.location='index.php';
				</script>";
		}
?>
