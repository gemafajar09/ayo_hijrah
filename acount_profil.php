<?php 
	$sql = mysqli_query($con, "SELECT * FROM tbl_customer where id_customer='$_SESSION[idcs]'");
	$r=mysqli_fetch_assoc($sql);
?>
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>My Profile</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="./">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li><a href="account-orders.html">Account</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>My Profile</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-lg-4">
            <aside class="user-info-wrapper">
              <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
               </div>
              <div class="user-info">
                <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="img/account/orang3.png" alt="User"></div>
                <div class="user-data">
                  <h4><?= $r['nama_lengkap']; ?></h4><span>Joined <?= tgl_indo($r["tgl_daftar"]);?></span>
                </div>
              </div>
            </aside>
            <nav class="list-group">
				<a class="list-group-item active" href=""><i class="icon-head"></i>Profile</a>
			</nav>
          </div>
          <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <form class="row" action="" method="POST">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-fn">Nama</label>
                  <input class="form-control" type="text" id="account-fn" name="nama_lengkap" value="<?= $r['nama_lengkap']; ?>" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-ln">Tanggal Daftar</label>
                  <input class="form-control" type="text" id="account-ln" value="<?= $r['tgl_daftar']?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-email">E-mail Address</label>
                  <input class="form-control" type="email" id="account-email" name="email" value="<?= $_SESSION['email'];?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-phone">Phone Number</label>
                  <input class="form-control" type="text" id="account-phone" name="nohp" value="<?= $r['nohp']?>" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-pass">New Password</label>
                  <input class="form-control" type="password" name="password" >
				  <input type="hidden" class="form-control" type="password" name="passlama" value="<?= $r['password'];?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="account-confirm-pass">Confirm Password</label>
                  <input class="form-control" type="password" >
                </div>
              </div>
              <div class="col-12">
                <hr class="mt-2 mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <div class="custom-control custom-checkbox d-block">
                    <input class="custom-control-input" type="checkbox" id="subscribe_me" checked>
                  </div>
                  <button class="btn btn-primary margin-right-none" name="update" type="submit" data-toast data-toast-position="topRight" data-toast-type="success" data-toast-icon="icon-circle-check" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Update Profile</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
     <?php 
		if(isset($_POST["update"])){
			$pass=md5($_POST['password']);
			if(!empty($_POST["password"])){
				mysqli_query($con, "UPDATE tbl_customer set nama_lengkap='$_POST[nama_lengkap]', nohp='$_POST[nohp]', password='$pass' where id_customer='$_SESSION[idcs]'");
			echo"<script>window.location='?module=acount_profil';</script>";
			} else if(empty($_POST["password"])){
				mysqli_query($con, "UPDATE tbl_customer set nama_lengkap='$_POST[nama_lengkap]', nohp='$_POST[nohp]' where id_customer='$_SESSION[idcs]'");
			echo"<script>window.location='my-profil';</script>";
			}
		}
	 ?>