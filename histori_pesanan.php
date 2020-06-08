<div class="page-title">
        <div class="container">
          <div class="column">
            <h1>History</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>History</li>
            </ul>
          </div>
        </div>
</div>
<section class="container" style="padding-bottom:20px;">
        <h3 class="text-center mb-30">History Pesanan</h3>
        <div class="row">
			<div class="col-lg-12">
				<h3>Detail Pemesanan</h3>
					<div class="cart_container" style="border: 1px solid #ccc; border-radius: 5px; padding: 25px;">
						<div class="table table-responsive">
						<table class="table table-bordered">
							<tr class="bg-primary">
								<th class="text-center putih">No</th>
								<th class="text-center putih">Tanggal Order</th>
								<th class="text-center putih">Customer</th>
								<th class="text-center putih">Total Bayar</th>
								<th class="text-center putih">Status</th>
								<th class="text-center putih">Konfirmasi Pembayaran</th>
							</tr>
							<?php
								$sql = mysqli_query($con, "SELECT * FROM tbl_customer,tbl_orders
								WHERE tbl_customer.id_customer=tbl_orders.id_customer
								And tbl_orders.id_customer='$_SESSION[idcs]'");

								$cek = mysqli_num_rows($sql);
								if($cek == 0){ ?>
							<tr>
								<td colspan=7>Keranjang Belanja Anda Masih Kosong</td>
							</tr>
							<?php
								}else{
								$no=0;
								while($r=mysqli_fetch_assoc($sql)){
								$no++;
								$harga = "Rp. ".number_format($r['harga']);
								$total = "Rp. ".number_format($r['harga'] * $r['jml']);
								$sub = $r['harga'] * $r['jml'];
								@$subtot += $sub;
								$totalakhir = $subtot;
								$berat = $r['berat'] * $r['jml'];
								@$subberat += $berat;
															
							?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?= $r['tgl_order']?></td>
								<td class="text-center"><?= $r['nama_lengkap']?></td>
								<td class="text-center">Rp. <?= number_format($r['total'],2,',','.'); ?></td>
								<td class="text-center"><?= $r['status_ord'] ?></td>
								<?php if($r["status_ord"]=="Menunggu Pembayaran") {
								  echo "<td class='text-center'><a href='konfirmasi-$r[id_order]' class='btn-info' style='border:1px solid #87c7fd; border-radius:5px; padding:3px 5px;'>Konfirmasi Pembayaran</a></td>";
								 }else {
									 echo "<td class='text-center'><img src='foto/ceklis.png' style='width:30px'><br> No Resi :  $r[no_res] </td>";
								} ?>
								
							</tr>
							<?php } } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
</section>