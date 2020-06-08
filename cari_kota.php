<?php
include "config/koneksi.php";

$provinsi = $_GET['provinsi'];
$kota = mysqli_query($con,"SELECT * FROM tbl_kota WHERE id_prov='$provinsi'");
?>
  <option>Pilih Kota</option>
<?php
  while($k = mysqli_fetch_assoc($kota)){
?>
    <option value=<?= $k['id_kota'] ?>><?= $k['nama_kota'] ?></option>
<?php
}
?>
