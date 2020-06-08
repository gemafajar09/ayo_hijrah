<div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Testimonial</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Testimonial</li>
            </ul>
          </div>
        </div>
      </div>

<section class="container ">
        <h3 class="text-center mb-30">Testimonial</h3>
        <div class="row">
		<?php 
		$sql = mysqli_query($con, "SELECT * FROM tbl_customer,tbl_orders
								WHERE tbl_customer.id_customer=tbl_orders.id_customer
								And tbl_orders.id_customer='$_SESSION[idcs]'");

								$cek = mysqli_num_rows($sql);
								if($cek == 0){ ?>
							<tr>
								<td colspan=7>Silahkan Belanja Terlebih Dahulu.</td>
							</tr>
		<?php
								}else{
		?>
		<form action="" method="POST">
          <div class="col-md-12 col-sm-12">
            <div class="form-group col-md-12">
				<label for="nama">Nama *</label>
				<?php if (!empty($_SESSION["email"])){ ?><?php if ($_SESSION["email"]){?>
					<input type="text" id="nama" name="nama" class="form-control" value="<?= $_SESSION['nama'];?>" required>	
					<input type="hidden"  name="id_customer" class="form-control" value="<?= $_SESSION['idcs'];?>">
				<?php }} ?>
				<?php if (empty($_SESSION["email"])){ ?>
					<input type="text" id="nama" name="nama" class="form-control"  required>
				<?php } ?>
			</div>
			<div class="form-group col-md-12">
				<label for="alamat">Isi *</label>
				<textarea name="isi_testi" rows="4" cols="80" class="form-control"></textarea>
			</div>
			<?php if (!empty($_SESSION["email"])){ ?><?php if ($_SESSION["email"]){?>
			<button type="submit" class="btn btn-primary" name="simpan" style="cursor: pointer;">Simpan</button>
			<?php }} ?>
			
			<?php if (empty($_SESSION["email"])){ ?>
					<button type="submit"  class="btn btn-primary" onclick="return confirm('ANDA BELUM LOGIN. SILAHKAN LOGIN TERLEBIH DAHULU ... ?')" style="cursor: pointer;" href="login.php">Simpan</button>
			<?php } ?>
        </div>
		</form>
								<?php } ?>
		</div>
</section>
<?php 
	$tgl =date("Y-m-d H:i:s");
	if(isset($_POST["simpan"])){
		mysqli_query($con, "INSERT INTO `tbl_testimonial`(`id_customer`, `isi_testi`, `tgl_testi`) VALUES ('$_POST[id_customer]','$_POST[isi_testi]','$tgl')");
		echo "<script>window.location='index.php';</script>";
	}
?>
<br><hr>
	  
	  <section class="bg-faded padding-top-3x padding-bottom-3x">
        <div class="container">
          <h3 class="widget-title">Testimonial</h3>
          <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">
				<?php
					$sql = mysqli_query($con, "SELECT * FROM tbl_testimonial,tbl_customer where tbl_testimonial.id_customer=tbl_customer.id_customer ");
					while($r=mysqli_fetch_assoc($sql)){
				?>
				
                  <h4 class="entry-title"><?= $r["nama_lengkap"];?> <?= $r["tgl_testi"];?></h4><span class="entry-meta"><?= $r["isi_testi"];?></span><?php } ?>
				</div>
				
        </div>
      </section>