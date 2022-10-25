<?php 
    //  require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak ID Card</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo_sma.PNG" rel="icon">
    <title>Presensi Guru & Pegawai</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Webcam -->
    <script src="Tamplate/lib_webcam/jquery.min.js"></script>
    <script src="Tamplate/lib_webcam/instascan.min.js"></script>
</head>
<body>
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
  <!-- <h1 class="h3 mb-0 text-gray-800">Detail QR Code</h1> -->
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-5 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col-auto">
            <img src="temp/<?php echo $z['id_PTK'].".png"; ?>" height="150" width="150">&nbsp;&nbsp;&nbsp;&nbsp;
          </div>
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-propercase mb-1"><h5><?php echo $z['nama_PTK'] ?></h5></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6><b>ID PTK</b> &nbsp;: <?php echo $z['id_PTK'] ?></h6></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6><b>Jabatan</b> : <?php echo $z['jabatan_PTK'] ?></h6></div>
            <div class="h3 mb-0 font-weight-bold text-gray-900"><h6><b>Jenis</b> &nbsp; &nbsp; &nbsp;: <?php echo $z['jenis_PTK'] ?></h6></div>
            <!-- <a href="TampilPTK.php" class="btn btn-outline-primary btn-sm">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          
        </div>
      </div>
    </div>
  </div>

    </div>
</div>
<script> 
		window.print();
	</script>

</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

   

</body>
</html>

<?php
    // require_once 'Layout/Footer.php';