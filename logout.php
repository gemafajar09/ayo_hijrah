<?php
	session_start();
	unset($_SESSION['email']);
	session_destroy();
	echo"<script>alert('Anda Berhasil Keluar'); 
						window.location.href='index.php'</script>";
	exit();
?>