
        <!--===== INNERPAGE-WRAPPER ====-->
        <section class="innerpage-wrapper">
          <div id="login" class="innerpage-section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">   
                          <div class="flex-content">
                                <div class="custom-form custom-form-fields">
                                    <h3>Temukan Akun Anda</h3>

                                    <form method="POST" action="">
                                        <div class="form-group">
                                             <input type="email" class="form-control" placeholder="Email" name="email" id="email" required="required" />
                                             <span><i class="fa fa-user"></i></span>
                                        </div> 

                                        <?php 
                                          if(isset($_POST['cari'])){

                                            $email = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['email'])))));


                                            $query =mysqli_query($con,"SELECT * FROM tbl_member WHERE email='$email'");
                                            $data = mysqli_fetch_assoc($query);
                                            $nama = $data['nama'];
                                            $cek = mysqli_num_rows($query);

                                            if($cek > 0){

                                            $token = bin2hex(openssl_random_pseudo_bytes(16));
                                            $token1 = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($token)))));

                                             $waktu = time() + (60*60);
                                             $jam = date('Y-m-d H:i:s', $waktu);

                                            $query = mysqli_query($con,"UPDATE tbl_member SET link_token = '$token1', jam_expired='$jam' WHERE email='$email'");

require 'PHPMailerAutoload.php';
require 'credential.php';

$mail = new PHPMailer(true);                              
try {
    //Server settings
    // $mail->SMTPDebug = 2;                                 
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com;';  
    $mail->SMTPAuth = true;                            
    $mail->Username = EMAIL;                 
    $mail->Password = PASS;                          
    $mail->SMTPSecure = 'tls';                           
    $mail->SMTPAuth = true;  
    $mail->Port = 587;                                  
    //Recipients
    $mail->setFrom(EMAIL, 'TransApp.id');
    $mail->addAddress($_POST['email']);     // Add a recipient

    $mail->addReplyTo(EMAIL);
   #DBDBDB
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'TransApp.id Reset Password';
    $mail->Body    = "<body style='background-color: #EBEBEB;'><div Style='background-color: #3299CE; padding: 20px; color:#fff; width:500px; font-weight:bold; margin-left: 250px; font-size: 25px; text-align:center;'>TransApp.id</div>
      <div style= 'background-color: #fff; width:500px; margin-left: 250px; padding: 20px; font-size: 15px;'>Hi.. $nama <p>Kami menerima permintaan dari<a href='http://transapp.id'> TransApp.id</a></p><p>Untuk Menyelesaikan Proses Ini Silahkan Klik Link Dibawah ini</p><p><a href='http://localhost/mediatama/TransAppHosting/regenerate/resetpassword-$token1'>Reset Password</a></p><p>Link Akan Habis Masa Berlakunya Setelah Satu Jam Semenjak Email Ini Dikirim</p><p>Terima Kasih Atas Perhatian dan Kerjasama Anda</p><p>Salam,<br><a href='http://transapp.id'>TransApp.id</a></p></div></body>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<span>Link Untuk Perubahan Password Telah dikirim ke Email $email</span>";
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

                                            
                                            }else{ ?>
                                                <span>Anda Belum Terdaftar di </span><a href="<?= $base_url;?>./" target="_blank">TransApp.id</a> Silahkan Daftar <a href="<?= $base_url; ?>daftar/">disini</a>
                                            <?php
                                            }

                                          }
                                        ?>
                                          <button class="btn btn-orange btn-block" name="cari">cari</button>
                                          <a href="<?= $base_url; ?>login/" class="btn btn-primary btn-block">Batal</a>
                                    </form>
                                </div><!-- end custom-form -->
                            </div><!-- end form-content -->
                        </div><!-- end columns -->
                    </div><!-- end row -->
                </div><!-- end container -->         
            </div><!-- end login -->
        </section><!-- end innerpage-wrapper -->