<?php
mysqli_query($con,"DELETE FROM tb_transoff_tmp");
$sekarang = date('Ym');
$carikode = mysqli_query($con,"select max(nota) from tb_transoff") or die (mysql_error());
$datakode = mysqli_fetch_row($carikode);
if($datakode) {
	$nilaikode = substr($datakode[0], 7);
	$kode = (int) $nilaikode;
	$kode = $kode+1;
	$hasilkode = $sekarang.str_pad($kode, 4 , "0", STR_PAD_LEFT);
} else {
	$hasilkode = $sekarang."0001";
}
?>
<section class="content-header">
	<h1>
	  Transaksi Offline
	</h1>
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Transaksi</li>
	</ol>
</section>
<style>
span.pilihan{display:block;cursor:pointer;}
</style>
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
		    									<input type="text" id="faktur" name="faktur" class="form-control" value="<?= $hasilkode ?>">
		    								</th>
		    							</tr>
		    							<tr>
		    								<th>
		    									<label>Tanggal</label>
		    								</th>
		    								<th>
		    									<input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
		    								</th>
		    							</tr>
		    							<tr>
		    								<th>
		    									<label>Nama Pelanggan</label>
		    								</th>
		    								<th>
		    									<input type="text" onkeyup="caripelanggan(this)" id="pelanggan"required name="pelanggan" class="form-control">
		    									<div id="namapelanggan"></div>
		    								</th>
		    							</tr>
		    						</table>
		    					</div>
		    					<div class="col-md-8">
		    						
		    					</div>
	    						<div class="col-md-12 table-responsive">
	    							<i><b id="pesan"></b></i>
	    							<table class="table">
	    								<thead>
	    									<tr>
	    										<th width="140px">Kode Produk</th>
	    										<th width="140px">Nama Produk</th>
	    										<th width="160px">Size</th>
	    										<th width="80px">Stok</th>
	    										<th width="80px">Jumlah Beli</th>
	    										<th width="170px">Harga</th>
	    										<th width="130px">Total</th>
	    										<th>Action</th>
	    									</tr>
	    								</thead>
	    								<tbody>
	    									<tr>
	    										<td>
	    											<input type="text" onkeyup="kode(this)" id="kd_produk" class="form-control" name="kd_produk">
	    											<div id="tampilKode"></div>
	    										</td>
	    										<td>
	    											<input type="text" onkeyup="barang(this)" id="nama_produk" class="form-control" name="nama_produk">
	    											<div id="tampilBarang"></div>
	    										</td>
	    										<td>
	    											<div id="size"></div>
	    											<input type="hidden" id="ukuran">
	    										</td>
	    										<td>
	    											<input readonly type="text" id="stok" class="form-control" name="stok">
	    										</td>
	    										<td>
	    											<input type="text" onkeyup="toalBayar(this)" id="jumlah" class="form-control" value="" name="jumlah">
	    										</td>
	    										<td>
	    											<div class="row">
	    												<div class="col-md-2">
	    													<label>Rp.</label>
	    												</div>
	    												<div class="col-md-10">
	    													<input  readonly type="text" id="harga" class="form-control" name="harga">
	    												</div>
	    											</div>
	    										</td>
	    										<td>
	    											<input type="text" readonly id="total" class="form-control" name="total">
	    										</td>
	    										<td>
	    											<button type="button" onclick="simpans()" class="btn btn-primary  btn-sm" id="simpan" style="width:60px">simpan</button>
	    											<button class="btn btn-warning btn-sm" style="width:60px">batal</button>
	    										</td>
	    									</tr>
	    								</tbody>
	    							</table>
	    						</div>
	    						<br>
	    						<div class="col-md-3">
	    							<table>
		    							<tr>
		    								<td style="width:100px"><h6 style="color:red">Total Belanja </h6></td>
		    								<td>
		    									<input readonly style="width:200px" type="text" id="total_belanja" value="0" class="form-control">
		    								</td>
		    							</tr>
		    							<tr>
		    								<td><h6 style="color:red">Total Bayar </h6></td>
		    								<td>
		    									<input style="width:200px" onkeyup="kembali(this)" type="text" id="total_bayar" value=""  placeholder="0" class="form-control">
		    								</td>
		    							</tr>
		    							<tr>
		    								<td><h6 style="color:red">Kembalian </h6></td>
		    								<td>
		    									<input readonly style="width:200px" type="text" id="kembalian" value=""  placeholder="0" class="form-control">
		    								</td>
		    							</tr>
		    						</table>
		    						<br>
		    						<div align="right">
		    							<button type="button" onclick="simpanTransaksi()" name="rekap" id="rekap" class="btn btn-primary">Check Out</button>
		    						</div>
		    						<br>
	    						</div>
	    						<div class="col-md-8">
	    							<h4>Keranjang</h4>
	    							<hr>
	    							<div id="isi"></div>
	    						</div>
		    				</div>
		    			</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>
