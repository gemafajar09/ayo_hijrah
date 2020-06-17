<?php 
	mysqli_query($con, "UPDATE tb_transaksi_tmp set jumlah_beli='$_POST[jml]' where id_keranjang='$_GET[id_keranjang]'");
	echo "<META HTTP-EQUIV='Refresh' Content='0; URL=keranjang'>";
 ?>