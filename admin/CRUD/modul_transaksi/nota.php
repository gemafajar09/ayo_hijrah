<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <title>Ayo Hijrah</title>
</head>
<body>
<?php
include "../../../config/koneksi.php";
$nota = $_GET['nota'];
$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_pelanggan, tanggal_belanja, total_belanja FROM `tb_transoff` WHERE nota='$nota'"));

?>
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
            <center><h1>Ayo Hijarah</h1></center>
                <table>
                    <tr>
                        <th>No. Faktur</th>
                        <th>&nbsp;&nbsp;:</th>
                        <th>&nbsp;&nbsp;<?= $_GET['nota'] ?></th>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>&nbsp;&nbsp;:</th>
                        <th>&nbsp;&nbsp;<?= $data['nama_pelanggan'] ?></th>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>&nbsp;&nbsp;:</th>
                        <th>&nbsp;&nbsp;<?= $data['tanggal_belanja'] ?></th>
                    </tr>
                </table>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width:18px">No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $ambil = mysqli_query($con,"SELECT * FROM tb_transoff_detail a LEFT JOIN tb_produk b ON a.kd_produk=b.kd_produk WHERE nota='$nota'");
                    foreach($ambil as $i => $a){
                    ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $a['kd_produk'] ?></td>
                        <td><?= $a['judul'] ?></td>
                        <td><?= $a['size'] ?></td>
                        <td><?= $a['jumlah'] ?></td>
                        <td>Rp.<?= number_format($a['total']) ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>