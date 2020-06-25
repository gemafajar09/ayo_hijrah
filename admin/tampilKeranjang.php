<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:2px">No</th>
			<th style="width:140px">Kode Produk</th>
			<th style="width:140px">Nama Produk</th>
			<th style="width:20px">Size</th>
			<th style="width:20px">Jumlah</th>
			<th style="width:30px">Total</th>
			<th style="width:80px">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include "../config/koneksi.php";

		$data = mysqli_query($con,"SELECT * FROM tb_transoff_tmp a JOIN tb_produk b WHERE a.kd_produk=b.kd_produk");
		$hasil = 0;
		foreach($data as $i => $a){ 
		$hasil += $a['total'];
		?>
		<tr>
			<td><?= $i+1 ?></td>
			<td><?= $a['kd_produk'] ?></td>
			<td><?= $a['judul'] ?></td>
			<td><?= $a['size'] ?></td>
			<td><?= $a['jumlah'] ?></td>
			<td><?= $a['total'] ?></td>
			<td>
				<button type="button" class="btn btn-danger" onclick="hapusBarang('<?= $a['id_off'] ?>')"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script>
	$('#total_belanja').val(<?=$hasil?>)
</script>