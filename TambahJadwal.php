<?php 
    require_once 'Layout/Header.php'; 
    require_once 'Koneksi.php';
 ?>

<?php
// Mencari data (kode) yang paling besar (terakhir) dari database
$query = mysqli_query($koneksi, "SELECT max(id_jadwal) as max_kode FROM tb_jadwal");
$data = mysqli_fetch_array($query);
// Sudah dapat nih gan
$kodemapel = $data['max_kode'];

// Oke sekarang kita ambil bagian angkanya saja dan membuang string yang ada diawal
$no = substr($kodemapel, 1, 3);
// Contoh kodenya 'B0001'
// Setelah dibuang string 'B', hasilnya menjadi '0001'
// maksud substr diatas adalah mengambil 4 katakter dimulai dari index ke 1 (karakter ke-2)

// Selanjutnya kita convert ke tipe data Integer agar bisa di Increment (ditambah)
$no = (int) $no;
// Ditambah 1
$no += 1;
/**
 * Atau bisa gunakan cara ini 
 * $no++;
 * $no = $no + 1;
 * bebas ya, silahkan pilih sesuai selera :v
 */

//  Oke next kita bakal generate kode otomatisnya
$str = '';

// perintah sprintf("%04s", $no); digunakan untuk memformat string sebanyak 4 karakter
// misal sprintf("%04s", 2); maka akan dihasilkan '0002'
// atau misal sprintf("%04s", 1); maka akan dihasilkan string '0001'
$newKode = $str . sprintf("%02s", $no);

// tampilkan kode otomatis
// echo $newKode;
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
    $id_jadwal_valid=true;

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
             //validasi nim harus diisi dgn angka
             elseif(!is_numeric($id_jadwal)){
                $id_jadwal_valid=false;
                $id_jadwalError="<font color='red'>id jadwal harus angka</font>";
            }
            //validasi nim harus diisi dgn satu angka
            elseif(strlen($id_jam)>2){
                $id_jadwal_valid=false;
                $id_jadwalError="<font color='red'>Id jadwal tidak boleh lebih dua angka</font>";
            }
            else {
            $a=mysqli_query($koneksi, "SELECT* FROM tb_jadwal where id_jadwal='$id_jadwal'");
            $b=mysqli_num_rows($a);
            if ($b>0) {
                $id_jadwal_valid=false;
                $id_jadwalError="<font color='red'>Id jadwal sudah terinput sebelumnya</font>";
                    }
                }
        if(empty($hari)){
             $hariError="<font color='red'>Hari harus dipilih</font>";
        }
        if(empty($id_jam)){
            $id_jamError="<font color='red'>Jam mengajar harus dipilih</font>";
        }
        if(empty($kode_kelas)){
            $kode_kelasError="<font color='red'>kelas harus dipilih</font>";
        }
        if(empty($kode_mapel)){
            $kode_mapelError="<font color='red'>Mapel harus dipilih</font>";
        }
        if(empty($id_PTK)){
            $id_PTKError="<font color='red'>PTK harus dipilih</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($id_jadwal) and !empty($hari) and !empty($id_jam) and !empty($kode_kelas) and !empty($kode_mapel) and !empty($id_PTK)) {
            
            // cek apakah ada jadwal yg sama ditambahkan, jik ada maka penyimpanan akan dicegah
            $result = mysqli_query($koneksi, "SELECT id_PTK, hari, id_jam FROM tb_jadwal WHERE id_PTK = '$id_PTK' AND hari = '$hari' AND id_jam = '$id_jam'");
            if (mysqli_fetch_array($result)) {
                echo "<script> alert('Maaf, jadwal dengan ID PTK = $id_PTK, hari = $hari dan id_jam = $id_jam sudah teriput sebelumnya') </script>";
                echo "<script>location='TambahJadwal.php'</script>";

                return false;
            }

            /*Proses penyimpanan ke database */
            $input="INSERT INTO tb_jadwal VALUES ('$id_jadwal','$hari','$id_jam','$kode_kelas', '$kode_mapel', '$id_PTK')";
            $query = mysqli_query($koneksi, $input);
            if($query){
                echo "<script> alert('Data berhasil disimpan') </script>";
                echo "<script>location='TampilJadwal.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal Disimpan') </script>";
                echo "<script>location='TambahJadwal.php'</script>";
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
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Jadwal</h1>
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
                                <label for="text-input" class=" form-control-label">ID Jadwal <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="id_jadwal" class="form-control" value="<?php echo $id_jadwal; ?>" autofocus placeholder="Masukkan ID Jadwal" >
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
                                    <option value="">-- Pilih PTK --</option>
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
                                    <option value="">-- Pilih Hari --</option>
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
                                    <option value="">-- Pilih Jam Mengajar --</option>
                                    <?php
                                        $sql = "SELECT * FROM tb_jam";
                                        $query = mysqli_query($koneksi,$sql);
                                        while($data=mysqli_fetch_array($query)){
                                            echo "<option value='$data[id_jam]'>
                                            $data[id_jam] - $data[jam_mulai] - $data[jam_berakhir] </option>";
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
                                    <option value="">-- Pilih Mata Pelajaran --</option>
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
                                    <option value="">-- Pilih Kelas --</option>
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