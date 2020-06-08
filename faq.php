
<div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Faq</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Faq</li>
            </ul>
          </div>
        </div>
      </div>
<section class="container">
        <h3 class="text-left mb-30">FAQ</h3>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="faq-left">
				<ul class="faq-container">
				    <?php 
                        	$faq = mysqli_query($con, "SELECT * FROM tbl_faq");
                        	while ($data = mysqli_fetch_assoc($faq)){
                        ?>
						<li>
							<label for="q1"><?= $data["judul_faq"];?></label> 
							<div class="answer">
								<?= $data["isi_faq"]?>
							</div>
						</li>
						<?php } ?>
				</ul>

			</div>
        </div>
</section>