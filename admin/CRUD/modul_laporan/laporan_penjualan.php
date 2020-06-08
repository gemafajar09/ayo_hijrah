<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-book"></i> <b>Laporan</b>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <form action="CRUD/modul_laporan/hari.php" target="_blank" method="post">
                <div class="form-group">
                  <label>Laporan Penjualan Per-Hari</label>
                  <input class="form-control" type="date" name="hari" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Print</button>
                </div>
              </form>
            </div>
            <div class="col-md-4">
              <form action="CRUD/modul_laporan/bulan.php" target="_blank" method="post">
                <div class="form-group">
                  <label>Laporan Penjualan Per-Bulan</label>
                  <input class="form-control" type="month" name="bulan" value="<?php echo date('Y-m'); ?>">
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Print</button>
                </div>
              </form>
            </div>
            <div class="col-md-4">
              <form action="CRUD/modul_laporan/tahun.php" target="_blank" method="post">
                <div class="form-group">
                  <label>Laporan Penjualan Per-Tahun</label>
                  <input class="form-control" type="number" min="2010" max="2100" name="tahun" value="<?php echo date('Y'); ?>">
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Print</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</section>