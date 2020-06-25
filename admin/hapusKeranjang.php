<?php
include "../config/koneksi.php";

$id = $_POST['id'];

$data = mysqli_query($con,"DELETE FROM tb_transoff_tmp WHERE id_off = '$id'");
if($data == TRUE)
{
	echo json_encode('success');
}else{
	echo json_encode('error');
}