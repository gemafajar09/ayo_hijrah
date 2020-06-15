<?php
        include "../../../config/koneksi.php";
          $sql = mysqli_query($con, "SELECT * FROM tb_gambar where id_gambar='$_GET[id_gambar]'");
          $rr = mysqli_fetch_assoc($sql);
        //   echo "../../../img/produk_detail/" . $rr['gambar_produk'];
          
          $nmberkas  = $_FILES["fotoupdate1"]["name"];
          $lokberkas = $_FILES["fotoupdate1"]["tmp_name"];
          $ukuran = $_FILES["fotoupdate1"]["size"];
        //   var_dump($_FILES);
        //   // var_dump($nmberkas);
        //   exit;
          if ($ukuran != 0) {
            if (!empty($lokberkas)) {
              $nmfoto = date("YmdHis") . $nmberkas;
              unlink("../../../img/produk_detail/" . $rr['gambar_produk']);
              move_uploaded_file($lokberkas, "../../../img/produk_detail/$nmfoto");
            } else {
              $nmfoto = $_POST["fotolama1"];
            }
            $upd= mysqli_query($con, "UPDATE tb_gambar SET gambar_produk='$nmfoto' where id_gambar='$_GET[id_gambar]'");
            if ($upd) {
              echo "<script>
              alert('Data Berhasil Diedit');
              window.location='".$base_url."admin/index.php?page=produk&aksi=editproduk&id_produk=".$_GET['id_produk']."';
                  </script>";

            }
          }else{
            echo "<script>
              alert('Data Gambar Belum Di Masukkan');
              window.location='".$base_url."admin/index.php?page=produk&aksi=editproduk&id_produk=".$_GET['id_produk']."';
                  </script>";
          }

          // $kat = $data['nama_kategori'] . " - " . $data['nama_merek'];
          // $penulis = $data['penulis'];
          // $harga = "Rp. " . number_format($data['harga'], '0', '.', ',');
          // $desk = $data['deskripsi'];
        