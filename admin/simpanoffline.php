<?php
include "../config/koneksi.php";

$kd_produk = $_POST['kd_produk'];
$pelanggan = $_POST['pelanggan'];
$size = $_POST['size'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];

if($pelanggan == NULL)
{
	echo json_encode('error');
}else{
	$cek = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pelanggan_offline WHERE nama_pelanggan='$pelanggan'"));
	if($cek['nama_pelanggan'] == NULL)
	{
		mysqli_query($con,"INSERT INTO `pelanggan_offline`(`nama_pelanggan`) VALUES ('$pelanggan')");
	}
	$data = mysqli_query($con,"INSERT INTO `tb_transoff_tmp`( `kd_produk`, `pelanggan`, `size`, `jumlah`, `total`) VALUES ('$kd_produk','$pelanggan','$size','$jumlah','$total')");

	echo json_encode($data);
}