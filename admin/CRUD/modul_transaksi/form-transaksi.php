<section class="content-header">
	<h1>
	  Transaksi Ofline
	</h1>
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Transaksi</li>
	</ol>
</section>
<!-- Content Header (Page header) -->
<section class="content">
	<div class="row">
  		<div class="col-xs-12">
    		<div class="box box-info">
    			<div class="container card">
    				<div class="card-body">
		    			<form action="" method="POST">
		    				<div class="row">
		    					<div class="col-md-4">
		    						<table class="table">
		    							<tr>
		    								<th>
		    									<label>No Faktur</label>
		    								</th>
		    								<th>
		    									<input type="text" name="faktur" class="form-control" value="<?= date('Ymd') ?>">
		    								</th>
		    							</tr>
		    							<tr>
		    								<th>
		    									<label>Tanggal</label>
		    								</th>
		    								<th>
		    									<input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
		    								</th>
		    							</tr>
		    							<tr>
		    								<th>
		    									<label>Nama Pelanggan</label>
		    								</th>
		    								<th>
		    									<input type="text" name="pelanggan" class="form-control">
		    								</th>
		    							</tr>
		    						</table>
		    					</div>
	    						<div class="col-md-12 table-responsive">
	    							<table class="table">
	    								<thead>
	    									<tr>
	    										<th width="180px">Kode Produk</th>
	    										<th width="180px">Nama Produk</th>
	    										<th width="180px">Size</th>
	    										<th width="80px">Stok</th>
	    										<th width="80px">Jumlah Beli</th>
	    										<th width="110px">Harga</th>
	    										<th width="110px">Total</th>
	    										<th>Action</th>
	    									</tr>
	    								</thead>
	    								<tbody>
	    									<tr>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											
	    										</td>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											<input type="text" id="kd_produk" class="form-control" name="kd_produk">
	    										</td>
	    										<td>
	    											<button class="btn btn-primary  btn-sm" style="width:60px">simpan</button>
	    											<button class="btn btn-warning btn-sm" style="width:60px">batal</button>
	    										</td>
	    									</tr>
	    								</tbody>
	    							</table>
	    						</div>
	    						<br>
	    						<div class="col-md-12">
	    							<h4>Keranjang</h4>
	    							<hr>
	    							<table class="table">
	    								<thead>
	    									<tr>
	    										<th>No</th>
	    										<th>Kode Produk</th>
	    										<th>Nama Produk</th>
	    										<th>Size</th>
	    										<th>Jumlah</th>
	    										<th>Harga</th>
	    										<th>Total</th>
	    									</tr>
	    								</thead>
	    								<tbody>
	    									<tr>
	    										<td></td>
	    										<td></td>
	    										<td></td>
	    										<td></td>
	    										<td></td>
	    										<td></td>
	    										<td></td>
	    									</tr>
	    								</tbody>
	    							</table>
	    						</div>
		    				</div>
		    			</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>
