<?php 
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>

<?php
// Mencari data (kode) yang paling besar (terakhir) dari database
$query = mysqli_query($koneksi, "SELECT max(kode_kelas) as max_kode FROM tb_kelas");
$data = mysqli_fetch_array($query);
// Sudah dapat nih gan
$kodeBrg = $data['max_kode'];

// Oke sekarang kita ambil bagian angkanya saja dan membuang string yang ada diawal
$no = substr($kodeBrg, 1, 3);
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
$str = 'K';

// perintah sprintf("%04s", $no); digunakan untuk memformat string sebanyak 4 karakter
// misal sprintf("%04s", 2); maka akan dihasilkan '0002'
// atau misal sprintf("%04s", 1); maka akan dihasilkan string '0001'
$newKode = $str . sprintf("%03s", $no);

// tampilkan kode otomatis
// echo $newKode;
?>

<?php
//supaya teks yg diinput pada form tidak hilang
$kode_kelas="";
$nama_kelas="";
//End supaya teks yg diinput pada form tidak hilang

// Langkah 1 : pesan jika form belum diisi (validasi )
    $kode_kelasError="";
    $nama_kelasError="";
    //validasi agar inputan tdk tersimpan ke database jika huruf atau kurang/lebih dr 4 yg dinputkan pd form Kode kelas
    // $nama_kelas_valid=true;

