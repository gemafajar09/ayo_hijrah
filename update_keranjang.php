<?php 
	mysqli_query($con, "UPDATE tbl_keranjang set jml='$_POST[jml]' where id_keranjang='$_GET[id_keranjang]'");
	echo "<META HTTP-EQUIV='Refresh' Content='0; URL=keranjang'>";
 ?>