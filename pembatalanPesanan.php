<?php
date_default_timezone_set('Asia/Jakarta');
include_once "config/koneksi.php";
// $status = mysqli_real_escape_string($con, $_POST['status']);
$tanggal = date("Y-m-d H:i:s");
$data = $con->query("SELECT a.*, b.jml, b.id_produk FROM tbl_orders a JOIN tbl_orders_detail b ON a.id_order=b.id_order WHERE a.status_ord='Menunggu Pembayaran' AND NOW() > a.expired");
foreach ($data as $a) {
    $con->query("UPDATE tbl_produk SET stok = stok + " . $a['jml'] . " WHERE id_produk='$a[id_produk]' ");
    $con->query("UPDATE tbl_orders SET status_ord='Dibatalkan' WHERE id_order='$a[id_order]' ");
    $con->query("DELETE FROM tbl_orders_detail WHERE id_order='$a[id_order]' ");
}