//end Langkah 1 : pesan jika form belum diisi (validasi

    if(isset($_POST['simpan'])){
        /*Langkah 3 : Utk menghilangkan validasi error jika form sudah terisi*/
        $kode_kelas=$_POST['kode_kelas'];
        $nama_kelas=$_POST['nama_kelas'];
        /*End utk menghilangkan validasi error jika form sudah terisi*/

        //Langkah 2 : Pesan error jika form belum diisi (validasi )
        if(empty($kode_kelas)){

            $kode_kelasError="<font color='red'>Kode kelas harus diisi</font>";
        }
            //validasi kode kelas harus diisi dgn angka
            elseif(!is_numeric($kode_kelas)){
                $kode_kelas_valid=false;
                $kode_kelasError="<font color='red'>Kode kelas harus angka</font>";
            }
            //validasi input kode kelas harus 4 angka
            elseif(strlen($kode_kelas)<2 or strlen($kode_kelas)>2){
                $kode_kelas_valid=false;
                $kode_kelasError="<font color='red'>Kode kelas harus 2 angka</font>";
            }
            //validasi kode kelas yg diinput tdk boleh sama
            else {
                $a=mysqli_query($koneksi, "SELECT* FROM tb_kelas where kode_kelas='$kode_kelas'");
                $b=mysqli_num_rows($a);
                if ($b>0) {
                    $kode_kelas_valid=false;
                    $kode_kelasError="
                    <font color='red'>Kode kelas sudah terdaftar</font>";
                }
            }
        if(empty($nama_kelas)){

            $nama_kelasError="
            <font color='red'>Kelas harus dipilih</font>";
        }
        
        /*Cek semua input sudah terisi/belum, jika semua form sudah terisi maka akan terjadi proses 
        penyimpanan ke database*/
        if (!empty($kode_kelas) and !empty($nama_kelas)) {
            
            /*Proses penyimpanan ke database */
            $input="INSERT INTO tb_kelas VALUES ('$kode_kelas','$nama_kelas')";
            $query = mysqli_query($koneksi, $input);
            if($query){
                echo "<script> alert('Data berhasil disimpan') </script>";
                echo "<script>location='TampilKelas.php'</script>";
            
            }
            else {
                echo "<script> alert('Data Gagal Disimpan') </script>";
                echo "<script>location='TambahKelas.php'</script>";
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
  <h1 class="h3 mb-0 text-gray-800">Tambah Data Kelas</h1>
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
                                <label for="text-input" class=" form-control-label">Kode Kelas <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="kode_kelas" class="form-control" value="<?php echo $newKode; ?>" placeholder="Masukkan Kode Kelas" readonly>
                                
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Kelas <font color="red">*</font></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="nama_kelas" id="select" class="form-control" >
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X IPA 1" <?php if($nama_kelas=='X IPA 1'){
                                        echo "selected='selected'";}?>>K001 - X IPA 1</option>
                                    <option value="X IPA 2" <?php if($nama_kelas=='X IPA 2'){
                                        echo "selected='selected'";}?>>K002 - X IPA 2</option>
                                    <option value="X IPA 3" <?php if($nama_kelas=='X IPA 3'){
                                        echo "selected='selected'";}?>>K003 - X IPA 3</option>
                                    <option value="X IPA 4" <?php if($nama_kelas=='X IPA 4'){
                                        echo "selected='selected'";}?>>K004 - X IPA 4</option>
                                    <option value="X IPA 5" <?php if($nama_kelas=='X IPA 5'){
                                        echo "selected='selected'";}?>>K005 - X IPA 5</option>
                                    <option value="X IPS 1" <?php if($nama_kelas=='X IPS 1'){
                                        echo "selected='selected'";}?>>K006 - X IPS 1</option>
                                    <option value="X IPS 2" <?php if($nama_kelas=='X IPS 2'){
                                        echo "selected='selected'";}?>>K007 - X IPS 2</option>
                                    <option value="X IPS 3" <?php if($nama_kelas=='X IPS 3'){
                                        echo "selected='selected'";}?>>K008 - X IPS 3</option>
                                    <option value="X IPS 4" <?php if($nama_kelas=='X IPS 4'){
                                        echo "selected='selected'";}?>>K009 - X IPS 4</option>
                                    <option value="X IPS 5" <?php if($nama_kelas=='X IPS 5'){
                                        echo "selected='selected'";}?>>K010 - X IPS 5</option>
                                    <option value="XI IPA 1" <?php if($nama_kelas=='XI IPA 1'){
                                        echo "selected='selected'";}?>>K011 - XI IPA 1</option>
                                    <option value="XI IPA 2" <?php if($nama_kelas=='XI IPA 2'){
                                        echo "selected='selected'";}?>>K012 - XI IPA 2</option>
                                    <option value="XI IPA 3" <?php if($nama_kelas=='XI IPA 3'){
                                        echo "selected='selected'";}?>>K013 - XI IPA 3</option>
                                    <option value="XI IPA 4" <?php if($nama_kelas=='XI IPA 4'){
                                        echo "selected='selected'";}?>>K014 - XI IPA 4</option>
                                    <option value="XI IPA 5" <?php if($nama_kelas=='XI IPA 5'){
                                        echo "selected='selected'";}?>>K015 - XI IPA 5</option>
                                    <option value="XI IPS 1" <?php if($nama_kelas=='XI IPS 1'){
                                        echo "selected='selected'";}?>>K016 - XI IPS 1</option>
                                    <option value="XI IPS 2" <?php if($nama_kelas=='XI IPS 2'){
                                        echo "selected='selected'";}?>>K017 - XI IPS 2</option>
                                    <option value="XI IPS 3" <?php if($nama_kelas=='XI IPS 3'){
                                        echo "selected='selected'";}?>>K018 - XI IPS 3</option>
                                    <option value="XI IPS 4" <?php if($nama_kelas=='XI IPS 4'){
                                        echo "selected='selected'";}?>>K019 - XI IPS 4</option>
                                    <option value="XI IPS 5" <?php if($nama_kelas=='XI IPS 5'){
                                        echo "selected='selected'";}?>>K020 - XI IPS 5</option>
                                    <option value="XII IPA 1" <?php if($nama_kelas=='XII IPA 1'){
                                        echo "selected='selected'";}?>>K021 - XII IPA 1</option>
                                    <option value="XII IPA 2" <?php if($nama_kelas=='XII IPA 2'){
                                        echo "selected='selected'";}?>>K022 - XII IPA 2</option>
                                    <option value="XII IPA 3" <?php if($nama_kelas=='XII IPA 3'){
                                        echo "selected='selected'";}?>>K023 - XII IPA 3</option>
                                    <option value="XII IPA 4" <?php if($nama_kelas=='XII IPA 4'){
                                        echo "selected='selected'";}?>>K024 - XII IPA 4</option>
                                    <option value="XII IPA 5" <?php if($nama_kelas=='XII IPA 5'){
                                        echo "selected='selected'";}?>>K025 - XII IPA 5</option>
                                    <option value="XII IPS" <?php if($nama_kelas=='XII IPS 1'){
                                        echo "selected='selected'";}?>>K026 - XII IPS 1</option>
                                    <option value="XII IPS 2" <?php if($nama_kelas=='XII IPS 2'){
                                        echo "selected='selected'";}?>>K027 - XII IPS 2</option>
                                    <option value="XII IPS 3" <?php if($nama_kelas=='XII IPS 3'){
                                        echo "selected='selected'";}?>>K028 - XII IPS 3</option>
                                    <option value="XII IPS 4" <?php if($nama_kelas=='XII IPS 4'){
                                        echo "selected='selected'";}?>>K029 - XII IPS 4</option>
                                    <option value="XII IPS 5" <?php if($nama_kelas=='XII IPS 5'){
                                        echo "selected='selected'";}?>>K030 - XII IPS 5</option>
                                </select> 
                                <?php echo $nama_kelasError; ?>
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