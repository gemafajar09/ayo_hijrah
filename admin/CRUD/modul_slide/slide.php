<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editslide" :

    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_slide WHERE id_slide='$_GET[id]'");
      $r=mysqli_fetch_assoc($sql);
    }

    if(isset($_POST['save'])){
//       $nmfoto1 = $_FILES["slide_1"]["name"];
// 			$lokfoto1 = $_FILES["slide_1"]["tmp_name"];
//       $new1= date("YmdHis").$nmfoto1;
//       $nmfoto2 = $_FILES["slide_2"]["name"];
// 			$lokfoto2 = $_FILES["slide_2"]["tmp_name"];
//       $new2= date("YmdHis").$nmfoto2;
//       $nmfoto3 = $_FILES["slide_3"]["name"];
// 			$lokfoto3 = $_FILES["slide_3"]["tmp_name"];
//       $new3= date("YmdHis").$nmfoto3;
	  
// 	  $nmfoto4 = $_FILES["logo_1"]["name"];
// 			$lokfoto4 = $_FILES["logo_1"]["tmp_name"];
//       $new4= date("YmdHis").$nmfoto4;
// 	  $nmfoto5 = $_FILES["logo_2"]["name"];
// 			$lokfoto5 = $_FILES["logo_2"]["tmp_name"];
//       $new5= date("YmdHis").$nmfoto5;
// 	  $nmfoto6 = $_FILES["logo_3"]["name"];
// 			$lokfoto6 = $_FILES["logo_3"]["tmp_name"];
//       $new6= date("YmdHis").$nmfoto6;
	  
	  
// 				if(!empty($lokfoto1)){
// 					move_uploaded_file($lokfoto1, "../foto/slide/$new1");
// 				}else{
//           $new1 = $_POST['foto_lama1'];
//         }
//         if(!empty($lokfoto2)){
// 					move_uploaded_file($lokfoto2, "../foto/slide/$new2");
// 				}else{
//           $new2 = $_POST['foto_lama2'];
//         }
//         if(!empty($lokfoto3)){
// 					move_uploaded_file($lokfoto3, "../foto/slide/$new3");
// 				}else{
//           $new3 = $_POST['foto_lama3'];
//         }
		
// 		if(!empty($lokfoto4)){
// 					move_uploaded_file($lokfoto4, "../foto/logoslide/$new4");
// 				}else{
//           $new4 = $_POST['logo_lama1'];
//         }
// 		if(!empty($lokfoto5)){
// 					move_uploaded_file($lokfoto5, "../foto/logoslide/$new5");
// 				}else{
//           $new5 = $_POST['logo_lama2'];
//         }
// 		if(!empty($lokfoto6)){
// 					move_uploaded_file($lokfoto6, "../foto/logoslide/$new6");
// 				}else{
//           $new6 = $_POST['logo_lama3'];
//         }
		
//       $save=mysqli_query($con, "UPDATE tbl_slide SET gambar_1='$new1', gambar_2='$new2', gambar_3='$new3', logo_1='$new4', logo_2='$new5'
// 	  , logo_3='$new6', nama='$_POST[nama]', harga='$_POST[harga]', nama_1='$_POST[nama1]', harga_1='$_POST[harga1]', nama_2='$_POST[nama2]', harga_2='$_POST[harga2]'");
        $lokfoto1   = $_FILES["slide_1"]["tmp_name"];
        $nmfoto1    = $_FILES["slide_1"]["name"];
        $new1       = date("YmdHis") . $nmfoto1;
        $size1      = $_FILES["slide_1"]["size"];

        $lokfoto2   = $_FILES["slide_2"]["tmp_name"];
        $nmfoto2    = $_FILES["slide_2"]["name"];
        $new2       = date("YmdHis") . $nmfoto2;
        $size2      = $_FILES["slide_2"]["size"];

        $lokfoto3   = $_FILES["slide_3"]["tmp_name"];
        $nmfoto3    = $_FILES["slide_3"]["name"];
        $new3       = date("YmdHis") . $nmfoto3;
        $size3      = $_FILES["slide_3"]["size"];

        if (!empty($lokfoto1)) {
          if ($size1 < 1048576) {
            move_uploaded_file($lokfoto1, "../foto/slide/$new1");
            $save = mysqli_query($con, "UPDATE tbl_slide SET 
                                gambar_1='$new1'");
            unlink("../foto/slide/" . $r['gambar_1']);
          } else {
            echo  "<script>
                  alert('Maksimal Ukuran Slide 1 adalah 1 MB');
                  </script>";
          }
        }

        if (!empty($lokfoto2)) {
          if ($size2 < 1048576) {
            move_uploaded_file($lokfoto2, "../foto/slide/$new2");
            $save = mysqli_query($con, "UPDATE tbl_slide SET 
                              gambar_2='$new2'");
            unlink("../foto/slide/" . $r['gambar_2']);
          } else {
            echo  "<script>
                alert('Maksimal Ukuran Slide 2 adalah 1 MB');
                </script>";
          }
        }

        if (!empty($lokfoto3)) {
          if ($size3 < 1048576) {
            move_uploaded_file($lokfoto3, "../foto/slide/$new3");
            $save = mysqli_query($con, "UPDATE tbl_slide SET 
                        gambar_3='$new3'");
            unlink("../foto/slide/" . $r['gambar_3']);
          } else {
            echo  "<script>
          alert('Maksimal Ukuran Slide 3 adalah 1 MB');
          </script>";
          }
        }
      if($save) {
      echo"<script language=javascript>
            window.location='?page=slide';
            </script>";
            exit;
          }else{
            echo"gagal";
          }
    }
?>
<section class="content-header">
      <h1>
        Slide
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Slide</li>
      </ol>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
   <div class="box box-info">
        <!-- form start -->
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group" >
              <label class="col-sm-2 control-label">Slide 1</label>
              <div class="col-sm-4">
                <img src="../foto/slide/<?= $r['gambar_1'] ?>" style="width: 100%; height: 200px;"><br><br>
                <input type="file" name="slide_1">
                <input type="hidden" name="foto_lama1" value="<?= $r['gambar_1'] ?>">
                 <img src="../foto/logoslide/<?= $r['logo_1'] ?>" style="width: 30%; height: 100px; display:none;"><br><br> 
                       <input type="hidden" name="logo_1">
                <input type="hidden" name="logo_lama1" value="<?= $r['logo_1'] ?>">
				<input type="hidden" name="nama" placeholder="nama hp" value="<?= $r['nama'] ?>">
				<input type="hidden" name="harga" placeholder="harga"value="<?= $r['harga'] ?>"> 
              </div>
            </div>

            <div class="form-group" >
              <label class="col-sm-2 control-label">Slide 2</label>
              <div class="col-sm-4">
                <img src="../foto/slide/<?= $r['gambar_2'] ?>" style="width: 100%; height: 200px;"><br><br>
                <input type="file" name="slide_2">
                <input type="hidden" name="foto_lama2" value="<?= $r['gambar_2'] ?>">
                  <img src="../foto/logoslide/<?= $r['logo_2'] ?>" style="width: 40%; height: 100px; display:none;"><br><br>
                      <input type="hidden" name="logo_2">
                      <input type="hidden" name="logo_lama2" value="<?= $r['logo_2'] ?>">
                      <input type="hidden" name="nama1" placeholder="nama hp" value="<?= $r['nama_1'] ?>">
                      <input type="hidden" name="harga1" placeholder="harga" value="<?= $r['harga_1'] ?>">
              </div>
            </div>

            <div class="form-group" >
              <label class="col-sm-2 control-label">Slide 3</label>
              <div class="col-sm-4">
                <img src="../foto/slide/<?= $r['gambar_3'] ?>" style="width: 100%; height: 200px;"><br><br>
                <input type="file" name="slide_3">
                <input type="hidden" name="foto_lama3" value="<?= $r['gambar_3'] ?>">
                  <img src="../foto/logoslide/<?= $r['logo_3'] ?>" style="width: 30%; height: 100px;display:none;"><br><br>
                      <input type="hidden" name="logo_3">
                      <input type="hidden" name="logo_lama3" value="<?= $r['logo_3'] ?>">
                      <input type="hidden" name="nama2" placeholder="nama hp" value="<?= $r['nama_2'] ?>">
                      <input type="hidden" name="harga2" placeholder="harga" value="<?= $r['harga_2'] ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-4 col-md-offset-2">
                <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
              </div>
            </div>
          </div>
          <hr>
          <div >
              <font color="red"><b></b>&nbsp;&nbsp;&nbsp;Notice :&nbsp; ** </font><b></b>File Foto di bawah 1MB</b>
          </div>
          <hr>
        </form>
      </div>
    </div>
</div>
</section>
<?php
break;
}
}else{
?>
<section class="content-header">
      <h1>
        Slide
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slide</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                     <th>Slide 1</th>
                     <th>Slide 2</th>
                     <th>Slide 3</th>
                     <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_slide");
          				$r=mysqli_fetch_array($q);
                ?>
						      <tr>
						          <td><img src="../foto/slide/<?= $r['gambar_1'] ?>" style="width: 100px; height: 70px;"></td>
						          <td><img src="../foto/slide/<?= $r['gambar_2'] ?>" style="width: 100px; height: 70px;"></td>
						          <td><img src="../foto/slide/<?= $r['gambar_3'] ?>" style="width: 100px; height: 70px;"></td>
                      <td><a class='btn btn-success btn-xs' title='Edit Data' href='?page=slide&aksi=editslide&id=<?php echo $r['id_slide']; ?>'><span class='glyphicon glyphicon-edit'></span></a></td>
						      </tr>
				      </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
          <!-- /.box -->
     </section>
<?php } ?>
