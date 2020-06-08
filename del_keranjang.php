<?php 
 mysqli_query($con, "DELETE FROM tbl_keranjang where id_keranjang='$_GET[id_keranjang]'");
echo "<script>window.location='keranjang';</script>"; 
	?>