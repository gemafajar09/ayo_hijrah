<?php 
	$faq = mysqli_query($con, "SELECT * FROM tbl_garansi");
	$data = mysqli_fetch_assoc($faq);
?>
<div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Ketentuan Garansi</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Ketentuan Garansi</li>
            </ul>
          </div>
        </div>
      </div>
<section class="container">
        <h3 class="text-left mb-30">Ketentuan Garansi</h3>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="faq-left">
				<ul class="faq-container">
						<li>
							<label for="q1"><?= $data["judul_garansi"];?></label> 
							<div class="answer">
								<?= $data["isi_tex"]?>
							</div>
						</li>
				</ul>

			</div>
        </div>
</section>