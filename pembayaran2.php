<script type="text/javascript" src="css/jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#prov").change(function(){
    var provinsi = $("#prov").val();
	$.ajax({
        url: "cari_kota.php",
        data: "provinsi="+provinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
});

</script>

 <section class="container padding-top-3x">
        <h3 class="text-center mb-30">Alamat Pengiriman</h3>
        <div class="row">
<?php
	if(@$_SESSION['idcs']==''){
	echo "<script>window.location='login.php';</script>";
	}
?>
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahalamat" :

    if(isset($_POST['simpan'])){
			$nama = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['nama'])))));
			$kodepos = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['kodepos'])))));
			$alamat = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['alamat'])))));
			
			$sql = mysqli_query($con, "INSERT INTO `tbl_alamat`(`id_customer`, `namaal`, `id_prov`, `id_kota`, `kodepos`, `alamat`) VALUES('$_SESSION[idcs]', '$nama', '$_POST[id_prov]','$_POST[id_kota]','$kodepos', '$alamat')");

			if($sql){ ?>
				<script>
					swal({
						title:"Alamat Berhasil Disimpan",
						text: "Terimakasih",
						icon: "success"
					})
					.then((value) => {
						window.location="alamatkirim";
					});
			</script>
	<?php
		}else{
			echo "<script>swal('Alamat Kirim Gagal Ditambah','warning');
										window.location.href='alamatkirim';</script>";
			}
    }
?>
<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-2">

<div class="contact_form_container">
	

	<form action="" method="POST">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="nama">Nama *</label>
					<input type="text" id="nama" name="nama" class="form-control" required>
					
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="prov">Provinsi *</label>
					<select class="form-control" name="id_prov" id="prov" required>
						<option selected>Pilih Provinsi</option>
						<?php
								$prov = mysqli_query($con, "SELECT * FROM tbl_provinsi");
								while($row=mysqli_fetch_assoc($prov)){
						?>
							<option value="<?php echo $row['id_prov'] ?>"><?php echo $row['nama_prov'] ?></option>
						<?php } ?>
					</select>
			</div>
			<div class="form-group col-md-4">
				<label for="kota">Kota *</label>
					<select class="form-control" name="id_kota" id="kota" required>
						<option selected>Pilih Kota</option>
					</select>
			</div>
			<div class="form-group col-md-2 ml-2">
				<label for="kodepos">Kode Pos *</label>
					<input type="text" name="kodepos" id="kodepos" class="form-control" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="alamat">Alamat *</label>
				<textarea name="alamat" id="alamat" rows="4" cols="80" class="form-control"></textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" name="simpan" style="cursor: pointer;">Simpan</button>
	</form>
</div>
</div>
</div>
</div>
</div>
<div class="panel"></div>
<?php
    break;
    case "editalamat":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_alamat WHERE id_alamat='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['simpan'])){
			$nama = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['nama'])))));
			$kodepos = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['kodepos'])))));
			$alamat = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['alamat'])))));

      $sql = mysqli_query($con, "INSERT INTO `tbl_alamat`(`id_customer`, `namaal`, `id_prov`, `id_kota`, `kodepos`, `alamat`) VALUES ('$_SESSION[idcs]', '$nama', '$_POST[id_prov]','$_POST[id_kota]','$kodepos', '$alamat')");

			if($save){ ?>
				<script>
					swal({
						title:"Alamat Berhasil Diedit",
						text: "Terimakasih",
						icon: "success"
					})
					.then((value) => {
						window.location="alamatkirim";
					});
			</script>
	<?php
		}else{
			echo "<script>swal('Alamat Kirim Gagal Diedit','warning');
										window.location.href='alamatkirim';</script>";
			}
    }
?>
<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-2">
<div class="contact_form_container">
	

	<form action="" method="POST">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="nama">Nama *</label>
					<input type="text" id="nama" name="nama" class="form-control" value="<?= $data['namaal'] ?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="prov">Provinsi *</label>
					<select class="form-control" name="id_prov" id="prov" required>
						<option selected>Pilih Provinsi</option>
						<?php
								$prov = mysqli_query($con, "SELECT * FROM tbl_provinsi");
								while($row=mysqli_fetch_assoc($prov)){
										if($row['id_prov']==$data['id_prov']){
												$selected = "selected";
										}else{
												$selected = "";
										}
						?>
							<option <?= $selected ?> value="<?php echo $row['id_prov'] ?>"><?php echo $row['nama_prov'] ?></option>
						<?php } ?>
					</select>
			</div>
			<div class="form-group col-md-4">
				<label for="kota">Kota *</label>
					<select class="form-control" name="id_kota" id="kota" required>
						<option selected>Pilih Kota</option>
						<?php
								$sql = mysqli_query($con, "SELECT * FROM tbl_kota");
								while($r=mysqli_fetch_assoc($sql)){
									if($r['id_kota']==$data['id_kota']){
											$selected = "selected";
									}else{
											$selected = "";
									}
						?>
							<option <?= $selected ?> value="<?= $r['id_kota'] ?>"><?= $r['nama_kota'] ?></option>
						<?php } ?>
					</select>
			</div>
			<div class="form-group col-md-2 ml-2">
				<label for="kodepos">Kode Pos *</label>
					<input type="text" name="kodepos" id="kodepos" class="form-control" value="<?= $data['kodepos'] ?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="alamat">Alamat *</label>
				<textarea name="alamat" id="alamat" rows="4" cols="80" class="form-control"> <?= $data['alamat'] ?> </textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" name="simpan" style="cursor: pointer;">Simpan</button>
	</form>
