<?php 
     require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
?>

<?php 
// Menampilkan data di dashboard

$x="select * from tb_ptk WHERE tb_ptk.id_PTK='$_GET[id_PTK]'";
$y=mysqli_query($koneksi,$x);
$z=mysqli_fetch_array($y);  
 
?>

<!--HALAMAN DASBOARD-->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Detail QR Code</h1>
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-5 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col-auto">
            <img src="temp/<?php echo $z['id_PTK'].".png"; ?>" height="150" width="150">&nbsp;&nbsp;&nbsp;&nbsp;
          </div>
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-propercase mb-1"><h5><?php echo $z['nama_PTK'] ?></h5></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6>ID PTK &nbsp;: <?php echo $z['id_PTK'] ?></h6></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6>Jabatan : <?php echo $z['jabatan_PTK'] ?></h6></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6>Jenis &nbsp; &nbsp; &nbsp;: <?php echo $z['jenis_PTK'] ?></h6></div>
            <!-- <a href="TampilPTK.php" class="btn btn-outline-primary btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          
        </div>
      </div>
    </div>
  </div>

    </div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" target="_blank" class="btn btn-success "><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Print</b></a>
</div>

<br><br><br><br><br><br><br><br>

<?php
    require_once 'Layout/Footer.php';