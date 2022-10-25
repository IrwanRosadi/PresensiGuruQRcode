<?php 
    require_once 'Layout/Header.php'; 
    require_once 'Koneksi.php';
 ?>

<?php
// mengambil data sesuai dengan kode kelas
   $id_jam= $_GET['id_jam'];
   $query=mysqli_query($koneksi,"SELECT * FROM tb_jam WHERE id_jam='$id_jam'");
   $result=mysqli_fetch_array($query); 
?>





<?php
//supaya teks yg diinput pada form tidak hilang
$id_jam="";
$jam_mulai="";
$jam_berakhir="";
$toleransi="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    // $kode_mapelError="";
    $jam_mulaiError="";
    $jam_berakhirError="";
    $id_jamError="";
    $toleransiError="";


    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    // $nama_kelas_valid=true;
    // harus menginput angka pd form id jam mulai
    $id_jam_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $id_jam             = $_POST['id_jam'];
        $jam_mulai          = $_POST['jam_mulai'];
        $jam_berakhir       = $_POST['jam_berakhir'];
        $toleransi         = $_POST['toleransi'];

        /*End utk menghilangkan validasi error jika form sudah terisi*/


        if(empty($id_jam)){

            $id_jamError="<font color='red'>Id jam mengajar harus diisi</font>";
        }

            //validasi nim harus diisi dgn angka
            elseif(!is_numeric($id_jam)){
                $id_jam_valid=false;
                $id_jamError="<font color='red'>Id jam mengajar harus angka</font>";
            }
            //validasi nim harus diisi dgn satu angka
            elseif(strlen($id_jam)<2 or strlen($id_jam)>2){
                $id_jam_valid=false;
                $id_jamError="<font color='red'>Id jam mulai mengajar harus satu angka</font>";
            }
            else {
            $a=mysqli_query($koneksi, "SELECT* FROM tb_jam where id_jam='$id_jam'");
            $b=mysqli_num_rows($a);
            if ($b>0) {
                $id_jam_valid=false;
                $id_jamError="<font color='red'>Id jam mengajar sudah terinput sebelumnya</font>";
                    }
                }

        if(empty($jam_mulai)){

            $jam_mulaiError="<font color='red'>Jam mulai mengajar harus diisi</font>";
        }
        
        if(empty($jam_berakhir)){

            $jam_berakhirError="<font color='red'>Jam berakhir mengajar harus diisi</font>";
        }

        if(empty($toleransi)){

            $toleransiError="<font color='red'>toleransi keterlambatan harus diisi</font>";
        }
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($id_jam) and !empty($jam_mulai) and !empty($jam_berakhir) and !empty($toleransi)) {
            
            /*Proses penyimpanan ke database */
            $ubah="UPDATE tb_jam SET 
                id_jam = '".$_POST['id_jam']."',
                jam_mulai = '".$_POST['jam_mulai']."',
                jam_berakhir = '".$_POST['jam_berakhir']."',
                toleransi = '".$_POST['toleransi']."'
                WHERE id_jam = '".$_GET['id_jam']."'";

            $query = mysqli_query($koneksi, $ubah);
            if($query){
                echo "<script> alert('Data berhasil diubah') </script>";
                echo "<script>location='TampilJam.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal diubah') </script>";
                echo "<script>location='UbahJam.php'</script>";
            }
            /*End Proses penyimpanan ke database */  

        }
     }   
?>



<!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Jam Mengajar</h1>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal text-gray-900">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">ID Jam <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_jam" class="form-control" value="<?php echo $result['id_jam'] ?>" readonly>
                               
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Jam Mulai <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="jam_mulai" class="form-control" value="<?php echo $result['jam_mulai'] ?>">
                                <?php echo $jam_mulaiError; ?>
                                <!-- <p style="color:#867D7B; font-style:italic;">Jam mulai mengajar diisi dengan format jam, menit dan detik. Contoh 07:15:00</p> -->
                            </div> 
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Jam Berakhir <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="jam_berakhir" class="form-control" value="<?php echo $result['jam_berakhir'] ?>">
                                <?php echo $jam_berakhirError; ?>
                            </div> 
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">toleransi keterlambatan<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="toleransi" class="form-control" value="<?php echo $result['toleransi'] ?>">
                                <?php echo $toleransiError; ?>
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