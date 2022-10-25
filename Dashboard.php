<?php 
  require_once 'Layout/Header.php';
  require_once 'Koneksi.php';
  include 'Koneksi.php';
  // session_start();
  if(isset($_SESSION['username']) && isset($_SESSION['level'])){

    
?>

<?php 
  if(($_SESSION['level']=="Admin") or ($_SESSION['level']=="admin")){ //jika level admin
?>

<?php 
// Menampilkan data di dashboard

// menampilkan data PTK
  $a="select * from tb_ptk"; 
  $b=mysqli_query($koneksi,$a);
  $c=mysqli_num_rows($b);

  // menampilkan data Jadwal
  $d="select * from tb_jadwal"; 
  $e=mysqli_query($koneksi,$d);
  $f=mysqli_num_rows($e);

   // menampilkan data Presensi
   $g="select * from tb_hasil_presensi"; 
   $h=mysqli_query($koneksi,$g);
   $i=mysqli_num_rows($h);

   // menampilkan data Presensi
   $j="select * from tb_kehadiran"; 
   $k=mysqli_query($koneksi,$j);
   $l=mysqli_num_rows($k);

?>

<!--HALAMAN DASBOARD-->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="TampilPTK.php"><h5>DATA PENDIDIK DAN TENAGA KEPENDIDIKAN</h5></a></div>
            <div class="h3 mb-0 font-weight-bold text-gray-700"><?php echo $c ?></div><br>
            <!-- <a href="TampilPTK.php" class="btn btn-outline-primary btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <div class="col-auto">
            <i class="fas fa-users  fa-2x text-gray-500"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="TampilJadwal.php"><h5>DATA JADWAL</h5></a></div>
            <div class="h3 mb-0 font-weight-bold text-gray-700"><?php echo $f ?></div><br>
            <!-- <a href="TampilJadwal.php" class="btn btn-outline-success btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="PresensiMengajar.php"><h5>DATA PRESENSI GURU SESUAI JADWAL MENGAJAR</h5></a></div>
            <div class="h3 mb-0 font-weight-bold text-gray-700"><?php echo $i ?></div><br>
            <!-- <a href="#" class="btn btn-outline-warning btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <div class="col-auto">
            <i class="fas fa-book fa-2x text-gray-500"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="Presensi.php"><h5>DATA PRESENSI KEHADIRAN GURU TETAP & PEGAWAI</h5></a></div>
            <div class="h3 mb-0 font-weight-bold text-gray-700"><?php echo $l ?></div><br>
            <!-- <a href="#" class="btn btn-outline-info btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <div class="col-auto">
            <i class="fas fa-book fa-2x text-gray-500"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<br><br><br><br>
<?php } elseif  (($_SESSION['level']=="Guru BP") or ($_SESSION['level']=="GuruBP") or ($_SESSION['level']=="guru bp") or ($_SESSION['level']=="gurubp") or ($_SESSION['level']=="guru BP") or ($_SESSION['level']=="Guru bp")){?>

  <?php
    $aa="SELECT * FROM tb_kehadiran, tb_ptk
        WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK"; 
    $bb=mysqli_query($koneksi,$aa);
    $cc=mysqli_num_rows($bb);
  ?>

<?php
    $aaa="SELECT * FROM tb_hasil_presensi, tb_ptk
        WHERE tb_ptk.id_PTK = tb_hasil_presensi.id_PTK"; 
    $bbb=mysqli_query($koneksi,$aaa);
    $ccc=mysqli_num_rows($bbb);
  ?>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
          class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h5>DATA PRESENSI KEHADIRAN GURU TETAP & PEGAWAI</h5></div>
                <div class="h3 mb-0 font-weight-bold text-success-700"><?php echo $cc ?></div><br>
                <!-- <a href="Presensi2.php" class="btn btn-outline-success btn-sm">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
              <div class="col-auto">
                <i class="fas fa-users  fa-2x text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h5>DATA PRESENSI GURU SESUAI JADWAL MENGAJAR </h5></div>
                <div class="h3 mb-0 font-weight-bold text-info-700"><?php echo $ccc ?></div><br>
                <!-- <a href="TambahKeteranganBelumPresensi.php" class="btn btn-outline-warning btn-sm">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
              <div class="col-auto">
                <i class="fas fa-users  fa-2x text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <!-- <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><h5>DATA BELUM PRESENSI KEHADIRAN GURU TETAP & PEGAWAI</h5></div>
                <div class="h3 mb-0 font-weight-bold text-warning-700"></div><br> -->
                <!-- <a href="Presensi2.php" class="btn btn-outline-success btn-sm">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
              <!-- </div>
              <div class="col-auto">
                <i class="fas fa-users  fa-2x text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <!-- <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><h5>DATA BELUM PRESENSI GURU SESUAI JADWAL MENGAJAR</h5></div>
                <div class="h3 mb-0 font-weight-bold text-danger-700"></div><br> -->
                <!-- <a href="TambahKeteranganBelumPresensi.php" class="btn btn-outline-warning btn-sm">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
              <!-- </div>
              <div class="col-auto">
                <i class="fas fa-users  fa-2x text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>
      </div>-->

    </div>
  </div> 
<br><br><br><br><br><br><br><br><br><br>
<?php } ?>
<?php
    require_once 'Layout/Footer.php';
?>

<?php } ?>