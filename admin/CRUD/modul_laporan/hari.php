<?php
$conn = mysqli_connect('localhost', 'root', '', 'ayo_hijrah');
$hari = $_POST['hari'];
// $bln = explode('-', $bulan);
include_once("../../confiq/fungsi_indotgl.php")

?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cetak Laporan Perhari</title>
    <style>
        html,
        body {
            background: #eee;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }


        .container {
            width: 1200px;
            margin: 25px auto;
            /* padding-left: 100px; */
        }

        /*design table 1*/
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;

            border: 1px solid #999;
            padding: 8px 20px;
        }

        .contoh-link:hover {
            background: #16A085;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div>
                <center>
                    <h1>AYO HIJRAH</h1>
                    <h5>Alamat : Jl. Batang Antokan No.8, Rimbo Kaluang, Kec. Padang Bar.,
                        <br>Kota Padang, Sumatera Barat 25114<br> No Tlp. :0821-7006-5191</h5>
                    <hr <hr style="display: block; height: 1px;border: 0; border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                </center>
            </div>
        </div>
        <br>
        <h3 align="center"><u>Laporan Data Penjualan <?php echo tgl_indo($hari)  ?></u></h3>
        <br>
        <div class="row">
            <div>
                <div>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penerima</th>
                                <th>Tanggal Pesan</th>
                                <th>Tujuan Pengiriman</th>
                                <th>Total Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $hari = $_POST['hari'];
                            $total = 0;
                            $ambil = $conn->query("SELECT * FROM tb_transaksi WHERE status_order = 'Proses Pengiriman' AND tgl_order LIKE '$hari%' ");
                            while ($pecah = $ambil->fetch_object()) {
                                // var_dump($pecah);
                                $total += $pecah->total;
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?= $pecah->penerima ?></td>
                                    <td><?= tgl_indo("$pecah->tgl_order") ?></td>
                                    <td width="500"><?= $pecah->alamat_pengiriman ?></td>
                                    <td>Rp. <?= number_format($pecah->total);  ?></td>
                                </tr>
                            <?php } ?>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td>Rp. <?= number_format($total); ?> </td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        window.print();
    </script> -->
</body>

</html>