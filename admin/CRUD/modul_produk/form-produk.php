<script type="text/javascript" src="jquery.js"></script>
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
        if ($_POST['stok'] > 0) {
          $status = "Y";
        } else {
          $status = "T";
        }
        // simpan ukuran
        $no = 0;
        $ukuran = $_POST['ukuran'];
        foreach($ukuran as $a)
        {
          $ukurans[] = $a[$no];
        }
        $no++;
        
        $hasil_ukuran = implode(',', $ukurans);
        // batas simpan ukuran
        $judulseo = seo_title($_POST['judul']);
        $tglskrg = date('Y-m-d');
        $nmberkas  = $_FILES["foto"]["name"];
        $lokberkas = $_FILES["foto"]["tmp_name"];
        $size     = $_FILES['foto']['size'];
        if (empty($nmberkas)) {
          $date = "";
        } else {
          $date = date("YmdHis");
        }
        $nmfoto = $date . $nmberkas;
        if ($size < 1048576) {
          if (!empty($lokberkas)) {
            move_uploaded_file($lokberkas, "../foto/produk/$nmfoto");
          }
          $nmberkas1  = $_FILES["foto1"]["name"];
          $lokberkas1 = $_FILES["foto1"]["tmp_name"];
          if (empty($nmberkas1)) {
            $date1 = "";
          } else {
            $date1 = date("YmdHis");
          }
          $nmfoto1 = $date1 . $nmberkas1;
          if (!empty($lokberkas1)) {
            move_uploaded_file($lokberkas1, "../foto/produk/$nmfoto1");
          }
          $nmberkas2  = $_FILES["foto2"]["name"];
          $lokberkas2 = $_FILES["foto2"]["tmp_name"];
          if (empty($nmberkas2)) {
            $date2 = "";
          } else {
            $date2 = date("YmdHis");
          }
          $nmfoto2 = $date2 . $nmberkas2;
          if (!empty($lokberkas2)) {
            move_uploaded_file($lokberkas2, "../foto/produk/$nmfoto2");
          }
          $nmberkas3  = $_FILES["foto3"]["name"];
          $lokberkas3 = $_FILES["foto3"]["tmp_name"];
          if (empty($nmberkas3)) {
            $date3 = "";
          } else {
            $date3 = date("YmdHis");
          }
          $nmfoto3 = $date3 . $nmberkas3;
          if (!empty($lokberkas3)) {
            move_uploaded_file($lokberkas3, "../foto/produk/$nmfoto3");
          }
          $nmberkas4  = $_FILES["foto4"]["name"];
          $lokberkas4 = $_FILES["foto4"]["tmp_name"];
          if (empty($nmberkas4)) {
            $date4 = "";
          } else {
            $date4 = date("YmdHis");
          }
          $nmfoto4 = $date4 . $nmberkas4;
          if (!empty($lokberkas4)) {
            move_uploaded_file($lokberkas4, "../foto/produk/$nmfoto4");
          }
          $cek = mysqli_query($con, "select * from tbl_produk where kd_produk='$_POST[kd_produk]'");
          $jumlah = mysqli_num_rows($cek);
          if ($jumlah) {
            echo "<script>alert('Maaf, Kode sudah ada, silahkan masukan kode yang lain !');window.location.href='index.php?page=produk&aksi=tambahproduk'</script>";
          } else {
            if (empty($_POST["harga_lama"])) {
             $save = mysqli_query($con, "INSERT INTO `tbl_produk`(
             `kd_produk`, 
             `id_kategori`, 
             `id_merek`, 
             `ukuran`, 
             `judul`, 
             `berat`, 
             `deskripsi`, 
             `harga`, 
             `harga_grosir`, 
             `foto`, 
             `foto1`, 
             `foto2`, 
             `foto3`, 
             `foto4`, 
             `status`, 
             `jenis`, 
             `stok`, 
             `judul_seo`, 
             `tglinput`) VALUES
              
                ('$_POST[kd_produk]',
                '$_POST[id_kategori]',
                '$_POST[id_merek]',
                '$hasil_ukuran',
                '$_POST[judul]',
	              '$_POST[berat]',
                '$_POST[deskripsi]',
                '$_POST[harga]',
                '$_POST[harga_grosir]',
                '$nmfoto',
                '$nmfoto1',
                '$nmfoto2',
                '$nmfoto3',
                '$nmfoto4',
                '$status',
                'Baru',
	              '$_POST[stok]',
                '$judulseo',
                '$tglskrg')");
            } else {
              $save = mysqli_query($con, "INSERT INTO `tbl_produk`(
             `kd_produk`, 
             `id_kategori`, 
             `id_merek`, 
             `ukuran`, 
             `judul`, 
             `berat`, 
             `deskripsi`, 
             `harga_lama`, 
             `harga`, 
             `harga_grosir`, 
             `foto`, 
             `foto1`, 
             `foto2`, 
             `foto3`, 
             `foto4`, 
             `status`, 
             `jenis`, 
             `stok`,
             `judul_seo`, 
             `tglinput`) VALUES
              ( 
                '$_POST[kd_produk]',
                '$_POST[id_kategori]',
                '$_POST[id_merek]',
                '$hasil_ukuran',
                '$_POST[judul]',
	              '$_POST[berat]',
                '$_POST[deskripsi]',
                '$_POST[harga_lama]',
                '$_POST[harga]',
                '$_POST[harga_grosir]',
                '$nmfoto',
                '$nmfoto1',
                '$nmfoto2',
                '$nmfoto3',
                '$nmfoto4',
                '$status',
                'Baru',
	            '$_POST[stok]',
                '$judulseo',
                '$tglskrg')");
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
        } else {
          echo  "<script>
                alert('Maksimal Upload Foto 1 MB');
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
                          $result = mysqli_query($con, "select * from tbl_kategori");
                          $jsArray = "var dtind = new Array();\n";
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nmkat" class="col-sm-2 control-label">Merek</label>
                      <div class="col-sm-4">
                        <select type="text" name="id_merek" class="form-control" id="subkat">
                          <option value="">--Pilih Merek--</option>
                          <?php
                          $result = mysqli_query($con, "select * from tbl_merek");
                          $jsArray = "var dtind = new Array();\n";
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id_merek'] . '">' . $row['nama_merek'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="ukuran" class="col-sm-2 control-label">Ukuran</label>
                      <div class="col-sm-4">
                        <input type="checkbox" name="ukuran[]" value="S" id="ukuran">&nbsp;&nbsp;&nbsp; S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="M" id="ukuran">&nbsp;&nbsp;&nbsp; M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="L" id="ukuran">&nbsp;&nbsp;&nbsp; L&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="XL" id="ukuran">&nbsp;&nbsp;&nbsp; XL
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">Judul / Nama Produk</label>
                      <div class="col-sm-4">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul/Nama Produk">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="brt" class="col-sm-2 control-label">Berat</label>
                      <div class="col-sm-4">
                        <input type="text" name="berat" id="brt" class="form-control" placeholder="Berat">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-6">
                        <textarea name="deskripsi" id="des" class="form-control textarea" placeholder="Deskripsi" col="5" rows="10"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrgl" class="col-sm-2 control-label">Harga Lama</label>
                      <div class="col-sm-4">
                        <input type="number" name="harga_lama" id="hrgl" class="form-control" placeholder="Harga">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Grosir</label>
                      <div class="col-sm-4">
                        <input type="number" name="harga_grosir" id="hrg_grosir" class="form-control" placeholder="Harga Grosir">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Harga Eceran</label>
                      <div class="col-sm-4">
                        <input type="number" name="harga" id="hrg_eceran" class="form-control" placeholder="Harga Eceran">
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
                      <label for="stok" class="col-sm-2 control-label">Stok</label>
                      <div class="col-sm-4">
                        <input type="text" name="stok" id="stok" class="form-control" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto" id="hrg" class="form-control">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto 1</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto1" id="hrg" class="form-control">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto 2</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto2" id="hrg" class="form-control">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto 3</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto3" id="hrg" class="form-control">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">Foto 4</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto4" id="hrg" class="form-control">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
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
                <font color="red">**</font> <span></span>Ukuran Foto di Atas 2MB tidak tersimpan ke tempat penyimpanan</span>
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php
      break;
    case "editproduk":
      if (isset($_GET['id_produk'])) {
        $sql = mysqli_query($con, "SELECT * FROM tbl_produk,tbl_kategori,tbl_merek
 where tbl_produk.id_kategori=tbl_kategori.id_kategori AND tbl_produk.id_merek=tbl_merek.id_merek AND id_produk='$_GET[id_produk]'");
        $data = mysqli_fetch_assoc($sql);
      }
      if (isset($_POST['save'])) {
        if ($_POST['stok'] > 0) {
          $status = "Y";
        } else {
          $status = "T";
        }

        // simpan ukuran
        $no = 0;
        $ukuran = $_POST['ukuran'];
        foreach($ukuran as $a)
        {
          $ukurans[] = $a[$no];
        }
        $no++;
        
        $hasil_ukuran = implode(',', $ukurans);
        // batas simpan ukuran
        $judulseo = seo_title($_POST['judul']);
        $nmberkas  = $_FILES["foto"]["name"];
        $lokberkas = $_FILES["foto"]["tmp_name"];
        if (!empty($lokberkas)) {
          $nmfoto = date("YmdHis") . $nmberkas;
          move_uploaded_file($lokberkas, "../foto/produk/$nmfoto");
        } else {
          $nmfoto = $_POST["fotolama"];
        }

        $nmberkas1  = $_FILES["foto1"]["name"];
        $lokberkas1 = $_FILES["foto1"]["tmp_name"];
        if (!empty($lokberkas1)) {
          $nmfoto1 = date("YmdHis") . $nmberkas;
          move_uploaded_file($lokberkas1, "../foto/produk/$nmfoto1");
          unlink("../foto/produk/" . $lihat['foto1']);
        } else {
          $nmfoto1 = $_POST["fotolama1"];
        }

        $nmberkas2  = $_FILES["foto2"]["name"];
        $lokberkas2 = $_FILES["foto2"]["tmp_name"];
        if (!empty($lokberkas2)) {
          $nmfoto2 = date("YmdHis") . $nmberkas2;
          move_uploaded_file($lokberkas2, "../foto/produk/$nmfoto2");
          unlink("../foto/produk/" . $lihat['foto2']);
        } else {
          $nmfoto2 = $_POST["fotolama2"];
        }

        $nmberkas3  = $_FILES["foto3"]["name"];
        $lokberkas3 = $_FILES["foto3"]["tmp_name"];
        if (!empty($lokberkas3)) {
          $nmfoto3 = date("YmdHis") . $nmberkas3;
          move_uploaded_file($lokberkas3, "../foto/produk/$nmfoto3");
          unlink("../foto/produk/" . $lihat['foto3']);
        } else {
          $nmfoto3 = $_POST["fotolama3"];
        }

        $nmberkas4  = $_FILES["foto4"]["name"];
        $lokberkas4 = $_FILES["foto4"]["tmp_name"];
        if (!empty($lokberkas4)) {
          $nmfoto4 = date("YmdHis") . $nmberkas4;
          move_uploaded_file($lokberkas4, "../foto/produk/$nmfoto4");
          unlink("../foto/produk/" . $lihat['foto4']);
        } else {
          $nmfoto4 = $_POST["fotolama4"];
        }



        $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_produk where id_produk='$_GET[id_produk]'"));
        $kd_produk = $lihat["kd_produk"];
        if($ukuran == NULL)
        {
          $save = mysqli_query($con, "UPDATE tbl_produk set judul='$_POST[judul]', berat='$_POST[berat]',deskripsi='$_POST[deskripsi]',harga_lama='$_POST[harga_lama]',
    harga='$_POST[harga]', harga_grosir='$_POST[harga_grosir]', stok='$_POST[stok]', foto='$nmfoto', foto1='$nmfoto1',foto2='$nmfoto2',foto3='$nmfoto3',foto4='$nmfoto4', judul_seo='$judulseo', status='$status' where id_produk='$_GET[id_produk]'");

        mysqli_query($con, "UPDATE tb_barang set nama_barang='$_POST[judul]', harga_jual='$_POST[harga]' where kode_barang='$kd_produk'");  
        }else{
          $save = mysqli_query($con, "UPDATE tbl_produk set ukuran='$hasil_ukuran', judul='$_POST[judul]', berat='$_POST[berat]',deskripsi='$_POST[deskripsi]',harga_lama='$_POST[harga_lama]',
    harga='$_POST[harga]', harga_grosir='$_POST[harga_grosir]', stok='$_POST[stok]', foto='$nmfoto', foto1='$nmfoto1',foto2='$nmfoto2',foto3='$nmfoto3',foto4='$nmfoto4', judul_seo='$judulseo', status='$status' where id_produk='$_GET[id_produk]'");

        mysqli_query($con, "UPDATE tb_barang set nama_barang='$_POST[judul]', harga_jual='$_POST[harga]' where kode_barang='$kd_produk'");
        }
        


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
                        <input type="text" name="id_merek" class="form-control" value="<?= $data['nama_merek']; ?>" disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="ukuran" class="col-sm-2 control-label">Ukuran</label>
                      <div class="col-sm-4">
                        <input type="checkbox" name="ukuran[]" value="S" id="ukuran">&nbsp;&nbsp;&nbsp; S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="M" id="ukuran">&nbsp;&nbsp;&nbsp; M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="L" id="ukuran">&nbsp;&nbsp;&nbsp; L&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ukuran[]" value="XL" id="ukuran">&nbsp;&nbsp;&nbsp; XL
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="judul" class="col-sm-2 control-label">Judul</label>
                      <div class="col-sm-4">
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= $data['judul']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="brt" class="col-sm-2 control-label">Berat</label>
                      <div class="col-sm-4">
                        <input type="text" name="berat" id="brt" class="form-control" value="<?= $data['berat']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-6">
                        <textarea name="deskripsi" id="des" class="form-control textarea" cols="5" rows="10"><?= $data['deskripsi']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hrgl" class="col-sm-2 control-label">Harga Lama</label>
                      <div class="col-sm-6">
                        <input type="number" name="harga_lama" id="hrgl" class="form-control" value="<?= $data['harga_lama']; ?>">
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
                        <input type="number" name="harga" id="hrg" class="form-control" value="<?= $data['harga']; ?>">
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
                      <label for="stok" class="col-sm-2 control-label">Stok</label>
                      <div class="col-sm-6">
                        <input type="text" name="stok" id="stok" class="form-control" value="<?= $data['stok']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto" id="foto" class="form-control">
                        <input type="hidden" name="fotolama" id="foto" class="form-control" value="<?= $data["foto"]; ?>">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../foto/produk/<?= $data['foto']; ?>" width="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto1</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto1" id="foto" class="form-control">
                        <input type="hidden" name="fotolama1" id="foto" class="form-control" value="<?= $data["foto1"]; ?>">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../foto/produk/<?= $data['foto1']; ?>" width="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto2</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto2" id="foto" class="form-control">
                        <input type="hidden" name="fotolama2" id="foto" class="form-control" value="<?= $data["foto2"]; ?>">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../foto/produk/<?= $data['foto2']; ?>" width="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto3</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto3" id="foto" class="form-control">
                        <input type="hidden" name="fotolama3" id="foto" class="form-control" value="<?= $data["foto3"]; ?>">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../foto/produk/<?= $data['foto3']; ?>" width="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="foto" class="col-sm-2 control-label">Foto4</label>
                      <div class="col-sm-4">
                        <input type="file" name="foto4" id="foto" class="form-control">
                        <input type="hidden" name="fotolama4" id="foto" class="form-control" value="<?= $data["foto4"]; ?>">
                        <font color="red">*</font> <span></span>Ukuran Foto Maximal 1 MB</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hrg" class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-4">
                        <img src="../foto/produk/<?= $data['foto4']; ?>" width="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-4 col-md-offset-2">
                        <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    <?php
      break;
    case "hapusproduk":

      if (isset($_GET['id_produk'])) {
        $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_produk where id_produk='$_GET[id_produk]'"));

        unlink("../foto/produk/" . $lihat['foto']);
        unlink("../foto/produk/" . $lihat['foto1']);
        unlink("../foto/produk/" . $lihat['foto2']);
        unlink("../foto/produk/" . $lihat['foto3']);
        unlink("../foto/produk/" . $lihat['foto4']);
        $del = mysqli_query($con, "DELETE FROM tbl_produk where id_produk='$_GET[id_produk]'");
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
        $sql = mysqli_query($con, "SELECT * FROM tbl_produk,tbl_kategori,tbl_merek
      where tbl_produk.id_kategori=tbl_kategori.id_kategori AND tbl_produk.id_merek=tbl_merek.id_merek AND id_produk='$_GET[id_produk]'");
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
                  <img src="../foto/produk/<?= $data['foto'] ?>" alt="" class="img-responsive">
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
                    <th>Ukuran</th>
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
                  $q = mysqli_query($con, "SELECT * from tbl_produk,tbl_kategori,tbl_merek where
						tbl_produk.id_kategori=tbl_kategori.id_kategori AND tbl_produk.id_merek=tbl_merek.id_merek");
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
                      <td><?php echo  $r["nama_merek"]; ?></td>
                      <td><?php echo  $r["ukuran"]; ?></td>
                      <td><?php echo  $r["judul"]; ?></td>
                      <td><?php echo  "Rp. " . number_format($r["harga"]); ?></td>
                      <td><?php echo  "Rp. " . number_format($r["harga_grosir"]); ?></td>

                      <td><?php echo  $status ?></td>
                      <td><img src="../foto/produk/<?= $r['foto']; ?>" width="150px"></td>
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
                  </tfoot>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>
<?php } ?>