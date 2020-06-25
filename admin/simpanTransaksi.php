<?php
include "../config/koneksi.php";

$nota = $_POST['nota'];
$tanggal = $_POST['tanggal'];
$pelanggan = $_POST['pelanggan'];
$total_belanja = $_POST['total_belanja'];

$simpan = mysqli_query($con,"INSERT INTO `tb_transoff`(`nota`, `nama_pelanggan`, `tanggal_belanja`, `total_belanja`) VALUES ('$nota','$pelanggan','$tanggal','$total_belanja')");

	$cek = mysqli_query($con,"SELECT * FROM `tb_transoff_tmp` WHERE pelanggan = '$pelanggan'");
	$array = array();
	foreach($cek as $a)
	{
		$array[] = $a;
	}

$hitung = count($array);

for($i = 0; $i < $hitung; $i++)
{
	$update_stok = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_detail_size WHERE kd_produk = '{$array[$i]['kd_produk']}' AND ukuran = '{$array[$i]['size']}'"));

	$cekupdate = mysqli_query($con,"UPDATE tb_detail_size SET stok= stok - '{$array[$i]['jumlah']}', terjual = terjual + '{$array[$i]['jumlah']}' WHERE kd_produk='{$array[$i]['kd_produk']}' AND ukuran = '{$array[$i]['size']}'");
	mysqli_query($con,"INSERT INTO `tb_transoff_detail`(`nota`, `kd_produk`, `size`, `jumlah`, `total`) VALUES ('$nota','{$array[$i]['kd_produk']}','{$array[$i]['size']}','{$array[$i]['jumlah']}','{$array[$i]['total']}')");

}
echo json_encode($cekupdate);