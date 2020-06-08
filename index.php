<?php
session_start();
include "config/koneksi.php";
include "config/fungsi_seo.php";
include "config/fungsi_indotgl.php";


// kode untuk mengambil pengaturan website
$sql_pengaturan = mysqli_query($con, "SELECT * FROM tb_pengaturan");
while ($pengaturan = mysqli_fetch_assoc($sql_pengaturan)) {
  $_SESSION['pengaturan'][$pengaturan['nama_pengaturan']] = $pengaturan['nilai'];
}

// cek apakah waktu maintenis sudah selesai
if ($_SESSION['pengaturan']['mode_maintenance'] == "1") {
  $waktu_sekarang = strtotime(date("Y-m-d H:i:s"));
  $waktu_mulai = strtotime($_SESSION['pengaturan']['tgl_mulai_maintenance']);
  $waktu_selesai = strtotime($_SESSION['pengaturan']['tgl_akhir_maintenance']);
  if ($waktu_sekarang > $waktu_selesai) {
    // kalau waktu sekarang sudah melewati waktu maintenis, maka ubah mode maintenis jadi 0
    mysqli_query($con, "UPDATE tb_pengaturan SET nilai = '0' WHERE nama_pengaturan = 'mode_maintenance'");
    $_SESSION['pengaturan']['mode_maintenance'] = "0";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.rokaux.com/unishop/v2.2/template-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Apr 2018 05:47:23 GMT -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Ayo Hijrah</title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="RAFIKA STORES">
  <meta name="keywords" content="The Beauty Of Indonesian On Your Daily Wear">
  <meta name="author" content="RaikaStores">
  <!-- Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- Favicon and Apple Icons-->
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="foto/logo.png">
  <link rel="icon" type="image/png" href="foto/logo.png">
  <link rel="apple-touch-icon" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="152x152" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="167x167" href="rafika.ico"> -->
  <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
  <link rel="stylesheet" media="screen" href="css/vendor.min.css">
  <!-- Main Template Styles-->
  <link id="mainStyles" rel="stylesheet" media="screen" href="css/styles.min.css">
  <link id="mainStyles" rel="stylesheet" media="screen" href="css/stylesfaq.css">
  <!-- Customizer Styles-->
  <link rel="stylesheet" media="screen" href="customizer/customizer.min.css">
  <style>
    .col-md-3 {
      display: inline-block;

      margin-left: -4px;
    }

    .col-md-3 img {
      width: 100%;
      height: auto;

    }

    body .carousel-indicators li {
      background-color: red;
    }

    body .carousel-control-prev-icon,
    body .carousel-control-next-icon {
      background-color: red;
    }

    body .no-padding {
      padding-left: 0;
      padding-right: 0;
    }
  </style>
  <!-- Google Tag Manager-->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-T4DJFPZ');
  </script>
  <!-- Modernizr-->
  <script src="js/modernizr.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAACWdZfvsxk4RffdTsNZ5vXdi4Y8onJ1I" type="text/javascript"></script>
</head>
<!-- Body-->

<body>

  <!-- Google Tag Manager (noscript)-->
  <noscript>
    <iframe src="http://www.googletagmanager.com/ns.html?id=GTM-T4DJFPZ" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
  </noscript>
  <!-- Template Customizer-->
  <div class="customizer-backdrop"></div>
  <div class="customizer">
    <div class="customizer-body"><a class="btn btn-white btn-rounded btn-block mb-4 mt-0" href="http://themes.rokaux.com/unishop/v2.2/template-2/index.html">Switch To Template 2</a>
      <div class="customizer-title">Choose color</div>
      <div class="customizer-color-switch"><a class="active" href="#" data-color="default" style="background-color: #0da9ef;"></a><a href="#" data-color="2ecc71" style="background-color: #2ecc71;"></a><a href="#" data-color="f39c12" style="background-color: #f39c12;"></a><a href="#" data-color="e74c3c" style="background-color: #e74c3c;"></a></div>
      <div class="customizer-title">Header option</div>
      <div class="form-group">
        <select class="form-control form-control-rounded input-light" id="header-option">
          <option value="sticky">Sticky</option>
          <option value="static">Static</option>
        </select>
      </div>
      <div class="customizer-title">Footer option</div>
      <div class="form-group">
        <select class="form-control form-control-rounded input-light" id="footer-option">
          <option value="dark">Dark</option>
          <option value="light">Light</option>
        </select>
      </div><a class="btn btn-primary btn-rounded btn-block margin-bottom-none" href="https://wrapbootstrap.com/theme/unishop-universal-e-commerce-template-WB0148688/?ref=rokaux">Buy Unishop</a>
    </div>
  </div>
  <!-- Off-Canvas Category Menu-->
  <?php include "menu.php"; ?>
  </header>
  <!-- Off-Canvas Wrapper-->
  <div style="background-color: #F2E9D8" class="offcanvas-wrapper">
    <!-- Page Content-->
    <!-- Main Slider-->
<?php
    // cek mode maintenis
    if ($_SESSION['pengaturan']['mode_maintenance'] == "1") {
    ?>
      <center>

        <div style="font-size: 100px; color: red; font-family: fantasy " id='timer'>Ayo Hijrah</div>
      </center>
    <?php
    }

    ?>


    <?php include "content.php"; ?>

    <!-- Services-->

    <!-- Site Footer-->
    <footer class="site-footer" style="background: 	#f7efd2">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <!-- Contact Info-->
            <section class="widget widget-light-skin">
              <h3 class="widget-title" style="color: black">Contact Information</h3>
              <p class="" style="color: black">
                <h5>Alamat : Jl. Bandar Purus No.45, Padang Pasir, Kec. Padang Barat., Kota Padang, Sumatera Barat</h5>
              </p>
              <ul class="list-unstyled text-sm text-white">
                <table>
                  <tr>
                    <td colspan=2 style="color: black">
                      <h5>Customer Service</h5>
                    </td>
                  </tr>
                  <tr>
                    <td style="color: black">
                      <h5>Chat Only</h5>
                    </td>
                    <td style="color: black">
                      <h5>: 0811-665-273</h5>
                    </td>
                  </tr>
                </table>
              </ul>
            </section>
            <p style="color: black">
               <h5>Claim / Reject / Refund (Retur) : <br> <br>
                Admin 1 : 0822-8384-8752 <br>
                Admin 2 : 0813-7276-0284</h5>
              </<p>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- About Us-->
            <section class="widget widget-links widget-light-skin">
              <h3 class="widget-title" style="color: black">Navigation</h3>
              <ul>
                <li><a style="color: black" href="./">Home</a></li>
                <li><a style="color: black" href="shop">Shop</a></li>
                <li><a style="color: black" href="about">About</a></li>
                <li><a style="color: black" href="testimonial">Testimonial</a></li>
                <li><a style="color: black" href="cara-beli">Cara Belanja</a></li>
                <li><a style="color: black" href="kontak">Contact</a></li>
                <li><a style="color: black" href="faq">FAQ</a></li>
                <li><a style="color: black" href="https://cekresi.com/" target="_blank">Cek No resi</a></li>
                <!-- <li><a style="color: black" href="garansi">Ketentuan Garansi</a></li> -->
              </ul>
            </section>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Account / Shipping Info-->
            <section class="widget widget-light-skin">
              <h3 class="widget-title" style="color: black">Rekening Support</h3>
              <!-- <ul class="list-unstyled text-sm text-white">
				<li><span class=" text-white"><img src="foto/bank/bni.png" style="width:50px;"></span> </li>
                  <li><span class="opacity-50">No Rekening : </span>0301679206</li>
                  <li><span class="opacity-50">Atas Nama :</span>Delvi Trianto</li>
                </ul>-->
              <?php
              $no = 1;
              $ambil = $con->query("SELECT * FROM `tbl_bank` WHERE id_bank='1'");
              while ($pecah = $ambil->fetch_object()) {
              ?>
                <!-- <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:50px;"></span></li> -->
                <ul class="list-unstyled text-sm text-white">
                  <img src="foto/bank/mandiri.png" alt="" width="50%" height="50%">
                  <!-- <li style="color: black;"><span style=" color: black;" class="opacity-50">Mandiri</span></li> -->
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">No Rekening : </span><?= $pecah->no_rek ?></li>
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">Atas Nama &nbsp;&nbsp; : </span><?= $pecah->atas_nama ?></li>

                </ul>
              <?php } ?>
              <?php
              $no = 1;
              $ambil = $con->query("SELECT * FROM `tbl_bank` WHERE id_bank='2'");
              while ($pecah = $ambil->fetch_object()) {
              ?>
                <!-- <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:50px;"></span></li> -->
                <ul class="list-unstyled text-sm text-white">
                  <img src="foto/bank/bni.png" alt="" width="30%" height="30%">
                  <!-- <li style="color: black;"><span style=" color: black;" class="opacity-50">Mandiri</span></li> -->
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">No Rekening : </span><?= $pecah->no_rek ?></li>
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">Atas Nama &nbsp;&nbsp; : </span><?= $pecah->atas_nama ?></li>

                </ul>
              <?php } ?>
              <?php
              $no = 1;
              $ambil = $con->query("SELECT * FROM `tbl_bank` WHERE id_bank='3'");
              while ($pecah = $ambil->fetch_object()) {
              ?>
                <!-- <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:50px;"></span></li> -->
                <ul class="list-unstyled text-sm text-white">
                  <img src="foto/bank/bca.png" alt="" width="30%" height="30%">
                  <!-- <li style="color: black;"><span style=" color: black;" class="opacity-50">Mandiri</span></li> -->
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">No Rekening : </span><?= $pecah->no_rek ?></li>
                  <li style="color: black;"><span style=" color: black;" class="opacity-50">Atas Nama &nbsp;&nbsp; : </span><?= $pecah->atas_nama ?></li>

                </ul>
              <?php } ?>
              <ul class="list-unstyled text-sm text-white">
                <li><span style="color: black" class="opacity-50">Keamanan </span></li>
                <li><span style="color: black" class=" text-white"><img src="foto/lisensi.png" style="width:100px;"></span></li>

              </ul>
            </section>
          </div>
        </div>
        <hr class="hr-light mt-2 margin-bottom-2x">
        <!-- Copyright-->
        <p class="list-unstyled text-center">Copyright <?php echo date('Y') ?> ©
          <a style="color: black; text-decoration: none" href=" mediatamaweb.co.id" target="_blank">Mediatama Web Indonesia</a> All rights reserved.
        </p>
      </div>
    </footer>
  </div>
  <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
  <!-- Backdrop-->
  <div class="site-backdrop"></div>
  <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
  <script src="js/vendor.min.js"></script>
  <script src="js/scripts.min.js"></script>
  <!-- Customizer scripts-->
  <script src="customizer/customizer.min.js"></script>
  <!-- WhatsHelp.io widget -->
  <script type="text/javascript">
    (function() {
      var options = {
        whatsapp: "+62811665273", // WhatsApp number
        // instagram: "+62811665273", // Call phone number
        call_to_action: "Hubungi Kami Disini", // Call to action
        button_color: "#E74339", // Color of button
        position: "right", // Position may be 'right' or 'left'
        order: "whatsapp,call", // Order of buttons
      };
      var proto = document.location.protocol,
        host = "whatshelp.io",
        url = proto + "//static." + host;
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = url + '/widget-send-button/js/init.js';
      s.onload = function() {
        WhWidgetSendButton.init(host, proto, options);
      };
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    })();
  </script>
  <!-- /WhatsHelp.io widget -->

</body>

<!-- Mirrored from themes.rokaux.com/unishop/v2.2/template-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Apr 2018 05:49:04 GMT -->

</html>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  function hitung() {
    var kurir = $('[name="kurir"]:checked').val();
    var total = $('#total').val();
    var ongkir = $("#ongkir").val();
    if (kurir == "gojek" || kurir == "Jemput Toko") {
      ongkir = 0;
    }
    var bayar = (parseFloat(total) + parseFloat(ongkir));


    if (parseFloat(ongkir) > 0) {
      $("#oksimpan").show();
    } else {
      $("#oksimpan").hide();
    }
    if (kurir == "gojek" || kurir == "Jemput Toko") {
      ongkir = 0;
    }
    $("#totalbayar").val(bayar);
    $("#testotal").html(toDuit(bayar));
    $("#jmlongkir").html(toDuit(ongkir));
    if (kurir == "gojek" || kurir == "Jemput Toko") {
      $("#biayap").hide();
      $("#oksimpan").show();
    } else {
      $("#biayap").show();
    }

    $("#jmlongkir").show();
  }

  function toDuit(number) {
    var number = number.toString(),
      duit = number.split('.')[0],
      duit = duit.split('').reverse().join('')
      .replace(/(\d{3}(?!$))/g, '$1,')
      .split('').reverse().join('');
    return 'Rp. ' + duit;
  }
  $(function() {

    $('#provinsi').change(function() {
      //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
      var prov = $('#provinsi').val();

      $.ajax({
        type: 'GET',
        url: 'cek_kabupaten.php',
        data: 'prov_id=' + prov,
        success: function(data) {

          //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
          $("#kabupaten").html(data);
        }
      });
    });

    $(".kurir").each(function(o_index, o_val) {
      $(this).on("change", function() {
        var did = $(this).val();
        var kab = $('#kabupaten').val();
        var berat = $('#berat').val();
        var kurir = $('[name="kurir"]:checked').val();
        if (kurir == "gojek" || kurir == "Jemput Toko") {
          $("#kurirserviceinfo").html("");
          $("#kuririnfo").hide();
          $("#oksimpan").show();
          hitung();
        } else {
          $.ajax({
              type: 'POST',
              dataType: "html",
              url: 'cek_ongkir.php',
              data: {
                'tujuan': kab,
                'kurir': did,
                'berat': berat
              },
              beforeSend: function() {
                $("#oksimpan").hide();
              }
            })
            .done(function(x) {
              $("#kurirserviceinfo").html(x);
              $("#kuririnfo").show();
            })
            .fail(function() {
              $("#kurirserviceinfo").html("");
              $("#kuririnfo").hide();
            });
        }


      });
    });

  });
</script>
<!--Start of Tawk.to Script-->
<!-- skrip js untuk menampilkan hitung mundur -->
<?php
// cek mode maintenis
if ($_SESSION['pengaturan']['mode_maintenance'] == "1" && !empty($_SESSION['pengaturan']['tgl_mulai_maintenance']) && !empty($_SESSION['pengaturan']['tgl_akhir_maintenance'])) {
?>
  <script>
    /*
    contoh :
    timer(54000000) 
    hasilnya object {hours: 1, minutes: 30, seconds: 0}
    */

    function tampilkanWaktu() {
      var waktu_mulai = new Date('<?= $_SESSION['pengaturan']['tgl_mulai_maintenance'] ?>').getTime();
      var waktu_selesai = new Date('<?= $_SESSION['pengaturan']['tgl_akhir_maintenance'] ?>').getTime();
      var waktu_sekarang = new Date().getTime();
      var selisih_waktu = waktu_selesai - waktu_sekarang;
      var hours = Math.floor(selisih_waktu / 3600000) // 1 Hour = 36000 Milliseconds
      var minutes = Math.floor((selisih_waktu % 3600000) / 60000) // 1 Minutes = 60000 Milliseconds
      var seconds = Math.floor(((selisih_waktu % 360000) % 60000) / 1000) // 1 Second = 1000 Milliseconds


      // jikam masih dalam waktu maintenis, tampilkan jam nya ke html
      if (waktu_sekarang >= waktu_mulai && waktu_sekarang <= waktu_selesai) {
        // menampilkan jam, menit dan detik ke HTML
        document.getElementById("timer").innerHTML = hours + " : " + minutes + " : " + seconds;
      } else // jika waktu sekarang sudah melewati waktu awal dan akhir maintenace, maka reload halaman
      {
        document.getElementById("timer").innerHTML = "";
        clearInterval(hitung_mundur); // hentikan proses hitung mundur
        window.location.reload();
      }


    }

    var hitung_mundur = setInterval(tampilkanWaktu, 1000); // proses hitung mundur dimulai
  </script>
<?php
}

?>
<!--Start of Tawk.to Script-->
<!--End of Tawk.to Script-->