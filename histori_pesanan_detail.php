<?php

$id = $_GET['id_transaksi'];
// echo $id;

?>
<div class="page-title">
	<div class="container">
		<div class="column">
			<h1>History Detail Pesanan</h1>
		</div>
		<div class="column">
			<ul class="breadcrumbs">
				<li><a href="index.html">Home</a>
				</li>
				<li class="separator">&nbsp;</li>
				<li>History Detail Pesanan</li>
			</ul>
		</div>
	</div>
</div>
<section class="container" style="padding-bottom:20px;">
	<h3 class="text-center mb-30">History Pesanan</h3>
	<div class="row">

		<div class="col-xs-12 table-responsive">
			<div class="cart_container" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
				<table class="table table-striped table-bordered">

					<thead>

						<tr class="bg-dark">

							<th style="color: white;">No</th>

							<th style="color: white;">Foto</th>

							<th style="color: white;">Judul</th>
							<th style="color: white;">Ukuran</th>
							<th style="color: white;">Jumlah</th>

							<th style="color: white;">Harga</th>

							<th style="color: white;">Total</th>

						</tr>

					</thead>



					<tbody>

						<?php

						// $query = mysqli_query($con, "SELECT o.*, d.*, p.* FROM tbl_orders o LEFT JOIN tbl_orders_detail d ON o.id_order=d.id_order LEFT JOIN tbl_produk p ON d.id_produk=p.id_produk WHERE  o.id_order='$_GET[id_order]'");

						// $query = mysqli_query($con, "SELECT * FROM tb_transaksi, tb_transaksi_detail, tb_produk 
						//                   WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi 
						//                   AND tb_transaksi_detail.kd_produk = tb_produk.kd_produk
						//                   AND tb_transaksi.id_transaksi = '$_GET[id_transaksi]'");

						$query = mysqli_query($con, "SELECT tb_transaksi_detail.id_transaksi, tb_produk.judul, tb_produk.foto, tb_transaksi_detail.jumlah_beli,tb_transaksi_detail.size, tb_transaksi_detail.harga, tb_transaksi_detail.total_harga, tb_transaksi.total, tb_transaksi.ongkir FROM tb_transaksi_detail JOIN tb_produk ON tb_transaksi_detail.kd_produk = tb_produk.kd_produk JOIN tb_transaksi ON tb_transaksi_detail.id_transaksi = tb_transaksi.id_transaksi WHERE tb_transaksi_detail.id_transaksi = '$_GET[id_transaksi]'");

						$no = 0;

						while ($data = mysqli_fetch_assoc($query)) {

							$no++;
							$totalsemua =  $data['total'];
							$ongkir =  $data['ongkir'];
							$total = $data['harga'] * $data['jumlah_beli'];

							$subtot += $total;

						?>

							<tr>

								<td><?= $no; ?></td>

								<td><img src="img/produk/<?= $data['foto'] ?>" style="width: 90px; height: 90px;"></td>

								<td><?= $data['judul'] ?></td>

								<td><?= $data['size'] ?></td>
								<td><?= $data['jumlah_beli'] ?></td>

								<td><?= "Rp. " . number_format($data['harga']) ?></td>

								<td><?= "Rp. " . number_format($total) ?></td>

							</tr>

						<?php } ?>
						<tr class="bg-dark">
							<th colspan="6" class="text-right" style="color: white;">Harga Barang</th>
							<th style="color: white;"><?php echo "Rp." . number_format($total); ?></th>
						</tr>
						<tr class="bg-dark">
							<th colspan="6" class="text-right" style="color: white;">Ongkir</th>
							<th style="color: white;"><?php echo "Rp." . number_format($ongkir); ?></th>
						</tr>
						<tr class="bg-dark">
							<th colspan="6" class="text-right" style="color: white;">Total Harga</th>
							<th style="color: white;"><?php echo "Rp." . number_format($totalsemua); ?></th>
						</tr>

					</tbody>

				</table>

				<hr>
			</div>

		</div>

		<!-- /.col -->

	</div>
</section>