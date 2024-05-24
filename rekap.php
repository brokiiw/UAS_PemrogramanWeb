<?php include "koneksi.php"; ?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Geopark Kebumen</title>
  <link href="assets-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href="assets-admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />

</head>

<body class="bg-gradient-success">

  <!-- header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4 mt-3">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekap Data </h6>
          </div>
          <div class="card-body">
            <form action="" method="POST" class="text-center">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Dari tanggal</label>
                    <input type="date" class="form-control" name="tanggal1" required
                      value="<?= isset($_POST['tanggal1']) ? ($_POST['tanggal1']) : date('Y-m-d') ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Hinggal tanggal</label>
                    <input type="date" class="form-control" name="tanggal2" required
                      value="<?= isset($_POST['tanggal2']) ? ($_POST['tanggal2']) : date('Y-m-d') ?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                  <button class="btn btn-primary form-control" name="tampil"><i class="fa fa-search"></i>
                    Tampilkan</button>
                </div>
                <div class="col-md-2">
                  <a href="admin.php" class="btn btn-danger form-control"><i class="fa fa-backward"></i> Kembali</a>
                </div>
              </div>
            </form>

            <?php
            if (isset($_POST['tampil'])):

              ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Komentar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Komentar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $tgl1 = $_POST['tanggal1'];
                    $tgl2 = $_POST['tanggal2'];
                    $tgl = date('Y-m-d');
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tamu where tanggal between '$tgl1' and '$tgl2' order by id desc");
                    $no = 1;
                    while ($data = mysqli_fetch_array($tampil)) {
                      ?>
                      <tr>
                        <td>
                          <?= $no++ ?>
                        </td>
                        <td>
                          <?= $data['tanggal'] ?>
                        </td>
                        <td>
                          <?= $data['nama'] ?>
                        </td>
                        <td>
                          <?= $data['jeniskelamin'] ?>
                        </td>
                        <td>
                          <?= $data['alamat'] ?>
                        </td>
                        <td>
                          <?= $data['email'] ?>
                        </td>
                        <td>
                          <?= $data['komentar'] ?>
                        </td>

                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>



  </div>
  <script src="assets-admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="assets-admin/js/sb-admin-2.min.js"></script>

  <script src="assets-admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script src="assets-admin/js/demo/datatables-demo.js"></script>

</body>

</html>