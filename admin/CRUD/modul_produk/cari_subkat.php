<?php
include"../../../config/koneksi.php";

$kategori = $_GET['id_kategori'];
$kota = mysqli_query($con,"SELECT id_subkat,nama_subkat FROM tbl_subkat WHERE id_kategori='$kategori' order by nama_subkat");
echo "<option>-- Pilih Sub Kategori --</option>";
while($k = mysqli_fetch_array($kota)){
    echo "<option value=\"".$k['id_subkat']."\">".$k['nama_subkat']."</option>\n";
}
?>