<script>
	function kode(kode)
	{
		if(kode.value.length >= 1)
		{
			document.getElementById('tampilKode').style.display = 'block';
			$.ajax({
				url: 'carikode.php',
				type: 'POST',
				data: {'kd': kode.value},
				dataType: 'HTML',
				success: function(data)
				{
					$('#tampilKode').html(data)
				}
			})
		}else{
			document.getElementById('tampilKode').style.display = 'none';
		}
	}

	function barang(kode)
	{
		if(kode.value.length >= 1)
		{
			document.getElementById('tampilBarang').style.display = 'block';
			$.ajax({
				url: 'caribarang.php',
				type: 'POST',
				data: {'barang': kode.value},
				dataType: 'HTML',
				success: function(data)
				{
					$('#tampilBarang').html(data)
				}
			})
		}else{
			document.getElementById('tampilBarang').style.display = 'none';
		}
	}

	function pilihKode(kd)
	{
		$.ajax({
			url: 'pilihNamaProduk.php',
			type: 'POST',
			data: {'kd': kd},
			dataType: 'JSON',
			success: function(data)
			{
				document.getElementById('tampilKode').style.display = 'none';
				$('#nama_produk').val(data.judul)
				$('#kd_produk').val(data.kd_produk)
				ceksize(data.kd_produk)
			}
		})
	}

	function pilihbarang(kd)
	{
		$.ajax({
			url: 'pilihNamaBarang.php',
			type: 'POST',
			data: {'kd': kd},
			dataType: 'JSON',
			success: function(data)
			{
				document.getElementById('tampilBarang').style.display = 'none';
				$('#nama_produk').val(data.judul)
				$('#kd_produk').val(data.kd_produk)
				ceksize(data.kd_produk)
			}
		})
	}

	function ceksize(kd)
	{
		$.ajax({
			url: 'ceksize.php',
			type: 'POST',
			data: {'kd': kd},
			dataType: 'HTML',
			success: function(data)
			{
				$('#size').html(data)
			}
		})
	}

	function cekStok(size)
	{
		var kode = $('#kd_produk').val()
		$.ajax({
			url: 'cekstok.php',
			type: 'POST',
			data: {'kd': kode, 'size': size},
			dataType: 'JSON',
			success: function(data)
			{
				$('#harga').val(data.harga_eceran)
				$('#stok').val(data.stok)
				$('#ukuran').val(size)
			}
		})
	}

	function toalBayar(jumlah)
	{
		var stok = $('#stok').val()
		console.log(jumlah.value)
		if(jumlah.value > stok)
		{
			mati()
			console.log('hidden')
		}else{
			hidup()
			console.log('hidup')
			var harga = $('#harga').val()
			var hasil = jumlah.value * harga
			$('#total').val(hasil)
		}
	}

	function hidup()
	{
		document.getElementById('pesan').innerHTML = ''
	}

	function mati()
	{
		document.getElementById('pesan').innerHTML = 'Barang Yang Di Beli Lebih Besar Dari Stok..!'
	}

	function simpans()
	{
		var kd_produk = $('#kd_produk').val()
		var size = $('#ukuran').val()
		var jumlah = $('#jumlah').val()
		var total = $('#total').val()
		var pelanggan = $('#pelanggan').val()
		$.ajax({
			url: 'simpanoffline.php',
			type: 'POST',
			data: {
				'kd_produk': kd_produk,
				'pelanggan': pelanggan,
				'size': size,
				'jumlah': jumlah,
				'total': total
			},
			dataType: 'JSON',
			success: function(data)
			{
				if(data == 'error')
				{
					alert('Maaf Silahkan Isi Nama Pelanggan Terlebih Dahulu')
					$('#pelanggan').val(pelanggan)
					$('#kd_produk').val('')
					$('#ukuran').val('')
					$('#size').html('')
					$('#jumlah').val('')
					$('#total').val('')
					$('#harga').val('')
					$('#stok').val('')
					$('#nama_produk').val('')
					onLoad()
				}
				else
				{
					$('#pelanggan').val(pelanggan)
					$('#kd_produk').val('')
					$('#ukuran').val('')
					$('#size').html('')
					$('#jumlah').val('')
					$('#total').val('')
					$('#harga').val('')
					$('#stok').val('')
					$('#nama_produk').val('')
					onLoad()
				}
			}
		})
	}

	function onLoad()
	{
		$('#isi').load('tampilKeranjang.php');
	}

	$(document).ready(function(){
		document.getElementById('total_belanja').innerHTML = 0
		$('#pelanggan').focus()
		onLoad()
	})

	function caripelanggan(nama)
	{
		if(nama.value.length >= 1)
		{
			$('#namapelanggan').val('Loading..')
			document.getElementById('namapelanggan').style.display = 'block';
			$.ajax({
				url: 'carinama.php',
				type: 'POST',
				data: {'nama': nama.value},
				dataType: 'HTML',
				success: function(data)
				{
					$('#namapelanggan').html(data)
				}
			})
		}else{
			document.getElementById('namapelanggan').style.display = 'none';
		}	
	}

	function pilihpelanggan(nama)
	{
		$.ajax({
			url: 'pilihNama.php',
			type: 'POST',
			data: {'nama': nama},
			dataType: 'JSON',
			success: function(data)
			{
				document.getElementById('namapelanggan').style.display = 'none';
				$('#pelanggan').val(data.nama_pelanggan)
			}
		})
	}

	function kembali(uang)
	{
		var belanja = $('#total_belanja').val()
		var bayar = uang.value
		var kembali = bayar - belanja
		$('#kembalian').val(kembali)
	}

	function hapusBarang(id)
	{
		$.ajax({
			url: 'hapusKeranjang.php',
			type: 'POST',
			data: {'id': id},
			dataType: 'JSON',
			success: function(data)
			{
				onLoad()
				console.log(data)
			}
		})
	}

	function simpanTransaksi()
	{
		var faktur = $('#faktur').val()
		var tanggal = $('#tanggal').val()
		var pelanggan = $('#pelanggan').val()
		var total_belanja = $('#total_belanja').val()
		var bayar = $('#total_bayar').val()
		$.ajax({
			url: 'simpanTransaksi.php',
			type: 'POST',
			data: {
				'nota':faktur,
				'tanggal': tanggal,
				'pelanggan': pelanggan,
				'total_belanja': total_belanja
			},
			dataType: 'JSON',
			success: function(data)
			{
				window.open('CRUD/modul_transaksi/nota.php?nota='+ faktur +'&a='+bayar, '_blank');
				console.log(data)
				location.reload()
			}
		})
	}
</script>