<?php
include "../config/koneksi.php";

$nama = $_POST['nama'];
$data = mysqli_query($con,"SELECT * FROM `pelanggan_offline` WHERE nama_pelanggan = '$nama'")->fetch_assoc();
echo json_encode($data);