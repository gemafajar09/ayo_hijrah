<?php

	$sql = mysqli_query($con, "SELECT * FROM tbl_orders where id_order='$_GET[id_order]'");

	$r = mysqli_fetch_assoc($sql);

?>

<div class="page-title">

        <div class="container">

          <div class="column">

            <h1>Konfirmasi Pembayaran</h1>

          </div>

          <div class="column">

            <ul class="breadcrumbs">

              <li><a href="index.html">Home</a>

              </li>

              <li class="separator">&nbsp;</li>

              <li>Konfirmasi Pembayaran</li>

            </ul>

          </div>

        </div>

      </div>



<section class="container " style="padding-bottom:10px;">

        <h3 class="text-center ">Konfirmasi Pembayaran</h3>

        <div class="row " >	  

			<form action="" method="POST" enctype="multipart/form-data">

			<div class="col-lg-8 col-lg-offset-3 " style="border:1px solid #e8e8eb;border-radius:5px;padding:10px;"  >

					<input type="hidden" name="id_order" value="<?= $r['id_order']?>">

					<input type="hidden"  name="totalbayar"  value="<?= $r['total']?>">

				


				

					<div class="form-group col-md-12">

						<label for="nama">Bukti Pembayaran *</label>

						<input type="file"  name="gambar" class="form-control" required>
						<font color="red" size="4">*</font><font size="2"><b>Nb : Ukuran Foto Maksimal 2mb</b></font>

					</div>

					

					<div class="form-group col-md-4">

						<input type="submit"  name="pesan" value="Konfirmasi" class="btn btn-info" required>

					</div>

			</div>

			</form>

        </div>

</section>



<?php

$tgl = date("Y-m-d H:i:s");

if(isset($_POST["pesan"])){

   $nmfoto  = $_FILES["gambar"]["name"];

   $lokfoto = $_FILES["gambar"]["tmp_name"];

   $newbukti= date("YmdHis").$nmfoto;
   
   $size     = $_FILES['gambar'] ['size'];

   if($size<2048576 ){
	   $pindah = move_uploaded_file($lokfoto, "foto/bukti/$newbukti");
	if($pindah){

	$sqlpr = mysqli_query($con, "INSERT INTO `tbl_konfirmasi_bayar`(`id_order`, `total_bayars`, `bukti`, `tgl_bayar`) VALUES ('$_POST[id_order]' ,'$_POST[totalbayar]', '$newbukti', '$tgl')");

	$update= mysqli_query($con, " UPDATE tbl_orders set status_ord='Lunas' where id_order='$_GET[id_order]'");

	echo"<script>

		window.alert('Konfirmasi berhasil');

		window.location='./';

	</script>";
	}else{
		echo"<script>

		window.alert('GAGAL Upload. Maksimal Upload Foto 2 MB');

	</script>";
	}
	}else{
          echo  "<script>
                alert('Maksimal Upload Foto 2 MB');
                </script>";
        }

}


?>