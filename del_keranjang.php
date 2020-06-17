<?php 
mysqli_query($con, "DELETE FROM tb_transaksi_tmp where id_keranjang='$_GET[id_keranjang]'");
echo "<script>window.location='keranjang';</script>"; 
?>