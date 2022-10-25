<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="img/logo_sma.PNG" rel="icon">
  <title>Presensi Guru & Pegawai</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="Layout_User/assets/img/favicon.png" rel="icon"> -->
  <link href="Layout_User/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Layout_User/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Layout_User/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Layout_User/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Layout_User/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Layout_User/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="Layout_User/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NewBiz - v4.8.1
  * Template URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style type="text/css">
    /* cara disable tag a */
    a[disabled="disabled"] {
        pointer-events: none;
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <!-- <div class="logo"> -->
        <!-- Uncomment below if you prefer to use an text logo -->
        <!-- <h1><a href="index.html">NewBiz</a></h1> -->
        <!-- <a href="index.html"><img src="Layout_User/assets/img/logo.png" alt="" class="img-fluid"></a>
      </div> -->
      <img src="img/oke.PNG" height="70px" width="285PX"> 

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Histori Presensi</a></li>
        </ul>
        <!-- <ul>
          <li><a class="nav-link scrollto" href="validasi-QR1">Presensi Guru dan Pegawai</a></li>
          <li><a class="nav-link scrollto" href="validasi-QR2">Presensi Mengajar</a></li>
          <?php
              include_once 'Koneksi.php';
              date_default_timezone_set('Asia/Kuala_Lumpur');
              $waktu = date("H:i:sa");
              $aaa = "SELECT * FROM tb_jam_pulang ";
                      
              $bbb = mysqli_query($koneksi, $aaa);
              while($ooo = mysqli_fetch_array($bbb)){

              if ($waktu >= $ooo['jam_pulang']) {
            ?>
            <li><a class="nav-link scrollto" href="validasi-QR-Pulang">Presensi Pulang</a></li>
              <?php } else {?>
                <li><a class="nav-link scrollto" href="#" disabled="disabled">Presensi Pulang</a></li>
              <?php } ?>
            <?php } ?> -->
          <!-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  
  