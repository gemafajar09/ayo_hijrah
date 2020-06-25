<?php
include "../config/koneksi.php";

$kode = $_POST['kd'];
$size = $_POST['size'];

$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT a.stok, b.harga_eceran FROM tb_detail_size a JOIN tb_produk b WHERE a.kd_produk='$kode' AND a.ukuran='$size' AND b.kd_produk='$kode'"));

echo json_encode($data);