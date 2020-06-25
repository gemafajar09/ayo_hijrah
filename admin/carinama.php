<?php
include "../config/koneksi.php";

$nama = $_POST['nama'];
$data = mysqli_query($con,"SELECT * FROM `pelanggan_offline` WHERE nama_pelanggan LIKE '%$nama%'");
foreach($data as $a){ ?>
<span class="form-control" onclick="pilihpelanggan('<?= $a['nama_pelanggan'] ?>')"><?= $a['nama_pelanggan'] ?></span>
<?php } ?>