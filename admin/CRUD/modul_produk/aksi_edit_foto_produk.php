<?php
include "../../../config/koneksi.php";
$sql = mysqli_query($con, "SELECT * FROM tb_gambar where id_gambar='$_GET[id_gambar]'");
$rr = mysqli_fetch_assoc($sql);
//   echo "../../../img/produk_detail/" . $rr['gambar_produk'];

// $nmberkas  = $_FILES["fotoupdate1"]["name"];
// $lokberkas = $_FILES["fotoupdate1"]["tmp_name"];
// $ukuran = $_FILES["fotoupdate1"]["size"];
//   var_dump($_FILES);
//   // var_dump($nmberkas);
//   exit;

$allowed = array('jpg', 'jpeg', 'JPG', 'JPEG');
$nama_foto    = $_FILES['fotoupdate1']['name'];
$lokasi_foto = $_FILES["fotoupdate1"]["tmp_name"];
$ukuran_foto = $_FILES['fotoupdate1']['size'];
$file_name = explode('.', $nama_foto);
$nama_file = end($file_name);
$file_ext = strtolower($nama_file);
$nama_file_foto = str_replace(" ", "-", $file_name[0]) . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
if ($ukuran_foto < 1048576) {
  if (!in_array($file_ext, $allowed)) {
    echo "<script>
                      window.alert('Gambar Produk Tidak Valid');
                      window.location='" . $base_url . "admin/index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
                    </script>";
    exit;
  } else {
    // if (!empty($lokasi_foto)) {
    //   unlink("../img/produk/" . $data['foto']);
    //   move_uploaded_file($lokasi_foto, "../img/produk/$nama_file_foto");
    // } else {
    //   $nama_file_foto = $_POST["fotolama"];
    // }
    if ($ukuran_foto != 0) {
      if (!empty($lokasi_foto)) {
        // $nmfoto = date("YmdHis") . $nama_file_foto;
        unlink("../../../img/produk_detail/" . $rr['gambar_produk']);
        move_uploaded_file($lokasi_foto, "../../../img/produk_detail/$nama_file_foto");
      } else {
        $nama_file_foto = $_POST["fotolama1"];
      }
      $upd = mysqli_query($con, "UPDATE tb_gambar SET gambar_produk='$nama_file_foto' where id_gambar='$_GET[id_gambar]'");
      if ($upd) {
        echo "<script>
                  alert('Data Berhasil Diedit');
                  window.location='" . $base_url . "admin/index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
                      </script>";
      } else {
        echo "<script>
                  alert('Data Gambar Belum Di Masukkan');
                  window.location='" . $base_url . "admin/index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
                      </script>";
      }
    }
  }
}



// if ($ukuran != 0) {
//   if (!empty($lokberkas)) {
//     $nmfoto = date("YmdHis") . $nmberkas;
//     unlink("../../../img/produk_detail/" . $rr['gambar_produk']);
//     move_uploaded_file($lokberkas, "../../../img/produk_detail/$nmfoto");
//   } else {
//     $nmfoto = $_POST["fotolama1"];
//   }
//   $upd = mysqli_query($con, "UPDATE tb_gambar SET gambar_produk='$nmfoto' where id_gambar='$_GET[id_gambar]'");
//   if ($upd) {
//     echo "<script>
//               alert('Data Berhasil Diedit');
//               window.location='" . $base_url . "admin/index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
//                   </script>";
//   }
// } else {
//   echo "<script>
//               alert('Data Gambar Belum Di Masukkan');
//               window.location='" . $base_url . "admin/index.php?page=produk&aksi=editproduk&id_produk=" . $_GET['id_produk'] . "';
//                   </script>";
// }

          // $kat = $data['nama_kategori'] . " - " . $data['nama_merek'];
          // $penulis = $data['penulis'];
          // $harga = "Rp. " . number_format($data['harga'], '0', '.', ',');
          // $desk = $data['deskripsi'];
