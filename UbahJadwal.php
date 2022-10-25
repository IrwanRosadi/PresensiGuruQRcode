<?php 
    require_once 'Layout/Header.php'; 
    require_once 'Koneksi.php';
 ?>


<?php
//supaya teks yg diinput pada form tidak hilang
$id_jadwal="";
$id_PTK="";
$hari="";
$id_jam="";
$kode_mapel="";
$kode_kelas="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    $id_jadwalError="";
   
    $hariError="";
    $id_jamError="";
    $kode_kelasError="";
    $kode_mapelError="";
    $id_PTKError="";
   
    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    // $nama_PTK_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $id_jadwal      =$_POST['id_jadwal'];
       
        $hari           =$_POST['hari'];
        $id_jam         =$_POST['id_jam'];
       
        $kode_kelas     =$_POST['kode_kelas'];
        $kode_mapel     =$_POST['kode_mapel'];
        $id_PTK         =$_POST['id_PTK'];
        /*End utk menghilangkan validasi error jika form sudah terisi*/

            
        if(empty($id_jadwal)){
            $id_jadwalError="<font color='red'>id jadwal harus diisi</font>";
        }
            //validasi input nama harus huruf/titik dan sepasi
            // elseif(!preg_match("/^[a-zA-Z .,]*$/", $nama_PTK)){
            //     $nama_PTK_valid=false;
            //     $nama_PTKError="<font color='red'>Nama tidak boleh menggunakan angka</font>";
            // }
        if(empty($hari)){
             $hariError="<font color='red'>Hari harus dipilih</font>";
        }
        if(empty($id_jam)){
            $id_jamError="<font color='red'>id jam harus diisi</font>";
        }
        if(empty($kode_kelas)){
            $kode_kelasError="<font color='red'>kode kelas harus dipilih</font>";
        }
        if(empty($kode_mapel)){
            $kode_mapelError="<font color='red'>kode mapel harus dipilih</font>";
        }
        if(empty($id_PTK)){
            $id_PTKError="<font color='red'>id PTK harus dipilih</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($id_jadwal) and !empty($hari) and !empty($id_jam) and !empty($kode_kelas) and !empty($kode_mapel) and !empty($id_PTK)) {
            
            /*Proses penyimpanan ke database */
            
            $ubah="update tb_jadwal set id_jadwal='$id_jadwal', 
                    hari='$hari', 
                    id_jam='$id_jam', 
                    kode_kelas='$kode_kelas',
                    kode_mapel='$kode_mapel', 
                    id_PTK='$id_PTK'
                    where id_jadwal='$id_jadwal'";

            $query = mysqli_query($koneksi, $ubah);
            if($query){
                echo "<script> alert('Data berhasil diubah') </script>";
                echo "<script>location='TampilJadwal.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal diubah') </script>";
                echo "<script>location='UbahJadwal.php'</script>";
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
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Jadwal</h1>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            
            </div>
            <div class="card-body">
                <div class="table-responsive">
<?php
// mengambil data sesuai dengan id
$id_jadwal = $_GET['id_jadwal'];
$data = mysqli_query($koneksi,"select * from tb_jadwal where id_jadwal='$id_jadwal'");
$result = mysqli_fetch_array($data)
?>
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal text-gray-900">
                    <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">ID Jadwal <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_jadwal" class="form-control" value="<?php echo $result['id_jadwal']; ?>" placeholder="Masukkan ID Jadwal" readonly>
                                <?php echo $id_jadwalError; ?>   
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">PTK <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_PTK" class="form-control" value=""  placeholder="Masukkan nama PTK">
                                
                            </div> 
                        </div> -->
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">PTK<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="id_PTK" id="select" class="form-control" >
                                    <option value="<?php echo $result['id_PTK']; ?>"><?php echo $result['id_PTK']; ?></option>
                                    <?php
                                        $sql = "SELECT * FROM tb_ptk";
                                        $query = mysqli_query($koneksi,$sql);
                                        while($data=mysqli_fetch_array($query)){
                                            echo "<option value='$data[id_PTK]'>
                                            $data[id_PTK] - $data[nama_PTK]  </option>";
                                        }
                                    ?> 
                                </select> 
                                <?php echo $id_PTKError; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Hari<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="hari" id="select" class="form-control" >
                                    <option value="<?php echo $result['hari']; ?>"><?php echo $result['hari']; ?></option>
                                    <option value="Monday" <?php if($hari=='Monday'){
                                        echo "selected='selected'";}?>>Monday - Senin</option>
                                    <option value="Tuesday" <?php if($hari=='Tuesday'){
                                        echo "selected='selected'";}?>>Tuesday - Selasa</option>
                                    <option value="Wednesday" <?php if($hari=='Wednesday'){
                                        echo "selected='selected'";}?>>Wednesday - Rabu</option> 
                                    <option value="Thursday" <?php if($hari=='Thursday'){
                                        echo "selected='selected'";}?>>Thursday - Kamis</option> 
                                    <option value="Friday" <?php if($hari=='Friday'){
                                        echo "selected='selected'";}?>>Friday - Jumat</option> 
                                    <option value="Saturday" <?php if($hari=='Saturday'){
                                        echo "selected='selected'";}?>>Saturday - Sabtu</option>        
                                </select> 
                                <?php echo $hariError; ?>
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Jam Mengajar<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_jam" class="form-control" value=""  placeholder="Masukkan ID Jam">
                                
                            </div> 
                        </div> -->
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Jam Mengajar<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="id_jam" id="select" class="form-control" >
                                    <option value="<?php echo $result['id_jam']; ?>"><?php echo $result['id_jam']; ?></option>
                                    <?php
                                        $sql = "SELECT * FROM tb_jam";
                                        $query = mysqli_query($koneksi,$sql);
                                        while($data=mysqli_fetch_array($query)){
                                            echo "<option value='$data[id_jam]'>
                                            $data[id_jam] - $data[jam_mulai] - $data[jam_berakhir]</option>";
                                        }
                                    ?> 
                                </select> 
                                <?php echo $id_jamError; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Kode Mata Pelajaran<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="kode_mapel" id="select" class="form-control" >
                                    <option value="<?php echo $result['kode_mapel']; ?>"><?php echo $result['kode_mapel']; ?></option>
                                    <?php
                                        $sql = "SELECT * FROM tb_mapel";
                                        $query = mysqli_query($koneksi,$sql);
                                        while($data=mysqli_fetch_array($query)){
                                            echo "<option value='$data[kode_mapel]'>
                                            $data[kode_mapel] - $data[mapel]  </option>";
                                        }
                                    ?> 
                                </select> 
                                <?php echo $kode_mapelError; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Kode Kelas<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="kode_kelas" id="select" class="form-control" >
                                    <option value="<?php echo $result['kode_kelas']; ?>"><?php echo $result['kode_kelas']; ?></option>
                                    <?php
                                        $sql = "SELECT * FROM tb_kelas";
                                        $query = mysqli_query($koneksi,$sql);
                                        while($data=mysqli_fetch_array($query)){
                                            echo "<option value='$data[kode_kelas]'>
                                            $data[kode_kelas] - $data[nama_kelas]  </option>";
                                        }
                                    ?> 
                                </select> 
                                <?php echo $kode_kelasError; ?>
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

    
<?php  
    require_once 'Layout/Footer.php';    
?>