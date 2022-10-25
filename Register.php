<?php 
  include 'koneksi.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="Layout/img/logo_sma.PNG" rel="icon">
  <title >Presensi Guru dan Staff</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary"><br>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block "><br><br><br><br><br><br>
            <div class="container">
                  <img src="img/bg.JPG" class="container" height="" width="">
                 </div>
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Silahkan Daftar</h1>
              </div>

<?php 
//supaya inputan pada form tdk hilang
$nama_user="";
$username="";
$level="";

//pesan error
$usernameError="";
$passwordError="";
$levelError="";
$username_valid=true;

  //Jika diklik button register
  if (isset($_POST["register"])) {

    $nama_user  = $_POST['nama_user'];
    $username   = $_POST['username'];
    $level      = $_POST['level'];
    $password1  = mysqli_real_escape_string($koneksi, $_POST['password1']);//mysqli_real_escape_string adalah utk memberi perlindungan database dari user ketika memasukkan karakter yg tak diinginkan.
    $password2  = mysqli_real_escape_string($koneksi, $_POST['password2']);

    //cek username sudah ada atau belum
    $aa=mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username='$username' ");
    //jika ada
    if (mysqli_num_rows($aa)) {
        $username_valid=false;
        $usernameError="<center><font color='red'>Username sudah terdaftar</font></center>";
       
      }
    
    //cek password
    //Jika password1 tdk sama dgn password2 maka register gagal
    elseif ($password1 !== $password2) {
      $passwordError="<center><font color='red'>Konfirmasi password tidak sesuai</font></center>";
    }

    else{
      //$password1 = password_hash($password1, PASSWORD_DEFAULT); //cara enkripsi password

      //simpan kedatabase jika register sudah bernar 
      $input= "INSERT INTO tb_user VALUES ('', '$nama_user','$username','$password1','$level')";
      $query = mysqli_query($koneksi,$input);
      if($query){
         echo "<script>
                  alert('Registerasi berhasil');window.location='Admin/index.php';
              </script";
            }
   }
  }
  
 ?>


<?php echo $usernameError //menampilan pesan Error Username ?>
<?php echo $passwordError //menampilkan pesan Error password?>
<?php echo $levelError //menampilkan pesan Error password?>

              <form  method="post" class="user">
                <div class="form-group">
                  <input type="text" name="nama_user" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukkan Nama" value="<?php echo $nama_user ?>" required oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukkan Username" value="<?php echo $username ?>" required oninvalid="this.setCustomValidity('Username harus diisi')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                  <input type="text" name="level" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukkan level" value="<?php echo $level ?>" required oninvalid="this.setCustomValidity('jenis level harus diisi')" oninput="setCustomValidity('')">
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password" required oninvalid="this.setCustomValidity('Password harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Konfimasi Password" required oninvalid="this.setCustomValidity('Konfimasi password harus diisi')" oninput="setCustomValidity('')">
                  </div>
                </div>
                <button name="register" class="btn btn-facebook btn-user btn-block">
                 Daftar
               </button> 
               
               
              </form>
              <br>
              <div class="text-center">
                  <p>Sudah punya akun? &nbsp;<a class="small" href="index.php" style="font-weight: bold; text-decoration: none;">Login</a></p>
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
