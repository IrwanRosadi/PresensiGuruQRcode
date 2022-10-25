<?php
  include 'Koneksi.php';
  //  session_start();
   if(isset($_SESSION['username']) && isset($_SESSION['level'])){
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <!--<div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">Presensi Guru & Pegawai <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="Beranda.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>BERANDA</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

<?php 
  if($_SESSION['level']=="Admin"){ //jika level admin
?>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"aria-controls="collapse1">
          <i class="nav-icon fa fa-sitemap fa-3x"></i>
          <b><span>DATA MASTER</span></b>
        </a>
        <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="TampilPTK.php">
            <i class="fas fa-user "></i> 
              <b>Data PTK</b>
            </a>
            <a class="collapse-item" href="TampilKelas.php">
            <i class="fas fa-university"></i>
			        <b>Data Kelas</b>
			      </a>
            <a class="collapse-item" href="TampilMapel.php">
            <i class="fas fa-book"></i>
			        <b>Data Mata Pelajaran</b>
			      </a>
            <a class="collapse-item" href="TampilJam.php">
            <i class="fas fa-clock"></i> 
			    	  <b>Data Jam Mengajar</b>
			      </a>
            <a class="collapse-item" href="TampilJamPulang.php">
            <i class="fas fa-clock"></i>
			        <b>Data Jam Pulang</b>
			      </a>
            <!-- <a class="collapse-item" href="TampilJamMulai.php">
            <i class="fas fa-clock"></i> 
			    	  <b>Data Jam Mulai</b>
			      </a>
            <a class="collapse-item" href="TampilJamBerakhir.php">
            <i class="fas fa-clock"></i> 
			    	  <b>Data Jam Berakhir</b>
			      </a> -->
            <a class="collapse-item" href="TampilJadwal.php">
            <i class="fas fa-clipboard-list"></i>
			        <b>Data Jadwal</b>
			      </a>
          </div>
        </div>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="Presensi.php">
          <i class="nav-icon fa fa-camera fa-3x"></i>
          <b><span>PRESENSI</span></b>
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true"aria-controls="collapse1">
          <i class="nav-icon far fa fa-camera fa-3x"></i>
          <b><span>PRESENSI</span></b>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="Presensi.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Guru dan Pegawai</b>
            </a>
            <a class="collapse-item" href="PresensiMengajar.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Jadwal Mengajar</b>
            </a>
            <a class="collapse-item" href="PresensiPulang.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Pulang</b>
            </a>
          </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"aria-controls="collapse1">
          <i class="nav-icon far fa-file fa-3x"></i>
          <b><span>LAPORAN</span></b>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <!-- <a class="collapse-item" href="#">
            <i class="fas fa-users nav-icon"></i> Laporan Data PTK
            </a> -->
            <a class="collapse-item" href="LaporanPresensiMasuk.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Kehadiran<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tetap</b>
            </a>
            <a class="collapse-item" href="LaporanPresensiMasukMengajar.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Kehadiran<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sesuai Jadwal</b>
            </a>
            <a class="collapse-item" href="LaporanPresensiPulang.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Pulang</b>
            </a>
          </div>
        </div>
    </li>

<?php } elseif ($_SESSION['level']=="Guru BP") { ?>

  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"aria-controls="collapse1">
          <i class="nav-icon far fa-file fa-3x"></i>
          <b><span>DATA PRESENSI</span></b>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <!-- <a class="collapse-item" href="#">
            <i class="fas fa-users nav-icon"></i> Laporan Data PTK
            </a> -->
            <a class="collapse-item" href="PresensiMasuk.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Masuk</b>
            </a>
            <a class="collapse-item" href="PresensiPulang.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Pulang</b>
            </a>
          </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"aria-controls="collapse1">
          <i class="nav-icon far fa-file fa-3x"></i>
          <b><span>DATA BELUM PRESENSI</span></b>
        </a>
        <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <!-- <a class="collapse-item" href="#">
            <i class="fas fa-users nav-icon"></i> Laporan Data PTK
            </a> -->
            <a class="collapse-item" href="TambahKeteranganBelumPresensiMasuk.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Kehadiran<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tetap</b>
            </a>
            <a class="collapse-item" href="TambahKeteranganBelumPresensiMasuk2.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Kehadiran<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sesuai Jadwal</b>
            </a>
            <a class="collapse-item" href="TambahKeteranganBelumPresensiPulang.php">
            <i class="fas fa-circle nav-icon"></i>
              <b>Presensi Pulang</b>
            </a>
          </div>
        </div>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="TambahKeteranganBelumPresensi.php">
          <i class="nav-icon fa fa-plus fa-3x"></i>
          <b><span>DATA BELUM PRESENSI</span></b>
        </a>
    </li> -->
    
  <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Heading -->
    <div class="sidebar-heading">
        <!-- Interface -->
    </div>
</ul>
<!-- End of Sidebar -->

<?php } else {

echo "
<h1>
  404 Error Page
</h1>";
}


?>