<!-- <script type="text/javascript" src="jquery.js"></script> -->
<script type="text/javascript">
  var htmlobjek;
  $(document).ready(function() {
    //apabila terjadi event onchange terhadap object <select id=propinsi>
    $("#kategori").change(function() {
      var kategori = $("#kategori").val();
      $.ajax({
        url: "CRUD/modul_produk/cari_subkat.php",
        data: "id_kategori=" + kategori,
        cache: false,
        success: function(msg) {
          //jika data sukses diambil dari server kita tampilkan
          //di <select id=kota>
          $("#subkat").html(msg);
        }
      });
    });
  });
</script>

<?php
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];

  switch ($aksi) {
    case "tambahproduk":

      if (isset($_POST['save'])) {

        $cek = mysqli_query($con, "SELECT * FROM tb_produk where kd_produk='$_POST[kd_produk]'");
        $jumlah = mysqli_num_rows($cek);
        if ($jumlah > 0) {
          echo "<script>alert('Maaf, Kode sudah ada, silahkan masukan kode yang lain !');window.location.href='index.php?page=produk&aksi=tambahproduk'</script>";
        } else {
          if ($_POST['stok'] > 0) {
            $status = "Y";
          } else {
            $status = "T";
          }
          $judulseo = seo_title($_POST['judul']);
          $tglskrg = date('Y-m-d');

          $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
          $nama_foto    = $_FILES['foto']['name'];
          $lokasi_foto = $_FILES["foto"]["tmp_name"];
          $ukuran_foto = $_FILES['foto']['size'];
          $file_name = explode('.', $nama_foto);
          $nama_file = end($file_name);
          $file_ext = strtolower($nama_file);
          $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
          if ($ukuran_foto < 1048576) {
            if (!in_array($file_ext, $allowed)) {
              echo "<script>
                      window.alert('Gambar Produk Thumnail Tidak Valid');
                      window.location='?page=produk';
                    </script>";
            } else {

              $allowed1 = array("image/jpg", "image/jpeg");
              $nama_foto1    = $_FILES['foto1']['name'];
              $type    = $_FILES['foto1']['type'];
              $lokasi_foto1 = $_FILES["foto1"]["tmp_name"];
              $ukuran_foto1 = $_FILES['foto1']['size'];
              $file_name1 = explode('.', $nama_foto1);
              $nama_file1 = end($file_name1);
              $file_ext1 = strtolower($nama_file1);
              $nama_file_foto1 = str_replace(" ", "-", $file_name1[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext1;

              foreach ($nama_foto1 as $i => $a) {
                if (!in_array($type[$i], $allowed1)) {
                  // var_dump($type[$i]);
                  echo "<script>
                            window.alert('Gambar Tidak Valid');
                            window.location='?page=produk';
                          </script>";
                  exit;
                }
              }
              foreach ($nama_foto1 as $i => $a) {
                if (!in_array($type[$i], $allowed1)) {
                  // var_dump($type[$i]);
                  echo "<script>
                            window.alert('Gambar Tidak Valid');
                            window.location='?page=produk';
                          </script>";
                  exit;
                } else {
                  if (empty($nama_foto1[$i])) {
                    $date1 = "";
                  } else {
                    $date1 = date("YmdHis");
                  }
                  $nmfoto1 = $date1 . $nama_foto1[$i];
                  if (!empty($lokasi_foto1[$i])) {
                    move_uploaded_file($lokasi_foto1[$i], "../img/produk_detail/$nmfoto1");
                  }
                  mysqli_query($con, "INSERT INTO tb_gambar(gambar_produk, kd_produk) VALUES ('$nmfoto1', '$_POST[kd_produk]')");
                }
              }
              // insert size
              $ukuran = $_POST['ukuran'];
              $stok = $_POST['stok'];
              foreach ($stok as $i => $a) {
                mysqli_query($con, "INSERT INTO `tb_detail_size`(`kd_produk`, `ukuran`, `stok`) VALUES ('$_POST[kd_produk]','$ukuran[$i]','$stok[$i]')");
              }
              // batas input size
              if (!empty($lokasi_foto)) {
                move_uploaded_file($lokasi_foto, "../img/produk/$nama_file_foto");
              }
              $save = mysqli_query($con, "INSERT INTO `tb_produk`(`kd_produk`,`id_kategori`,`id_brand`,`judul`, `berat`,
               `deskripsi`, `harga_grosir`, `harga_eceran`, `foto`, `status`, `jenis`, `judul_seo`,  `tgl_input`) VALUES
                  ('$_POST[kd_produk]','$_POST[id_kategori]','$_POST[id_brand]', '$_POST[judul]','$_POST[berat]', '$_POST[deskripsi]', '$_POST[harga_grosir]', '$_POST[harga_eceran]', '$nama_file_foto', '$status','Baru','$judulseo','$tglskrg')");
              // }
            }
          }
          if ($save) {
            echo "<script>
              alert('Tambah Data Berhasil');
              window.location='?page=produk';
              </script>";
            exit;
          } else {
            echo "<script>alert('Gagal');
              </script>";
          }
        }
      }

?>
      <section class="content-header">
        <h1>
          Produk
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Tambah Produk</li>
        </ol>
      </section>
      <!-- Content Header (Page header) -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header with-border">

              </div>
              <!-- form start -->
              <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="kdp" id="kdp" class="col-sm-2 control-label">Kode Produk</label>
                      <div class="col-sm-4">
                        <input type="text" name="kd_produk" id="kdp" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="nmkat" class="col-sm-2 control-label">Nama Kategori</label>
                      <div class="col-sm-4">
                        <select type="text" name="id_kategori" class="form-control">
                          <option value="">--Pilih Jenis--</option>
                          <?php
                          $result = mysqli_query($con, "select * from tb_kategori");
                          $jsArray = "var dtind = new Array();\n";
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nmkat" class="col-sm-2 control-label">Brand</label>
                      <div class="col-sm-4">
                        <select type="text" name="id_brand" class="form-control" id="subkat">
                          <option value="">--Pilih Brand--</option>
                          <?php
                          $result = mysqli_query($con, "select * from tb_brand");
                          $jsArray = "var dtind = new Array();\n";
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id_brand'] . '">' . $row['nama_brand'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <hr>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Ukuran</label>
                    </div>
                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">S</label>
                      <div class="col-sm-4">
                        <input type="hidden" name="ukuran[]" value="S">
                        <input type="number" name="stok[]" id="stok[]" class="form-control" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">M</label>
                      <div class="col-sm-4">
                        <input type="hidden" name="ukuran[]" value="M">
                        <input type="number" name="stok[]" id="stok[]" class="form-control" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">L</label>
                      <div class="col-sm-4">
                        <input type="hidden" name="ukuran[]" value="L">
                        <input type="number" name="stok[]" id="stok[]" class="form-control" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">XL</label>
                      <div class="col-sm-4">
                        <input type="hidden" name="ukuran[]" value="XL">
                        <input type="number" name="stok[]" id="stok[]" class="form-control" placeholder="Stok">
                      </div>
                    </div>
                    <hr>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">Judul / Nama Produk</label>
                      <div class="col-sm-4">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul/Nama Produk">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="brt" class="col-sm-2 control-label">Berat</label>
                      <div class="col-sm-4">
                        <input type="number" name="berat" id="brt" class="form-control" placeholder="Berat">
                        <span>*Dalam satuan gram</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-6">
                        <textarea name="deskripsi" id="des" class="form-control textarea" placeholder="Deskripsi" col="5" rows="10"></textarea>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="hrgl" class="col-sm-2 control-label">Harga Lama</label>
                        <div class="col-sm-4">
                          <input type="number" name="diskon" id="hrgl" class="form-control" placeholder="Harga">
                        </div>
                      </div> -->

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Grosir</label>
                      <div class="col-sm-4">
                        <input type="number" name="harga_grosir" id="hrg_grosir" class="form-control" placeholder="Harga Grosir">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Eceran</label>
                      <div class="col-sm-4">
                        <input type="number" name="harga_eceran" id="harga_eceran" class="form-control" placeholder="Harga Eceran">
                      </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="jns" class="col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-4">
                          <select type="text" name="jenis" id="jns" class="form-control">
                            <option value="Bekas">Bekas</option>
                            <option value="Baru">Baru</option>
                          </select>
                        </div>
                      </div> -->

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto" id="hrg" class="form-control" required>
                        <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
                        <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto Lainnya</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto1[]" id="hrg" class="form-control" multiple required>
                        <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
                        <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-4 col-md-offset-2">
                        <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                      </div>
                    </div>
                  </div>
              </form><br>
              <div class="text-right">
              <!-- <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
              <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font> -->
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php
      break;
    case "editproduk":
      if (isset($_GET['id_produk'])) {
        $id = $_GET['id_produk'];
        $sql = mysqli_query($con, "SELECT * FROM tb_produk,tb_kategori,tb_brand
                                    where tb_produk.id_kategori=tb_kategori.id_kategori 
                                    AND tb_produk.id_brand=tb_brand.id_brand 
                                    AND id_produk='$id'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {
        if ($_POST['stok'] > 0) {
          $status = "Y";
        } else {
          $status = "T";
        }
        $judulseo = seo_title($_POST['judul']);

        $allowed1 = array("image/jpg", "image/jpeg");
        $nama_foto1    = $_FILES['foto1']['name'];
        $type    = $_FILES['foto1']['type'];
        $lokasi_foto1 = $_FILES["foto1"]["tmp_name"];
        $ukuran_foto1 = $_FILES['foto1']['size'];
        $file_name1 = explode('.', $nama_foto1);
        $nama_file1 = end($file_name1);
        $file_ext1 = strtolower($nama_file1);
        $nama_file_foto1 = str_replace(" ", "-", $file_name1[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext1;
        
        foreach($nama_foto1 as $no => $cari)
        {
          if($nama_foto1[$no] != ""){
            foreach ($nama_foto1 as $i => $a) {
              if (!in_array($type[$i], $allowed1)) 
              {
                echo "<script>
                        window.alert('Gambar Tidak Valid');
                        window.location='?page=produk';
                      </script>";
                exit;
              }
            }
            foreach ($nama_foto1 as $i => $a) {
              if (!in_array($type[$i], $allowed1)) 
              {
              echo "<script>
                      window.alert('Gambar Tidak Valid');
                      window.location='?page=produk';
                    </script>";
              exit;
            } else {
              if (empty($nama_foto1[$i])) {
                $date1 = "";
              } else {
                $date1 = date("YmdHis");
              }
              $nmfoto1 = $date1 . $nama_foto1[$i];
              if (!empty($lokasi_foto1[$i])) {
                move_uploaded_file($lokasi_foto1[$i], "../img/produk_detail/$nmfoto1");
              }
              $kd_produk1 = $data['kd_produk'];
              mysqli_query($con, "INSERT INTO tb_gambar(gambar_produk, kd_produk) VALUES ('$nmfoto1', '$kd_produk1')");
              }
            }
          }
        }

          
        

        $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $nama_foto    = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES["foto"]["tmp_name"];
        $ukuran_foto = $_FILES['foto']['size'];
        $file_name = explode('.', $nama_foto);
        $nama_file = end($file_name);
        $file_ext = strtolower($nama_file);
        $nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
        
        if($ukuran_foto > 0){
          if ($ukuran_foto < 1048576) {
            if (!in_array($file_ext, $allowed)) {
              echo "<script>
                        window.alert('Gambar Produk Thumbnail Tidak Valid');
                        window.location='?page=produk';
                      </script>";
              exit;
            } else {
              if (!empty($lokasi_foto)) {
                unlink("../img/produk/" . $data['foto']);
                move_uploaded_file($lokasi_foto, "../img/produk/$nama_file_foto");
              } else {
                $nama_file_foto = $data['foto'];
              }
              // edit produk
              $save = mysqli_query($con, "UPDATE tb_produk set judul='$_POST[judul]', berat='$_POST[berat]',deskripsi='$_POST[deskripsi]', harga_grosir='$_POST[harga_grosir]',harga_eceran='$_POST[harga_eceran]', foto='$nama_file_foto', judul_seo='$judulseo', status='$status' where id_produk='$_GET[id_produk]'");
            }
          }
        }else{
          $save = mysqli_query($con, "UPDATE tb_produk set judul='$_POST[judul]', berat='$_POST[berat]',deskripsi='$_POST[deskripsi]', harga_grosir='$_POST[harga_grosir]',harga_eceran='$_POST[harga_eceran]', judul_seo='$judulseo', status='$status' where id_produk='$_GET[id_produk]'");
        }



        // edit ukuran
        // $ukuran = $_POST['ukuran'];
        $id_detail = $_POST['id_detail'];
        $stok = $_POST['stok'];
        foreach ($stok as $i => $a) {
          mysqli_query($con, "UPDATE `tb_detail_size` SET `stok`= '$stok[$i]' WHERE id_detail='$id_detail[$i]'");
        }
        // exit;
        // $nmberkas  = $_FILES["foto"]["name"];
        // $lokberkas = $_FILES["foto"]["tmp_name"];
        // if (!empty($lokberkas)) {
        //   $nmfoto = date("YmdHis") . $nmberkas;
        //   unlink("../img/produk/" . $data['foto']);
        //   move_uploaded_file($lokberkas, "../img/produk/$nmfoto");
        // } else {
        //   $nmfoto = $_POST["fotolama"];
        // }



        //penambahan gambar produk 
        // $nmberkas1  = $_FILES["foto1"]["name"];
        // $lokberkas1 = $_FILES["foto1"]["tmp_name"];
        // foreach ($nmberkas1 as $i => $a) {
        //   if (empty($nmberkas1[$i])) {
        //     $date1 = "";
        //   } else {
        //     $date1 = date("YmdHis");
        //   }
        //   $nmfoto1 = $date1 . $nmberkas1[$i];
        //   if (!empty($lokberkas1[$i])) {
        //     move_uploaded_file($lokberkas1[$i], "../img/produk_detail/$nmfoto1");
        //   }
        //   $kd_produk1 = $data['kd_produk'];
        //   mysqli_query($con, "INSERT INTO tb_gambar(gambar_produk, kd_produk) 
        //                           VALUES ('$nmfoto1', '$kd_produk1')");
        // }


        if ($save) {
          echo "<script>
                 alert('Edit Data Berhasil');
                 window.location='?page=produk';
                </script>";
        } else {
          echo "<script>alert('Gagal');
                </script>";
        }
      }
    ?>
      <section class="content-header">
        <h1>
          Produk
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Produk</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header with-border">

              </div>
              <!-- form start -->
              <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="col-sm-12">
                    <div class="form-group">

                      <label for="kdp" class="col-sm-2 control-label">Kode Produk</label>
                      <div class="col-sm-4">
                        <input type="hidden" name="id_produk" class="form-control" value="<?= $data['id_produk']; ?>" disabled>
                        <input type="text" name="kd_produk" class="form-control" value="<?= $data['kd_produk']; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nmkat" class="col-sm-2 control-label">Nama Kategori</label>
                      <div class="col-sm-4">
                        <input type="text" name="id_kategori" class="form-control" value="<?= $data['nama_kategori']; ?>" disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="nmkat" class="col-sm-2 control-label">Merek</label>
                      <div class="col-sm-4">
                        <input type="text" name="id_merek" class="form-control" value="<?= $data['nama_brand']; ?>" disabled>
                      </div>
                    </div>

                    <hr>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Ukuran</label>
                    </div>
                    <!-- buek foreach berdasarikan kd_produk -->
                    <?php
                    $data_kategori = mysqli_query($con, "SELECT * FROM tb_detail_size WHERE kd_produk = '$data[kd_produk]'");
                    // echo "SELECT * FROM tb_detail_size WHERE kd_produk = $data[kd_produk]";
                    while ($r = mysqli_fetch_array($data_kategori)) {
                    ?>

                      <div class="form-group">
                        <label for="judul" class="col-sm-2 control-label"><?php echo $r['ukuran'] ?></label>
                        <div class="col-sm-4">
                          <input type="hidden" name="id_detail[]" value="<?php echo $r['id_detail'] ?>">
                          <input type="number" name="stok[]" id="stok[]" class="form-control" value="<?php echo $r['stok'] ?>" placeholder="Stok">
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    <hr>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">Judul</label>
                      <div class="col-sm-4">
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= $data['judul']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="brt" class="col-sm-2 control-label">Berat</label>
                      <div class="col-sm-4">
                        <input type="number" name="berat" id="brt" class="form-control" value="<?= $data['berat']; ?>">
                        <span>*Dalam satuan gram</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-6">
                        <textarea name="deskripsi" id="des" class="form-control textarea" cols="5" rows="10"><?= $data['deskripsi']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Grosir</label>
                      <div class="col-sm-6">
                        <input type="number" name="harga_grosir" id="hrg" class="form-control" value="<?= $data['harga_grosir']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Eceran</label>
                      <div class="col-sm-6">
                        <input type="number" name="harga_eceran" id="hrg" class="form-control" value="<?= $data['harga_eceran']; ?>">
                      </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="nmkat" class="col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-4">
                          <input type="text" name="jenis" class="form-control" value="<? //echo  $data['jenis']; 
                                                                                      ?>" disabled>
                        </div>
                      </div> -->

                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto" id="foto" class="form-control">
                        <input type="hidden" name="fotolama" id="foto" class="form-control" value="<?= $data["foto"]; ?>">
                        <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
                        <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../img/produk/<?= $data['foto']; ?>" width="150px" height="100px">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Tambahkan Foto Lainnya</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto1[]" id="foto" value="" class="form-control" multiple>
                        <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
                        <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font>
                      </div>
                    </div>



                    <hr>

                    <div class="form-group">
                      <div class="col-sm-4 col-md-offset-2">
                        <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                      </div>
                    </div>
              </form>
              <hr>
              <h5><b>Perbarui/hapus foto lama</b></h5>
              <!-- looping tb_gambarberdasrkankd_produk -->
              <?php
              $data_kategori = mysqli_query($con, "SELECT tb_gambar.*, tb_produk.id_produk FROM tb_gambar JOIN tb_produk ON tb_gambar.kd_produk = tb_produk.kd_produk WHERE tb_produk.id_produk = '$_GET[id_produk]'");
              while ($r = mysqli_fetch_array($data_kategori)) {
              ?>
                <form method="POST" action="CRUD/modul_produk/aksi_edit_foto_produk.php?id_gambar=<?php echo $r['id_gambar'] ?>&id_produk=<?php echo $r['id_produk'] ?>" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="foto" class="col-sm-2 control-label">Foto Lainnya</label>
                    <div class="col-sm-4">
                      <input type="file" name="fotoupdate1" id="foto" class="form-control">
                      <input type="hidden" name="fotolama1" id="foto" class="form-control" value="<?= $data["gambar_produk"]; ?>">
                      <font color="red">*<span>Ukuran Foto Maximal 1 MB dan Format JPG/JPEG</span></font>
                      <font color="red">**<span>Ukuran foto sebaiknya 700px * 700px</span></font>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-4">
                      <img src="../img/produk_detail/<?= $r['gambar_produk']; ?>" width="150px" height="100px">
                      <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                      <a href="?page=produk&aksi=hapusgambar&id_gambar=<?php echo $r['id_gambar'] ?>&id_produk=<?php echo $r['id_produk'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>

                  </div>

                </form>
              <?php }  ?>

            </div>
          </div>
        </div>
        </div>
        </div>
      </section>
    <?php
      break;
    case "hapusproduk":

      if (isset($_GET['id_produk'])) {
        $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_produk where id_produk='$_GET[id_produk]'"));

        $data_ukuran = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_detail_size where kd_produk='$lihat[kd_produk]'"));

        $data_gambar = mysqli_query($con, "SELECT gambar_produk FROM tb_gambar where kd_produk='$lihat[kd_produk]'");

        while ($row = mysqli_fetch_array($data_gambar)) {
          $gambar_produk = $row['gambar_produk'];
          // var_dump($gambar_produk);
          unlink("../img/produk_detail/" . $gambar_produk);
        }
        unlink("../img/produk/" . $lihat['foto']);

        mysqli_query($con, "DELETE FROM tb_gambar where kd_produk= '$lihat[kd_produk]' ");
        mysqli_query($con, "DELETE FROM tb_detail_size where kd_produk='$lihat[kd_produk]'");
        $del = mysqli_query($con, "DELETE FROM tb_produk where id_produk='$_GET[id_produk]'");
        // var_dump($del);
        // exit;
        if ($del) {
          echo "<script>
                   alert('Data Berhasil Dihapus');
      					   window.location='index.php?page=produk';
      				  </script>";
        } else {
          echo "<script>
                  alert('Data Gagal Dihapus');
                  window.location='index.php?page=produk';
                </script>";
        }
      }
    ?>
    <?php
      break;
    case "detailproduk":
      if (isset($_GET['id_produk'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_produk,tb_kategori,tb_brand
        where tb_produk.id_kategori=tb_kategori.id_kategori AND tb_produk.id_brand=tb_brand.id_brand AND id_produk='$_GET[id_produk]'");
        $data = mysqli_fetch_assoc($sql);
        $kat = $data['nama_kategori'] . " - " . $data['nama_merek'];
        $penulis = $data['penulis'];
        $harga = "Rp. " . number_format($data['harga'], '0', '.', ',');
        $desk = $data['deskripsi'];
      }
    ?>
      <section class="content-header">
        <h1>
          Produk
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Detail Produk</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header with-border">

              </div>
              <div class="box-body">
                <div class="col-sm-6">
                  <img src="../img/produk/<?= $data['foto'] ?>" alt="" class="img-responsive">
                </div>
                <div class="col-sm-6">
                  <h4><small><?= $kat ?></small></h4>
                  <h3><?= $data['judul'] ?></h3>
                  <small style="font-size: 15px; color: rgb(88, 116, 112);"><?= $penulis ?></small>
                  <h3><?= $harga ?></h3>
                </div>

                <div class="col-sm-12" style="margin-top: 50px;">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#first" aria-controls="first" role="tab" data-toggle="tab"><b>Deskripsi</b></a></li>
                    <?php if ($data['id_kategori'] == 1) { ?>
                      <li role="presentation"><a href="#dua" aria-controls="second" role="tab" data-toggle="tab"><b>Detail</b></a></li>
                    <?php } ?>
                  </ul>

                  <!-- Tab 1 -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="first">
                      <div class="col-sm-12">
                        <br><br>
                        <?= $desk ?>
                        <br><br>
                      </div>
                    </div>

                    <!-- Tab 2 -->
                    <?php if ($data['id_kategori'] == 1) { ?>
                      <div role="tabpanel" class="tab-pane" id="dua">
                        <div class="col-sm-12">
                          <br><br>
                          Berat : <?= $data['berat'] ?> <br>
                          Stok : <?= $data['stok'] ?> <br>
                          <br><br>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php
      break;
    case "hapusgambar":
      if (isset($_GET['id_gambar'])) {
        $sql = mysqli_query($con, "SELECT * FROM tb_gambar
          where id_gambar='$_GET[id_gambar]'");
        $rr = mysqli_fetch_assoc($sql);

        // $nmberkas  = $_FILES["foto"]["name"];
        // $lokberkas = $_FILES["foto"]["tmp_name"];
        // if (!empty($lokberkas)) {
        //   $nmfoto = date("YmdHis") . $nmberkas;
        //   move_uploaded_file($lokberkas, "../img/produk_detail/$nmfoto");
        // } else {
        //   $nmfoto = $_POST["fotolama"];
        // }
        unlink("../img/produk_detail/" . $rr['gambar_produk']);

        $del = mysqli_query($con, "DELETE FROM tb_gambar where id_gambar='$_GET[id_gambar]'");
        if ($del) {
          echo "<script>
            alert('Data Berhasil Dihapus');
      			window.location='index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
      				  </script>";
        }
        // $kat = $data['nama_kategori'] . " - " . $data['nama_merek'];
        // $penulis = $data['penulis'];
        // $harga = "Rp. " . number_format($data['harga'], '0', '.', ',');
        // $desk = $data['deskripsi'];
      }
      break;
  }
} else {
  ?>

  <section class="content-header">
    <h1>
      Produk
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produk</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <a href="?page=produk&aksi=tambahproduk" class="btn btn-flat btn-primary">Tambah Produk</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Judul</th>
                    <th>Harga Eceran</th>
                    <th>Harga Grosir</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $q = mysqli_query($con, "SELECT * from tb_produk,tb_kategori,tb_brand where
						      tb_produk.id_kategori=tb_kategori.id_kategori AND tb_produk.id_brand=tb_brand.id_brand");
                  $no = 1;
                  while ($r = mysqli_fetch_array($q)) {
                    if ($r['status'] == "Y") {
                      $status = "<i class='glyphicon glyphicon-ok' style='color: #37c779;'></i>";
                    } else {
                      $status = "<i class='glyphicon glyphicon-remove' style='color: #d5280a;'></i>";
                    }
                  ?>

                    <tr>
                      <td width='0' class='center'><?php echo $no; ?></td>
                      <td><?php echo  $r["kd_produk"]; ?></td>
                      <td><?php echo  $r["nama_kategori"]; ?></td>
                      <td><?php echo  $r["nama_brand"]; ?></td>
                      <td><?php echo  $r["judul"]; ?></td>
                      <td><?php echo  "Rp. " . number_format($r["harga_eceran"]); ?></td>
                      <td><?php echo  "Rp. " . number_format($r["harga_grosir"]); ?></td>
                      <td><?php echo  $status ?></td>
                      <td><img src="../img/produk/<?= $r['foto']; ?>" width="150px"></td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Edit Produk' href='?page=produk&aksi=editproduk&id_produk=<?php echo $r['id_produk']; ?>' onclick="return confirm('ANDA YAKIN AKAN EDIT DATA INI ... ?')"><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Hapus Produk' href='?page=produk&aksi=hapusproduk&id_produk=<?php echo $r['id_produk']; ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><span class='glyphicon glyphicon-remove'></span></a>
                        <a class='btn btn-danger btn-xs' title='Detail Produk' href='?page=produk&aksi=detailproduk&id_produk=<?php echo $r['id_produk']; ?>'><span class='glyphicon glyphicon-zoom-in'></span></a>
                      </td>
                    </tr>
                  <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
  </section>

<?php } ?>