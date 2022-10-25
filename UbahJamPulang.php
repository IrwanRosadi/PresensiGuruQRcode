<?php 
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>



<?php
//supaya teks yg diinput pada form tidak hilang
$id_jam_pulang="";
$jam_pulang="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    $id_jam_pulangError="";
    $jam_pulangError="";
    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    $id_jam_pulang_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $id_jam_pulang=$_POST['id_jam_pulang'];
        $jam_pulang=$_POST['jam_pulang'];
        /*End utk menghilangkan validasi error jika form sudah terisi*/

        //Langkah 2 : Pesan error jika form belum diisi (validasi )
        if(empty($id_jam_pulang)){

            $id_jam_pulangError="<font color='red'>id jam pulang harus diisi</font>";
        }
            //validasi kode kelas harus diisi dgn angka
            elseif(!is_numeric($id_jam_pulang)){
                $id_jam_pulangError=false;
                $id_jam_pulangError="<font color='red'>Id jam pulang harus angka</font>";
            }
            //validasi input kode kelas harus 4 angka
            elseif(strlen($id_jam_pulang)>1){
                $id_jam_pulang_valid=false;
                $id_jam_pulangError="<font color='red'>jam pulang harus 1 angka</font>";
            }
        if(empty($jam_pulang)){

            $jam_pulangError="
            <font color='red'>Jam pulang harus diisi</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($id_jam_pulang) and !empty($jam_pulang)) {
            
            /*Proses penyimpanan ke database */
            $ubah="UPDATE tb_jam_pulang set id_jam_pulang='$id_jam_pulang', 
                    jam_pulang='$jam_pulang'
                    where id_jam_pulang='$id_jam_pulang'";
            $query = mysqli_query($koneksi, $ubah);
            if($query){
                echo "<script> alert('Data berhasil disimpan') </script>";
                echo "<script>location='TampilJamPulang.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal Disimpan') </script>";
                echo "<script>location='UbahJamPulang.php'</script>";
            }
            /*End Proses penyimpanan ke database */  

        }
     /* end pesan jika form belum diisi (validasi )*/  
     }   
?>



<!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Jam Pulang</h1>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            
            </div>
            <div class="card-body">
                <div class="table-responsive">
<?php
    // mengambil data sesuai dengan id
    $id_jam_pulang = $_GET['id_jam_pulang'];
    $data = mysqli_query($koneksi,"select * from tb_jam_pulang where id_jam_pulang='$id_jam_pulang'");
    $aaa = mysqli_fetch_array($data)
?>
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal text-gray-900">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">ID Jam Pulang<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_jam_pulang" class="form-control" value="<?php echo $aaa['id_jam_pulang']; ?>" placeholder="Masukkan id jam pulang" readonly>
                                <?php echo $id_jam_pulangError;?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Jam Pulang<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="jam_pulang" class="form-control" value="<?php echo $aaa['jam_pulang']; ?>" placeholder="Masukkan jam Pulang">
                                <?php echo $jam_pulangError;?>
                                <p style="color:#867D7B; font-style:italic;">Jam pulang diisi dengan format jam, menit dan detik. Contoh 07:15:00</p>
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