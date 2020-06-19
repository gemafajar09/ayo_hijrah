<div class="page-title">
	<div class="container">
		<div class="column">
			<h1>Daftar Rekening</h1>
		</div>
		<div class="column">
			<ul class="breadcrumbs">
				<li><a href="index.php">Home</a>
				</li>
				<li class="separator">&nbsp;</li>
				<li>Daftar Rekening</li>
			</ul>
		</div>
	</div>
</div>
<section class="container" style="padding-bottom:20px;">
	<div class="row">
		<div class="col-lg-12">
			<h3>Daftar Rekening</h3>
			<div class="cart_container" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th class="text-center putih">No</th>
							<th class="text-center putih">Nama Bank</th>
							<th class="text-center putih">No Rekening</th>
							<th class="text-center putih">Atas Nama</th>
						</tr>
						<?php
						$sql = mysqli_query($con, "SELECT * FROM tb_bank, tb_bank_detail WHERE tb_bank.id_bank = tb_bank_detail.id_bank");
						$no = 1;
						while ($r = mysqli_fetch_assoc($sql)) {

						?>
							<tr>
								<td class="text-center"><?= $no; ?></td>
								<td class="text-center"><?= $r['nama_bank'] ?></td>
								<td class="text-center"><?= $r['no_rek'] ?></td>
								<td class="text-center"><?= $r['atas_nama'] ?></td>
							</tr>
						<?php $no++;
						}  ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>