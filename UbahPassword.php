<?php 
    // session_start();
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>

<?php
$password_lama ="";
$password_baru ="";
$kon_password_baru ="";
?>

<?php
 if (isset($_POST["simpan"])) {
    // $id_user = $_POST['id_user'];
    $password_lama = $_POST['password_lama'];
    $username = $_SESSION['username'];

    // $passwordlama = $_POST['passwordlama'];
    
    $password_baru = $_POST['password_baru'];
    $kon_password_baru = $_POST['kon_password_baru'];
    
    // $konfirmasipassword = $_POST['konfirmasipassword'];
    
    // $username = $_POST['username'];
    
    $cekuser = "SELECT * from tb_user where username = '$username' and password = '$password_lama'";
    
    $querycekuser = mysqli_query($koneksi, $cekuser);
    
    $count = mysqli_num_rows($querycekuser);
    
    if ($count >= 1){

        if ($password_baru == $kon_password_baru) {
            $updatepassword = "UPDATE tb_user set password = '$password_baru' where username = '$username'";
    
            $updatequery = mysqli_query($koneksi, $updatepassword);
            
            if($updatequery){
            
                echo "<script> alert('Password berhasil diubah') </script>";
                echo "<script>location='UbahPassword.php'</script>";
            
            }
        }else{
                echo "<script> alert('Maaf, Password baru dan konfirmasi password tidak sesuai') </script>";
                echo "<script>location='UbahPassword.php'</script>";
            }
        

    }else{
        echo "<script> alert('Maaf password lama tidak terdaftar') </script>";
        echo "<script>location='UbahPassword.php'</script>";
    }

}  
    
?>

<!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
            
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal text-gray-900">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Password Lama<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="password_lama" class="form-control" value="<?php echo $password_lama ?>" required oninvalid="this.setCustomValidity('Silahkan masukkan password lama !')" oninput="setCustomValidity('')" autocomplete="off"> 
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Password Baru<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="password_baru" class="form-control" value="<?php echo $password_baru; ?>" required oninvalid="this.setCustomValidity('Silahkan masukkan password baru !')" oninput="setCustomValidity('')" autocomplete="off"> 
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Konfirmasi Password Baru<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="kon_password_baru" class="form-control" value="<?php echo $kon_password_baru; ?>" required oninvalid="this.setCustomValidity('Silahkan masukkan konfirmasi password baru !')" oninput="setCustomValidity('')" autocomplete="off"> 
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col- col-md-3">
                            
                            </div>
                            <div class="col- col-md-9">
                            <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> BATAL</button>
                            </div>
                        </div>
                    </form><br>
                 </div>
            </div><br>

         </div>
    </div>

    <br><br><br><br><br>

<?php 
    require_once 'Layout/Footer.php';
 ?>