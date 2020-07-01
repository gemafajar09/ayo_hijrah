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

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>Ayo Hijrah</title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="Ayo Hijrah">
  <meta name="keywords" content="The Beauty Of Indonesian On Your Daily Wear">
  <meta name="author" content="RaikaStores">
  <!-- Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- Favicon and Apple Icons-->

  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
  <!-- <link rel="icon" type="image/x-icon" href="foto/logo.png">

  <link rel="icon" type="image/png" href="foto/logo.png">
  <link rel="apple-touch-icon" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="152x152" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="rafika.ico">
  <link rel="apple-touch-icon" sizes="167x167" href="rafika.ico">
  Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
  <link rel="stylesheet" media="screen" href="css/vendor.min.css">
  <!-- Main Template Styles-->
  <link id="mainStyles" rel="stylesheet" media="screen" href="css/styles.min.css">
  <link id="mainStyles" rel="stylesheet" media="screen" href="css/stylesfaq.css">
  <!-- Customizer Styles-->
  <link rel="stylesheet" media="screen" href="customizer/customizer.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <style>
    .pagination {
      display: inline-block;
      padding-left: 0;
      margin: 20px 0;
      border-radius: 4px
    }

    .pagination>li {
      display: inline
    }

    .pagination>li>a,
    .pagination>li>span {
      position: relative;
      float: left;
      padding: 6px 12px;
      margin-left: -1px;
      line-height: 1.42857143;
      color: #337ab7;
      text-decoration: none;
      background-color: #fff;
      border: 1px solid #ddd
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
      margin-left: 0;
      border-top-left-radius: 4px;
      border-bottom-left-radius: 4px
    }

    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
      border-top-right-radius: 4px;
      border-bottom-right-radius: 4px
    }

    .pagination>li>a:focus,
    .pagination>li>a:hover,
    .pagination>li>span:focus,
    .pagination>li>span:hover {
      z-index: 2;
      color: #23527c;
      background-color: #eee;
      border-color: #ddd
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {
      z-index: 3;
      color: #fff;
      cursor: default;
      background-color: #337ab7;
      border-color: #337ab7
    }

    .pagination>.disabled>a,
    .pagination>.disabled>a:focus,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>span,
    .pagination>.disabled>span:focus,
    .pagination>.disabled>span:hover {
      color: #777;
      cursor: not-allowed;
      background-color: #fff;
      border-color: #ddd
    }

    .pagination-lg>li>a,
    .pagination-lg>li>span {
      padding: 10px 16px;
      font-size: 18px;
      line-height: 1.3333333
    }

    .pagination-lg>li:first-child>a,
    .pagination-lg>li:first-child>span {
      border-top-left-radius: 6px;
      border-bottom-left-radius: 6px
    }

    .pagination-lg>li:last-child>a,
    .pagination-lg>li:last-child>span {
      border-top-right-radius: 6px;
      border-bottom-right-radius: 6px
    }

    .pagination-sm>li>a,
    .pagination-sm>li>span {
      padding: 5px 10px;
      font-size: 12px;
      line-height: 1.5
    }

    .pagination-sm>li:first-child>a,
    .pagination-sm>li:first-child>span {
      border-top-left-radius: 3px;
      border-bottom-left-radius: 3px
    }

    .pagination-sm>li:last-child>a,
    .pagination-sm>li:last-child>span {
      border-top-right-radius: 3px;
      border-bottom-right-radius: 3px
    }

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

    @font-face {
      font-family: 'bradley';
      src: url(css/bradhitc.ttf);
    }

    @font-face {
      font-family: 'quick';
      src: url(css/Quicksand-Regular_afda0c4733e67d13c4b46e7985d6a9ce.ttf);
    }
    .rslides {
  position: relative;
  list-style: none;
  overflow: hidden;
  width: 100%;
  padding: 0;
  margin: 1.5em 0 0 0;
  background-color: #f7f7f7;
  }

.rslides li {
  -webkit-backface-visibility: hidden;
  position: absolute;
  display: none;
  width: 100%;
  left: 0;
  top: 0;
  }

.rslides li:first-child {
  position: relative;
  display: block;
  float: left;
  }

.rslides img {
  display: block;
  height: auto;
  float: left;
  width: 100%;
  border: 0;
  }

.rslides1_nav {
  position: absolute;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
  top: 50%;
  left: 0;
  z-index: 99;
  opacity: 0.2;
  text-indent: -9999px;
  overflow: hidden;
  text-decoration: none;
  height: 61px;
  width: 38px;
  background: transparent url("http://responsiveslides.com/with-captions/themes.gif") no-repeat left top;
  margin-top: -45px;
  }
  .rslides_nav{
    margin-top:-19.5px !important;
}
.col.span_3_of_3{
    position:relative;
}

.rslides1_nav:active {
  opacity: 1.0;
  }

.rslides1_nav.next {
  left: auto;
  background-position: right top;
  right: 0;
  }

.rslides1_nav:focus {
  outline: none;
  }

.rslides_tabs {
  margin-top: 10px;
  text-align: center;
  }

.rslides_tabs li {
  display: inline;
  float: none;
  _float: left;
  *float: left;
  margin-right: 5px;
  }

.rslides_tabs a {
  text-indent: -9999px;
  overflow: hidden;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  background: #ccc;
  background: rgba(0,0,0, .2);
  display: inline-block;
  _display: block;
  *display: block;
  -webkit-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
  -moz-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
  box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
  width: 9px;
  height: 9px;
  }

.rslides_tabs .rslides_here a {
  background: #222;
  background: rgba(0,0,0, .8);
  }
    /* body{
      font-family: 'bradley';
      font-size: 70pt;
      font-variant: inherit;
    } */
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
    
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
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
              <h5 class="" style="color: black">Contact Information</h5>
              <p class="" style="color: black">
                <h6>Alamat : Jl. Pondok, Kp. Pd., Kec. Padang Bar., Kota Padang, Sumatera Barat</h6>
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
                      <h6>Call Only</h6>
                    </td>
                    <td style="color: black">
                      <h6>: +62 811 66 190 20</h6>
                    </td>
                  </tr>
                </table>
              </ul>
              <p style="color: black">
                <h5>Claim / Reject / Refund (Retur) : <br></h5>
                <h6>Admin 1 : +62 811 66 190 20 <br>
                  Admin 2 : +62 811 66 190 30</h6>
              </p>
            </section>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- About Us-->
            <section class="widget widget-links widget-light-skin">
              <h5 class="" style="color: black">Navigation</h5>
              <ul>
                <li><a style="color: black" href="./">Home</a></li>
                <li><a style="color: black" href="shop">Shop</a></li>
                <li><a style="color: black" href="about">About</a></li>
                <!-- <li><a style="color: black" href="testimonial">Testimonial</a></li> -->
                <!-- <li><a style="color: black" href="cara-beli">Cara Belanja</a></li> -->
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
              <h5 class="" style="color: black">Rekening Support</h5>
              <!-- <ul class="list-unstyled text-sm text-white">
				<li><span class=" text-white"><img src="foto/bank/bni.png" style="width:50px;"></span> </li>
                  <li><span class="opacity-50">No Rekening : </span>0301679206</li>
                  <li><span class="opacity-50">Atas Nama :</span>Delvi Trianto</li>
                </ul>-->

              <?php
              $no = 1;
              $ambil = $con->query("SELECT * FROM tb_bank, tb_bank_detail WHERE tb_bank.id_bank = tb_bank_detail.id_bank");
              while ($pecah = $ambil->fetch_object()) {
              ?>
                <!-- <li><span class=" text-white"><img src="foto/bank/bca.png" style="width:50px;"></span></li> -->
                <ul class="list-unstyled text-sm text-white">
                  <img src="img/bank/<?= $pecah->logo_bank ?>" alt="" width="50%" height="50%">
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="js/responsiveslides.min.js"></script>
  <script>
  $(function() {
    $(".rslides").responsiveSlides({
      auto: true,             // Boolean: Animate automatically, true or false
      speed: 300,            // Integer: Speed of the transition, in milliseconds
      timeout: 2000,          // Integer: Time between slide transitions, in milliseconds
      pager: false,           // Boolean: Show pager, true or false
      nav: true,             // Boolean: Show navigation, true or false
      random: false,          // Boolean: Randomize the order of the slides, true or false
      pause: false,           // Boolean: Pause on hover, true or false
      pauseControls: true,    // Boolean: Pause when hovering controls, true or false
      prevText: "Previous",   // String: Text for the "previous" button
      nextText: "Next",       // String: Text for the "next" button
      maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
      navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
      manualControls: "",     // Selector: Declare custom pager navigation
      namespace: "rslides",   // String: Change the default namespace used
      before: function(){},   // Function: Before callback
      after: function(){}     // Function: After callback
    });
  });
</script>
</body>

<!-- Mirrored from themes.rokaux.com/unishop/v2.2/template-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Apr 2018 05:49:04 GMT -->

</html>

<!--Start of Tawk.to Script-->
<!--End of Tawk.to Script-->