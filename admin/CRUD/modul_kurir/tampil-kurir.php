<?php
 include"confiq/database.php";
?>


    <!-- Content Header (Page header) -->

    <section class="content">
 


      <div class="row">
        <div class="col-md-12">
		<div class="box-header box box-info">
              <h2 class="box-title">Data Kurir</h2>
            </div>
		
          <div class="box">
			
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>No</th>
					<th>Nama Kurir</th>
					<th>Alamat</th>
					<th>No Telehone</th>
					<th>Biaya</th>
					<th>Action</th>
                </tr>
                </thead>
                <tbody>
				
          			<?php
          				$q=mysqli_query($con, "SELECT * from tbl_kurir");
          				$no=1;
          				while($r=mysqli_fetch_array($q)){
						?>
						
						<tr>
                        <td width='0' class='center'><?php echo $no; ?></td>
						<td><?php echo  $r["nama_kurir"]; ?></td>
						<td><?php echo  $r["alamat"]; ?></td>
						<td><?php echo  $r["no_telp"]; ?></td>
						<td><?php echo  $r["biaya"]; ?></td>
          				<td><a class='btn btn-success btn-xs' title='Edit Data' href='?page=editkat&id_kategori=<?php echo $r['id_kategori']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
							<a class='btn btn-danger btn-xs' title='Delete Data' href='?page=delkat&id_kategori=<?php echo $r['id_kategori'];?>'><span class='glyphicon glyphicon-remove'></span></a>
							
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