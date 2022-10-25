<?php
// ob_start();
session_start();
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="" rel="icon">
  <link href="Layout/img/logo_sma.PNG" rel="icon">
  <title>Login | Presensi Guru & Pegawai</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary"><br><br><br>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <div class="container"><br><br>
                 <img src="Layout/img/bg2.JPG" class="container" height="" width="">
                 </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h2 class="h4 text-gray-800 mb-4">Silahkan Login</h2>
                  </div>

<?php
$username = "";
$password = "";

// session_start();
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'" );
  $count = mysqli_num_rows($sql);
  $fecthdata = mysqli_fetch_array($sql);
  if ($count > 0) {
    $level = $fecthdata['level'];
    if (($level == 'Admin') or ($level == 'admin')) {
      $_SESSION['username'] = $username;
      $_SESSION['level'] = $level;
      header('location:Dashboard.php');
    } else if (($level == 'Guru BP') or ($level == 'guruBP') or ($level == 'guru BP') or ($level == 'guru bp') or ($level == 'gurubp') or ($level == 'guruBP') or ($level == 'Guru bp')){
      $_SESSION['username'] = $username;
      $_SESSION['level'] = $level;
      header('location:Dashboard.php');
  }
 } else {
    echo "<center><font color='red'>Username dan password tidak sesuai.</font></center>";
 }
}
?>
                  <form method="POST" class="user" >
                    <div class="form-group">
                      <input type="tex" name="username" value="<?php echo $username ?>" class="form-control form-control-user" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Masukkan Username" required oninvalid="this.setCustomValidity('Silahkan memasukkan username !')" oninput="setCustomValidity('')" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" value="<?php echo $password ?>" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password" required oninvalid="this.setCustomValidity('Silahkan memasukkan password !')" oninput="setCustomValidity('')" autocomplete="off">
                    </div>
                   
                   <button name="login" class="btn btn-facebook btn-user btn-block">
                      <b>Login</b>
                   </button>   
                  </form>
                 <br>
                  <!-- <div class="text-center">
                     <p>Belum punya akun? &nbsp;<a class="small" href="registerasi.php" style="font-weight: bold; text-decoration: none;">Daftar</a></p>
                  </div> -->
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>