<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editslide" :

    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tb_slider WHERE id_slider='$_GET[id]'");
      $r=mysqli_fetch_assoc($sql);
    }

    if(isset($_POST['save'])){

//       $save=mysqli_query($con, "UPDATE tbl_slide SET gambar_1='$new1', gambar_2='$new2', gambar_3='$new3', logo_1='$new4', logo_2='$new5'
// 	  , logo_3='$new6', nama='$_POST[nama]', harga='$_POST[harga]', nama_1='$_POST[nama1]', harga_1='$_POST[harga1]', nama_2='$_POST[nama2]', harga_2='$_POST[harga2]'");
        $lokfoto1   = $_FILES["gambar_slider"]["tmp_name"];
        $nmfoto1    = $_FILES["gambar_slider"]["name"];
        $new1       = date("YmdHis") . $nmfoto1;
        $size1      = $_FILES["gambar_slider"]["size"];

        if (!empty($lokfoto1)) {
          if ($size1 < 1048576) {
            unlink("../img/slide/" . $r['gambar_slider']);
            move_uploaded_file($lokfoto1, "../img/slide/$new1");
            $save = mysqli_query($con, "UPDATE tb_slider SET 
                                gambar_slider='$new1' WHERE id_slider = $_GET[id]");
          } else {
            echo  "<script>
                  alert('Maksimal Ukuran Slide 1 adalah 1 MB');
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
              <label class="col-sm-2 control-label">Gambar Slider</label>
              <div class="col-sm-4">
                <input type="hidden" name="foto_lama1" value="<?= $r['gambar_slider'] ?>">
                <img src="../img/slide/<?= $r['gambar_slider'] ?>" style="width: 100%; height: 200px;"><br><br>
                <input type="file" name="gambar_slider">
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
                     <th>No</th>
                     <th>Gambar</th>
                     <th>Action</th>
                  </tr>
                </thead>

                <tbody>
          			<?php
          				$q=mysqli_query($con, "SELECT * from tb_slider");
          				foreach($q as $no => $r){
                    ?>
                
						      <tr>
						          <td><?php echo $no+1?></td>
						          <td><img src="../img/slide/<?= $r['gambar_slider'] ?>" style="width: 100px; height: 70px;"></td>
                      <td><a class='btn btn-success btn-xs' title='Edit Data' href='?page=slide&aksi=editslide&id=<?php echo $r['id_slider']; ?>'><span class='glyphicon glyphicon-edit'></span></a></td>
						      </tr>
                  <?php    
                  }
                ?>
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
