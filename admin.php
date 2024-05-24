<?php include "header.php"; ?>

<?php
if (isset($_POST['bsimpan'])) {
  $tgl = date('Y-m-d');
  $nama = htmlspecialchars($_POST['nama'], ENT_NOQUOTES);
  $jeniskelamin = htmlspecialchars($_POST['jeniskelamin'], ENT_NOQUOTES);
  $alamat = htmlspecialchars($_POST['alamat'], ENT_NOQUOTES);
  $email = htmlspecialchars($_POST['email'], ENT_NOQUOTES);
  $komentar = htmlspecialchars($_POST['komentar'], ENT_NOQUOTES);


  $simpan = mysqli_query($koneksi, "INSERT INTO tamu VALUES ('','$tgl','$nama','$jeniskelamin','$alamat','$email','$komentar')");
  if ($simpan) {
    echo "<script>alert('Simpan data sukses');document.location=''</script>";
  } else {
    echo "<script>alert('Simpan data gagal');document.location=''</script>";

  }

}

?>


<div class="head text-center m-5">
  <h1 class="text-white">Buku Tamu<br>
    Pengunjung Geopark Kebumen
  </h1>

</div>
<!-- end -->

<div class="row mt-2">
  <div class="col-lg-7 mb-3">
    <div class="card shadow bg-gradient-light">
      <div class="card-body">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
          </div>
          <form class="user" method="POST" action="">
            <div class="form-group">
              <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung"
                required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" name="jeniskelamin" placeholder="Jenis Kelamin"
                required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" name="komentar" placeholder="Komentar" id="komentar" cols="50"
                rows="5" required></textarea>
            </div>
            <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>

          </form>
          <hr>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 mb-3">
    <div class="card shadow">
      <div class="card-body">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
        </div>
        <?php
        $tgl_sekarang = date('Y-m-d');
        $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
        $sekarang = date('Y-m-d h:i:s');

        $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu where tanggal like '%$tgl_sekarang%'"));
        $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu where tanggal like '%$kemarin%'"));
        $seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu where tanggal between '$seminggu' and '$sekarang'"));
        $bulan = date('m');
        $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu where month(tanggal) = '$bulan'"));
        $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu "));
        ?>
        <table class="table table-bordered">
          <tr>
            <td>Hari ini</td>
            <td>:
              <?= $tgl_sekarang[0] ?>
            </td>
          </tr>
          <tr>
            <td>Kemarin</td>
            <td>:
              <?= $kemarin[0] ?>
            </td>
          </tr>
          <tr>
            <td>Minggu ini</td>
            <td>:
              <?= $seminggu[0] ?>
            </td>
          </tr>
          <tr>
            <td>Bulan ini</td>
            <td>:
              <?= $sebulan[0] ?>
            </td>
          </tr>
          <tr>
            <td>Keseluruhan</td>
            <td>:
              <?= $keseluruhan[0] ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung hari ini[
      <?= date('d-m-Y') ?>]
    </h6>
  </div>
  <div class="card-body">
    <a href="rekap.php" class="btn btn-success mb-3"><i class="fa fa-table"> Rekap</i></a>
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
          $tgl = date('Y-m-d');
          $tampil = mysqli_query($koneksi, "SELECT * FROM tamu where tanggal like '%$tgl%' order by id desc");
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
  </div>
</div>

<?php include "footer.php"; ?>