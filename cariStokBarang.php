<?php
include "config/koneksi.php";
$ukuran = $_POST['ukuran'];
$kd_produk = $_POST['kd_produk'];
$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT stok FROM tbl_detail_size WHERE kd_produk='$kd_produk' AND ukuran='$ukuran'"));
echo json_encode($data);