</div>
</div>
</div>
</div>
</div>
<div class="panel"></div>
<?php
    break;
    case "hapusalamat" :

    if(isset($_GET['id'])){
      mysqli_query($con, "DELETE FROM tbl_alamat WHERE id_alamat='$_GET[id]'");
    	echo "<script>
    					window.location='alamatkirim';
    				</script>";
    }
?>
<?php
break;
}
}else{
	if(isset($_POST['simpan'])){
			$nama = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['nama'])))));
			$kodepos = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['kodepos'])))));
			$alamat = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['alamat'])))));

	 $sql = mysqli_query($con, "INSERT INTO `tbl_alamat`(`id_customer`, `namaal`, `id_prov`, `id_kota`, `kodepos`, `alamat`) VALUES ('$_SESSION[idcs]', '$nama', '$_POST[id_prov]','$_POST[id_kota]','$kodepos', '$alamat')");

		if($sql){ ?>
			<script>
				swal({
					title:"Alamat Berhasil Disimpan",
					text: "Terimakasih",
					icon: "success"
				})
				.then((value) => {
					window.location="alamatkirim";
				});
		</script>
<?php
	}else{
		echo "<script>swal('Alamat Kirim Gagal Ditambah','warning');
									window.location.href='alamatkirim';</script>";
		}
	}
?>

<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-2">
					<?php
						$lihat = mysqli_query($con, "SELECT * FROM tbl_alamat WHERE id_customer='$_SESSION[idcs]'");
						$cek = mysqli_num_rows($lihat);
						if($cek <= 0){
					?>
					<div class="contact_form_container">
						

						<form action="" method="POST">
              <div class="form-row">
						    <div class="form-group col-md-6">
                  <label for="nama">Nama *</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="id_prov">Provinsi *</label>
									<select class="form-control" name="id_prov" id="prov" required>
										<option selected>Pilih Provinsi</option>
										<?php
												$prov = mysqli_query($con, "SELECT * FROM tbl_provinsi");
												while($row=mysqli_fetch_assoc($prov)){
										?>
											<option value="<?php echo $row['id_prov'] ?>"><?php echo $row['nama_prov'] ?></option>
										<?php } ?>
									</select>
                </div>
                <div class="form-group col-md-4">
                  <label for="id_kota">Kota *</label>
									<select class="form-control" name="id_kota" id="kota" required>
										<option selected>Pilih Kota</option>
									</select>
                </div>
                <div class="form-group col-md-2 ml-2">
                  <label for="kodepos">Kode Pos *</label>
                    <input type="text" name="kodepos" id="kodepos" class="form-control" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="alamat">Alamat *</label>
                  <textarea name="alamat" id="alamat" rows="4" cols="80" class="form-control"></textarea>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" name="simpan" style="cursor: pointer;">Simpan</button>
						</form>
					</div>
			<?php }else{ ?>
								<div class="row">
									<br><br>
								</div>

								<div class="row">
									<?php
											$alamat =  mysqli_query($con, "SELECT p.*, k.*, a.* FROM tbl_alamat a LEFT JOIN tbl_provinsi p ON a.id_prov=p.id_prov LEFT JOIN tbl_kota k ON a.id_kota=k.id_kota WHERE id_customer='$_SESSION[idcs]'");
											while($data = mysqli_fetch_assoc($alamat)){
									?>
									<div class="col-sm-6">
										<div class="card">
      								<div class="card-body">
											<form action="?module=cekkonfirmasi" method="POST">
        							<input type="radio" name="alamat" value="<?= $data['id_alamat'] ?>" style="width: 100%; height: 2em;" required><h4 class="card-title text-center">Gunakan Alamat Ini</h4>
        							<p>Nama Penerima &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $data['namaal'] ?> <br>
												 Provinsi &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $data['nama_prov'] ?><br>
												 Kota &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $data['nama_kota'] ?><br>
												 Kode Pos &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $data['kodepos'] ?><br>
												 Alamat &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $data['alamat'] ?><br>
												</p>
											<hr>
        							<a href="edit-alamat-<?php echo $data['id_alamat'] ?>" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
											<a href="hapus-alamat-<?php echo $data['id_alamat'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
											<br><br>
      								</div>
    								</div>
								</div>
						<?php } ?>
									<div class="container mt-3">
											<button type="submit" name="lanjutkan" class="btn btn-primary" style="cursor: pointer;">Lanjutkan</button>
									</div>
						</form>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
<?php } ?>


        </div>
		</div>
</section>