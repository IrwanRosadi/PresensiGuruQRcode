<?php 
     require_once 'Layout/Header.php'; 
    require_once 'Koneksi.php';
 ?>


<?php
// mengambil data sesuai dengan id
   $id_PTK= $_GET['id_PTK'];
   $query=mysqli_query($koneksi,"SELECT * FROM tb_PTK  WHERE id_PTK='$id_PTK'");
   $result=mysqli_fetch_array($query); 
?>

<?php
//supaya teks yg diinput pada form tidak hilang
$nama_PTK="";
$jk_PTK="";
$jabatan_PTK="";
$jenis_PTK="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    $nama_PTKError="";
    $jk_PTKError="";
    $jabatan_PTKError="";
    $jenis_PTKError="";
    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    $nama_PTK_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $id_PTK         =$_POST['id_PTK'];
        $nama_PTK       =addslashes($_POST['nama_PTK']);
        $jk_PTK         =$_POST['jk_PTK'];
        $jabatan_PTK    =$_POST['jabatan_PTK'];
        $jenis_PTK      =$_POST['jenis_PTK'];
        /*End utk menghilangkan validasi error jika form sudah terisi*/

            
        if(empty($nama_PTK)){
            $nama_PTKError="<font color='red'>Nama harus diisi</font>";
        }
            //validasi input nama harus huruf/titik dan sepasi
            elseif(!preg_match("/^[a-zA-Z .,]*$/", $nama_PTK)){
                $nama_PTK_valid=false;
                $nama_PTKError="<font color='red'>Nama tidak boleh menggunakan angka</font>";
            }
        if(empty($jk_PTK)){
             $jk_PTKError="<font color='red'>Jenis Kelamin harus dipilih</font>";
         }
         if(empty($jabatan_PTK)){
            $jabatan_PTKError="<font color='red'>Jabatan harus dipilih</font>";
        }
        if(empty($jenis_PTK)){
            $jenis_PTKError="<font color='red'>Jenis PTK harus dipilih</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($id_PTK) and !empty($nama_PTK) and !empty($jk_PTK) and !empty($jabatan_PTK) and $nama_PTK_valid) {
            
            /*Proses ubah ke database */
            $ubah = "UPDATE tb_PTK SET 
              id_PTK = '".$_POST['id_PTK']."',
              nama_PTK = '".addslashes($_POST['nama_PTK'])."',
              jk_PTK = '".$_POST['jk_PTK']."',
              jabatan_PTK = '".$_POST['jabatan_PTK']."',
              jenis_PTK = '".$_POST['jenis_PTK']."' 
              WHERE id_PTK = '".$_GET['id_PTK']."'";

            $query = mysqli_query($koneksi, $ubah);
            if($query){
                echo "<script> alert('Data berhasil diubah') </script>";
                echo "<script>location='TampilPTK.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal diubah') </script>";
                echo "<script>location='UbahPTK.php'</script>";
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
  <h1 class="h3 mb-0 text-gray-800">Ubah Data Pendidik dan Tenaga Kependidikan</h1>
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
                                <label for="text-input" class=" form-control-label">ID PTK <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_PTK" class="form-control" value="<?php echo $result['id_PTK'] ?>" placeholder="" readonly>
                                
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nama PTK <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="nama_PTK" class="form-control" value="<?php echo $result['nama_PTK'] ?>" autofocus required oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                <?php echo $nama_PTKError; ?>
                            </div> 
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin <font color="red">*</font></legend>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <!--tambahkan yg ini supaya bari 35 tdk error -->
                                        <input class="form-check-input" type="radio" name="jk_PTK" id="gridRadios1" value="" checked hidden>
                                        <!-- End -->
                                        <input class="form-check-input" type="radio" name="jk_PTK" id="gridRadios1" value="L" <?php if($result['jk_PTK']=='L') echo 'checked'?>>
                                         
                                      
                                        <label class="form-check-label" for="gridRadios1">L</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                        <input class="form-check-input" type="radio" name="jk_PTK" id="gridRadios2" value="P" <?php if($result['jk_PTK']=='P') echo 'checked'?>>
                                        <label class="form-check-label" for="gridRadios2">P</label> 
                                    </div>
                                   <?php echo $jk_PTKError; ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Jabatan<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="jabatan_PTK" id="select" class="form-control" >
                                    <option value="<?php echo $result['jabatan_PTK'] ?>"><?php echo $result['jabatan_PTK'] ?></option>
                                    <option value="Kepala Sekolah" <?php if($jabatan_PTK=='Kepala Sekolah'){
                                        echo "selected='selected'";}?>>Kepala Sekolah</option>
                                    <option value="Waka. Kurikulum" <?php if($jabatan_PTK=='Waka. Kurikulum'){
                                        echo "selected='selected'";}?>>Waka. Kurikulum</option>
                                    <option value="Waka. Kesiswaan" <?php if($jabatan_PTK=='Waka. Kesiswaan'){
                                        echo "selected='selected'";}?>>Waka. Kesiswaan</option>    
                                    <option value="Waka. Sarana" <?php if($jabatan_PTK=='Waka. Sarana'){
                                        echo "selected='selected'";}?>>Waka. Sarana</option>  
                                    <option value="Waka. Humas" <?php if($jabatan_PTK=='Waka. Humas'){
                                        echo "selected='selected'";}?>>Waka. Humas</option>  
                                    <option value="Kasubag TU" <?php if($jabatan_PTK=='Kasubag TU'){
                                        echo "selected='selected'";}?>>Kasubag TU</option>  
                                    <option value="Bag. Kepegawaian" <?php if($jabatan_PTK=='Bag. Kepegawaian'){
                                        echo "selected='selected'";}?>>Bag. Kepegawaian</option>  
                                    <option value="Bag. Inventaris" <?php if($jabatan_PTK=='Bag. Inventaris'){
                                        echo "selected='selected'";}?>>Bag. Inventaris</option>  
                                    <option value="Bag. Kesiswaan" <?php if($jabatan_PTK=='Bag. Kesiswaan'){
                                        echo "selected='selected'";}?>>Bag. Kesiswaan</option>  
                                    <option value="Bag. Agendaris" <?php if($jabatan_PTK=='Bag. Agendaris'){
                                        echo "selected='selected'";}?>>Bag. Agendaris</option> 
                                    <option value="Tenaga Administrasi Sekolah" <?php if($jabatan_PTK=='Tenaga Administrasi Sekolah'){
                                        echo "selected='selected'";}?>>Tenaga Administrasi Sekolah</option>
                                    <option value="Guru Mata Pelajaran" <?php if($jabatan_PTK=='Wali Kelas'){
                                        echo "selected='selected'";}?>>Guru Mata Pelajaran</option>   
                                    <option value="Guru BK" <?php if($jabatan_PTK=='Guru BK'){
                                        echo "selected='selected'";}?>>Guru BK</option>      
                                </select> 
                                <?php echo $jabatan_PTKError; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Jenis PTK<font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="jenis_PTK" id="select" class="form-control" >
                                    <option value="<?php echo $result['jenis_PTK'] ?>"><?php echo $result['jenis_PTK'] ?></option>
                                    <option value="Guru" <?php if($jenis_PTK=='Guru'){
                                        echo "selected='selected'";}?>>Guru</option>
                                    <option value="Pegawai" <?php if($jenis_PTK=='Pegawai'){
                                        echo "selected='selected'";}?>>Pegawai</option>   
                                </select> 
                                <?php echo $jenis_PTKError; ?>
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