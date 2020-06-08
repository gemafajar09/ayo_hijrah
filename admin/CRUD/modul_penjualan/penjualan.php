<?php

  if (isset($_GET['aksi'])){

    $aksi = $_GET['aksi'];



  switch ($aksi){

    case "hapusorder" :

    if(isset($_GET['id'])){

      $del = mysqli_query($con, "DELETE FROM tbl_orders where id_order='$_GET[id]'");

      if($del){

    	  echo "<script>

                 alert('Data Berhasil Dihapus');

    					   window.location='index.php?page=penjualan';

    				  </script>";

      }else{

        echo "<script>

                alert('Data Gagal Dihapus');

                window.location='index.php?page=penjualan';

              </script>";

      }

    }

?>

<?php

break;

    case "detailorder" :

    if(isset($_GET['id_order'])){

      $sql = mysqli_query($con, "SELECT o.*, c.*,p.*,k.* FROM tbl_orders o LEFT JOIN tbl_customer c ON o.id_customer=c.id_customer LEFT JOIN tbl_provinsi p ON o.id_prov=p.id_prov LEFT JOIN tbl_kota k ON o.id_kota=k.id_kota WHERE o.id_order='$_GET[id_order]'");

	    $r = mysqli_fetch_assoc($sql);

    }



    if(isset($_POST['ubah'])){

      $tglskrg = date('Y-m-d H:i:s');



      function isi_trans(){

        global $con;

		    $isitrans = array();

		    $sql = mysqli_query($con, "SELECT o.*, d.*, p.* FROM tbl_orders o LEFT JOIN tbl_orders_detail d ON o.id_order=d.id_order LEFT JOIN tbl_produk p ON d.id_produk=p.id_produk WHERE  o.id_order='$_GET[id_order]'");

		    while ($r=mysqli_fetch_array($sql)) {

			   $isitrans[] = $r;

		    }

		      return $isitrans;

		  }

      $isitrans = isi_trans();

		  $jml      = count($isitrans);



      if($_POST['newstat']=='Proses Pengiriman'){

        for ($i = 0; $i < $jml; $i++){

		      $sqlp = mysqli_query($con, "SELECT * FROM tbl_produk WHERE id_produk={$isitrans[$i]['id_produk']}");

		      $rp = mysqli_fetch_array($sqlp);
		      $kd_produk = $rp["kd_produk"];
		      $stok = $rp["stok"];
		      
		      $totstok = $stok - $jumlahbeli;

          $terjual = $rp["terjual"];

		      $jumlahbeli = "{$isitrans[$i]['jml']}";

          $totjual = $terjual + $jumlahbeli;

		      mysqli_query($con, "UPDATE tbl_produk SET stok='$totstok' , terjual='$totjual' WHERE id_produk={$isitrans[$i]['id_produk']}");
		      
		      mysqli_query($con, "UPDATE tb_barang set stok_sisa='$totstok', stok_terjual='$totjual' WHERE kode_barang='$kd_produk'");

		    }

       $insert = mysqli_query($con, "INSERT INTO `tbl_status_orders`( `id_order`, `status_order`, `tgl_status`) VALUES('$_GET[id_order]', '$_POST[newstat]','$tglskrg')");



        $update =  mysqli_query($con, "UPDATE tbl_orders SET status_ord='$_POST[newstat]', no_res='$_POST[no_resi]' WHERE id_order='$_GET[id_order]'");

      }else if($_POST['newstat']=='Dibatalkan'){

        for ($i = 0; $i < $jml; $i++){

          $sqlp = mysqli_query($con, "SELECT * FROM tbl_produk WHERE id_produk={$isitrans[$i]['id_produk']}");

          $rp = mysqli_fetch_array($sqlp);

          $stok = $rp["stok"];

          $terjual = $rp["terjual"];

          $jumlahbeli = "{$isitrans[$i]['jml']}";

          $totstok = $stok+$jumlahbeli;

          if($terjual > 0){

            $totjual = $terjual - $jumlahbeli;

          }

          mysqli_query($con, "UPDATE tbl_produk SET stok='$totstok', terjual='$totjual' WHERE id_produk={$isitrans[$i]['id_produk']}");

        }

        $insert = mysqli_query($con, "INSERT INTO `tbl_status_orders`(`id_order`, `status_order`, `tgl_status`) VALUES('$_GET[id_order]', '$_POST[newstat]','$tglskrg')");



        $update =  mysqli_query($con, "UPDATE tbl_orders SET status_ord='$_POST[newstat]' WHERE id_order='$_GET[id_order]'");

      }else{

       $insert = mysqli_query($con, "INSERT INTO `tbl_status_orders`(`id_order`, `status_order`, `tgl_status`) VALUES('$_GET[id_order]', '$_POST[newstat]','$tglskrg')");



      $update =  mysqli_query($con, "UPDATE tbl_orders SET status_ord='$_POST[newstat]',no_res='$_POST[no_resi]' WHERE id_order='$_GET[id_order]'");

      }

	  echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.php?page=penjualan'>";

	  

	  

    }

?>





    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        No Order

        <small><?= $r['id_order'] ?></small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Order</a></li>

        <li class="active">Detail Order</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="invoice">

      <!-- title row -->

      <div class="row">

        <div class="col-xs-12">

          <h2 class="page-header">

            <i class="fa fa-globe"></i> Rafika Stores

            <small class="pull-right">Tanggal <?php echo  tgl_indo($r["tgl_order"])." ".$r['jam_order'] ?></small>

          </h2>

        </div>

        <!-- /.col -->

      </div>

      <!-- info row -->

      <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">

          <strong>Data Customer</strong>

          <address>

            Nama Customer : <?= $r['nama_lengkap'] ?><br>

            No Hp : <?= $r['nohp'] ?><br>

            Email: <?= $r['email'] ?>

          </address>

        </div>

      </div>

      <!-- /.row -->



      <!-- Table row -->

      <div class="row">

        <div class="col-xs-12 table-responsive">

          <table class="table table-striped table-bordered">

            <thead>

            <tr>

              <th>No</th>

              <th>Foto</th>

              <th>Judul</th>

              <th>Jumlah</th>

              <th>Harga</th>

              <th>Total</th>

            </tr>

            </thead>



            <tbody>

            <?php

                $query = mysqli_query($con, "SELECT o.*, d.*, p.* FROM tbl_orders o LEFT JOIN tbl_orders_detail d ON o.id_order=d.id_order LEFT JOIN tbl_produk p ON d.id_produk=p.id_produk WHERE  o.id_order='$_GET[id_order]'");

                $no = 0;

                while($data=mysqli_fetch_assoc($query)){

                  $no++;

                  $total = $data['harga']*$data['jml'];

                  $subtot += $total;

            ?>

            <tr>

              <td><?= $no; ?></td>

              <td><img src="../foto/produk/<?= $data['foto']?>" style="width: 90px; height: 90px;"></td>

              <td><?= $data['judul'] ?></td>

              <td><?= $data['jml'] ?></td>

              <td><?= "Rp. ".number_format($data['harga'])?></td>

              <td><?= "Rp. ".number_format($total) ?></td>

            </tr>

          <?php } ?>

            </tbody>

          </table>

          <hr>

          <div class="col-lg-4" style="margin-top: -20px;">

            <h3>Alamat Kirim</h3>

            <table>

              <tr>

                <td>Nama Penerima </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['nmpenerima'] ?></td>

              </tr>

              <tr>

                <td>Provinsi </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['nama_prov'] ?></td>

              </tr>

              <tr>

                <td>Kota </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['nama_kota'] ?></td>

              </tr>

              <tr>

                <td>Kode Pos </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['kodepos'] ?></td>

              </tr>

              <tr>

                <td>Alamat </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['alamat_o'] ?></td>

              </tr>

            </table>

          </div>

          <div class="col-lg-4" style="margin-top: -20px;">

            <h3>Jenis Pengiriman</h3>

            <table>

              <tr>

                <td>Kurir </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= strtoupper($r['kurir']) ?></td>

              </tr>

              <tr>

                <td>Service </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['service'] ?></td>

              </tr>

			  <tr>

                <td>No Resi </td>

                <td>&nbsp;&nbsp;&nbsp; : &nbsp; &nbsp; &nbsp;</td>

                <td><?= $r['no_res'] ?></td>

              </tr>

            </table>

          </div>

          <div class="col-lg-4 text-right" style="margin-top: -20px;">

            <h3>Detail Harga</h3>

              <h5><strong>Sub Total</strong>:	<?php echo "Rp. ".number_format($subtot) ?></h5>

							<h5><strong>Ongkos Kirim</strong>:	<?php echo "Rp. ".number_format($r['ongkir']) ?></h5>

							<h4><strong>Total Bayar</strong>: <?php echo "Rp. ".number_format($r['total']) ?></h4><br>

					</div>

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->



      <hr>



      <div class="row">

        <!-- accepted payments column -->

        <div class="col-xs-6">

          <p class="lead">Status Pesanan</p>

          <table class="table table-hovered">

            

          </table>

          <form method="POST" action="">

            <div class="form-group">

              <div class="col-sm-8">

              <select class="form-control" name="newstat">
				<?php 
					$sql1 = mysqli_query($con, "SELECT * FROM tbl_orders WHERE id_order='$_GET[id_order]'");
					$r1 = mysqli_fetch_assoc($sql1);
					
					if($r1['status_ord']=='Pembayaran Diterima'){
				?>
                <option selected value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Barang Tengah Disiapkan'){ ?>
				
				<option value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option selected value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Proses Pengiriman'){ ?>
				
				<option value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option selected value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Barang Telah Diterima'){ ?>
				
				<option value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option selected value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Dibatalkan'){ ?>
				
				<option value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option selected value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Menunggu Pembayaran'){ ?>
				
				<option selected value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php }else if($r1['status_ord']=='Lunas'){ ?>
				
				<option selected value="Pembayaran Diterima">Pembayaran Diterima</option>
                <option value="Barang Tengah Disiapkan">Barang Tengah Disiapkan</option>
                <option value="Proses Pengiriman">Proses Pengiriman</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
				
				<?php } ?>
              </select>

              </div>

			  <div class="col-sm-8">

              <input type="text" name="no_resi" class="form-control" placeholder="no resi" value="<?= $r1['no_res'] ?>">

              </div>

              <div class="col-sm-4">

                <button type="submit" name="ubah" class="btn btn-flat btn-info">Update Status</button>

              </div>

          </div>

          </form>

        </div>

        <!-- /.col -->

        <div class="col-xs-6">

          <p class="lead">Konfirmasi Pembayaran</p>

          <div class="table-responsive">

            <table class="table">

              <?php

                  $konf = mysqli_query($con, "SELECT * FROM tbl_konfirmasi_bayar WHERE id_order='$_GET[id_order]'");

                  $dtkonf = mysqli_fetch_assoc($konf)

              ?>

              <tr>

                <th>Jumlah Transfer</th>

                <td><?= "Rp. ".number_format($dtkonf['total_bayars']) ?></td>

              </tr>

              <tr>

                <th>Bukti Transfer</th>

                <td><a href="../foto/bukti/<?= $dtkonf['bukti'] ?>" target="_blank"><img src="../foto/bukti/<?= $dtkonf['bukti'] ?>" style="width: 130px; height: 130px;"></a></td>
                <td>Download Bukti Pembayaran <br><a href="../foto/bukti/<?= $dtkonf['bukti'] ?>" class="btn btn-default" target="_blank" download=""><i class="fa fa-download"></i></a></td>


              </tr>

            </table>

          </div>

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

    <div class="clearfix"></div>

<?php

break;

}

}else{

?>



<section class="content-header">

      <h1>

        Penjualan

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Penjualan</li>

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

              <div class="table table-responsive">

              <table id="example1" class="table table-bordered table-striped">

                <thead>

                <tr>

					       <th>No</th>

                 <th>No Order</th>

					       <th>Nama Customer</th>

					       <th>Waktu Order</th>

					       <th>Total</th>

                 <th>Status</th>

        				 <th>Aksi</th>

                </tr>

                </thead>

                <tbody>



            <?php

          			 $sql = mysqli_query($con, "SELECT o.*, c.* FROM tbl_orders o LEFT JOIN tbl_customer c ON o.id_customer=c.id_customer");

                 $no = 0;

                 while($r=mysqli_fetch_assoc($sql)){

                    $no++;

                    $jam = substr($r['expired'], 11,8);



                    if($r['status_ord']=='Menunggu Pembayaran'){

                        $status = "<span style='color: #fff; background-color: #5163de; padding: 5px;'>Menunggu Pembayaran</span>";

                    }else if($r['status_ord']=='Pembayaran Diterima'){

                        $status = "<span style='color: #fff; background-color: #0ebdbb; padding: 5px;'>Pembayaran Diterima</span>";

                    }else if($r['status_ord']=='Barang Tengah Disiapkan'){

                        $status = "<span style='color: #fff; background-color: #3e64d4; padding: 5px;'>Barang Tengah Disiapkan</span>";

                    }else if($r['status_ord']=='Proses Pengiriman'){

                        $status = "<span style='color: #fff; background-color: #59b159; padding: 5px;'>Proses Pengiriman</span>";

                    }else if($r['status_ord']=='Barang Telah Diterima'){

                        $status = "<span style='color: #fff; background-color: #177d42; padding: 5px;'>Barang Telah Diterima</span>";

                    }else if($r['status_ord']=='Dibatalkan'){

                        $status = "<span style='color: #fff; background-color: #c42c2c; padding: 5px;'>Dibatalkan</span>";

                    }else if($r['status_ord']=='Lunas'){
						
						$status = "<span style='color: #fff; background-color: #0ebdbb; padding: 5px;'>Lunas</span>";
						
					}

					  ?>

						<tr>

              <td width='0' class='center'><?php echo $no; ?></td>

  						<td><?php echo  $r["id_order"]; ?></td>

  						<td><?php echo  $r["nama_lengkap"]; ?></td>

  						<td><?php echo  $r["tgl_order"]; ?></td>

  						<td><?php echo  "Rp. ".number_format($r["total"]); ?></td>

              <td><?php echo  $status; ?></td>

            	<td><a class='btn btn-primary btn-xs' title='Detail Order' href='?page=penjualan&aksi=detailorder&id_order=<?php echo $r['id_order'];?>'><span class='glyphicon glyphicon-zoom-in'></span></a>

              <a class='btn btn-danger btn-xs' title='Hapus Penjualan' href='?page=penjualan&aksi=hapusorder&id=<?php echo $r['id_order'];?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><span class='glyphicon glyphicon-remove'></span></a>

              </td>

						</tr>

					 <?php

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

          <!-- /.box -->

     </section>

<?php } ?>

