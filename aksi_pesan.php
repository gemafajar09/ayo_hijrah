<?php 

		mysqli_query($con, "INSERT INTO `tbl_keranjang`(`id_produk`, `id_customer`, `jml`) VALUES($_POST[id_produk]', '$_POST[id_customer]','$_POST[jml]')");
		echo"<script>
				window.location='index.php?module=home';
				</script>";
				exit;

?>