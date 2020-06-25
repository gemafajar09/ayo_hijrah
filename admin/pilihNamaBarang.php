<?php
include "../config/koneksi.php";

$kd = $_POST['kd'];
$data = mysqli_query($con,"SELECT * FROM tb_produk WHERE kd_produk = '$kd'")->fetch_assoc();
echo json_encode($data);