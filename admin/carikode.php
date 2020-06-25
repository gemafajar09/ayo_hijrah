<?php
include "../config/koneksi.php";

$kode = $_POST['kd'];
$data = mysqli_query($con,"SELECT * FROM tb_produk WHERE kd_produk LIKE '%$kode%'");
foreach($data as $a){ ?>
<span class="form-control" onclick="pilihKode('<?= $a['kd_produk'] ?>')"><?= $a['kd_produk'] ?></span>
<?php } ?>