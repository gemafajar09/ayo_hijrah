<?php
include "../config/koneksi.php";

$kode = $_POST['barang'];
$data = mysqli_query($con,"SELECT * FROM tb_produk WHERE judul LIKE '%$kode%'");
foreach($data as $a){ ?>
<span class="form-control" onclick="pilihbarang('<?= $a['kd_produk'] ?>')"><?= $a['judul'] ?></span>
<?php } ?>