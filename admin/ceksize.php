<?php
include "../config/koneksi.php";

$kd = $_POST['kd'];

$data = mysqli_query($con,"SELECT * FROM tb_detail_size WHERE kd_produk='$kd' AND stok != 0");
foreach($data as $a){ ?>
	<input type="radio" name="ukuran" class="ukuran" onclick="cekStok('<?= $a['ukuran'] ?>')" value="<?= $a['ukuran'] ?>"><label><?= $a['ukuran'] ?></label>&nbsp;&nbsp;
<?php } ?>