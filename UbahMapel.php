<?php 
    require_once 'Layout/Header.php'; 
    require_once 'Koneksi.php';
 ?>


<?php
// mengambil data sesuai dengan kode mapel
   $kode_mapel= $_GET['kode_mapel'];
   $query=mysqli_query($koneksi,"SELECT * FROM tb_mapel WHERE kode_mapel='$kode_mapel'");
   $result=mysqli_fetch_array($query); 
?>

<?php
//supaya teks yg diinput pada form tidak hilang
// $kode_mapel="";
$mapel="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    // $kode_mapelError="";
    $mapelError="";
    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    // $nama_kelas_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $kode_mapel=$_POST['kode_mapel'];
        $mapel=$_POST['mapel'];
        /*End utk menghilangkan validasi error jika form sudah terisi*/

        //Langkah 2 : Pesan error jika form belum diisi (validasi )
        // if(empty($kode_mapel)){

        //     $kode_mapelError="<font color='red'>Kode kelas harus diisi</font>";
        // }
        //     //validasi kode kelas harus diisi dgn angka
        //     elseif(!is_numeric($kode_mapel)){
        //         $kode_mapel_valid=false;
        //         $kode_mapelError="<font color='red'>Kode kelas harus angka</font>";
        //     }
        //     //validasi input kode kelas harus 4 angka
        //     elseif(strlen($kode_kelas)<4 or strlen($kode_mapel)>4){
        //         $kode_mapel_valid=false;
        //         $kode_mapelError="<font color='red'>Kode kelas harus 2 angka</font>";
        //     }
        //     //validasi kode kelas yg diinput tdk boleh sama
        //     else {
        //         $a=mysqli_query($koneksi, "SELECT* FROM tb_kelas where kode_mapel='$kode_mapel'");
        //         $b=mysqli_num_rows($a);
        //         if ($b>0) {
        //             $kode_kelas_valid=false;
        //             $kode_kelasError="
        //             <font color='red'>Kode kelas sudah terdaftar</font>";
        //         }
        //     }
        if(empty($mapel)){

            $mapelError="
            <font color='red'>Mata Pelajaran harus dipilih</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($kode_mapel) and !empty($mapel)) {
            
            /*Proses Ubah ke database */
            $ubah="UPDATE tb_mapel SET 
                kode_mapel = '".$_POST['kode_mapel']."',
                mapel = '".$_POST['mapel']."'
                WHERE kode_mapel = '".$_GET['kode_mapel']."'";
                
            $query = mysqli_query($koneksi, $ubah);
            if($query){
                echo "<script> alert('Data berhasil diubah') </script>";
                echo "<script>location='TampilMapel.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal diubah') </script>";
                echo "<script>location='UbahMapel.php'</script>";
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
  <h1 class="h3 mb-0 text-gray-800">Ubah Mata Pelajaran</h1>
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
                                <label for="text-input" class=" form-control-label">Kode Mata Pelajaran <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="kode_mapel" class="form-control" value="<?php echo $result['kode_mapel']; ?>" placeholder="" readonly>
                                
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Mata Pelajaran <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="mapel" id="select" class="form-control" >
                                    <option value="<?php echo $result['mapel']; ?>"><?php echo $result['mapel']; ?></option>
                                    <option value="Pendidikan Agama Islam dan Budi Pekerti" <?php if($mapel=='Pendidikan Agama Islam dan Budi Pekerti'){
                                        echo "selected='selected'";}?>>MP001 - Pendidikan Agama Islam dan Budi Pekerti</option>
                                    <option value="Pendidikan Pancasila dan Kewarganegaraan " <?php if($mapel=='Pendidikan Pancasila dan Kewarganegaraan '){
                                        echo "selected='selected'";}?>>MP002 - Pendidikan Pancasila dan Kewarganegaraan </option>
                                    <option value="Pendidikan Jasmani, Olahraga, dan Kesehatan" <?php if($mapel=='Pendidikan Jasmani, Olahraga, dan Kesehatan'){
                                         echo "selected='selected'";}?>>MP003 - Pendidikan Jasmani, Olahraga, dan Kesehatan</option>
                                    <option value="Bahasa Indonesia" <?php if($mapel=='Bahasa Indonesia'){
                                        echo "selected='selected'";}?>>MP004 - Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris" <?php if($mapel=='Bahasa Inggris'){
                                        echo "selected='selected'";}?>>MP005 - Bahasa Inggris</option>
                                    <option value="Biologi" <?php if($mapel=='Biologi'){
                                        echo "selected='selected'";}?>>MP006 - Biologi</option>
                                    <option value="Fisika" <?php if($mapel=='Fisika'){
                                        echo "selected='selected'";}?>>MP007 - Fisika</option>
                                    <option value="Matematika Umum" <?php if($mapel=='Matematika Umum'){
                                        echo "selected='selected'";}?>>MP008 - Matematika Umum</option>
                                    <option value="Matematika Peminatan" <?php if($mapel=='Matematika Peminatan'){
                                        echo "selected='selected'";}?>>MP009 - Matematika Peminatan</option>
                                    <option value="Kimia" <?php if($mapel=='Kimia'){
                                        echo "selected='selected'";}?>>MP010 - Kimia</option>
                                    <option value="Geografi" <?php if($mapel=='Geografi'){
                                        echo "selected='selected'";}?>>MP011 - Geografi</option>
                                    <option value="Ekonomi" <?php if($mapel=='Ekonomi'){
                                        echo "selected='selected'";}?>>MP012 - Ekonomi</option>
                                    <option value="Sejarah" <?php if($mapel=='Sejarah'){
                                        echo "selected='selected'";}?>>MP013 - Sejarah</option>
                                    <option value="Sosiologi" <?php if($mapel=='Sosiologi'){
                                        echo "selected='selected'";}?>>MP014 - Sosiologi</option>
                                    <option value="Seni Budaya" <?php if($mapel=='Seni Budaya'){
                                        echo "selected='selected'";}?>>MP015 - Seni Budaya</option>
                                    <option value="Informatika" <?php if($mapel=='Informatika'){
                                        echo "selected='selected'";}?>>MP016 - Informatika</option>
                                    <option value="Bahasa Arab" <?php if($mapel=='Bahasa Arab'){
                                        echo "selected='selected'";}?>>MP017 - Bahasa Arab</option>
                                    <option value="Prakarya dan Kewirausahaan" <?php if($mapel=='Prakarya dan Kewirausahaan'){
                                        echo "selected='selected'";}?>>MP018 - Prakarya dan Kewirausahaan</option>
                                    <option value="Muatan Lokal Bahasa Daerah" <?php if($mapel=='Muatan Lokal Bahasa Daerah'){
                                        echo "selected='selected'";}?>>MP019 - Muatan Lokal Bahasa Daerah</option>
                                </select> 
                                <?php echo $mapelError; ?>
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