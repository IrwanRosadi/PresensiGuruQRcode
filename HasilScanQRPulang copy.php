<?php
include_once 'Layout_User/H_User.php';
require_once 'Koneksi.php';
?>

<!-- content -->
<?php
// membuat id otomatis 
    $date = date( 'dmYHsa' ); // Tahun
    $get3number = substr( $date,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
     
     
    // mengambil data dari database untuk pengecekan no
    $get_data = mysqli_query( $koneksi, "SELECT * FROM tb_hasil_presensi" );
     
    // Check
    $check = mysqli_num_rows( $get_data ); // untuk mengecek apakah di table barang "no/ kode" sudah ada atau belum
     
    $kd = ''; // mendefinisikan variable kd ( $kd ) dengan value null/ kosong. Hal ini sangatlah penting jika pada suatu kondisi tertentu nilai variable blm di definisikan, maka akan menimbulkan munculnya error/ notice
     
    if ( empty( $check ) ) { // Jk kode blm ada maka
    $kd = 1; // kode dimulai dr 1
    } else { // jk sudah ada maka
    $kd = $check + 1; // kode sebelumnya ditambah 1.
    }
?>

<?php
// membuat id otomatis 
    $date2 = date( 'dmY' ); // Tahun
    $get3number2 = substr( $date2,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
     
     
    // mengambil data dari database untuk pengecekan no
    $get_data2 = mysqli_query( $koneksi, "SELECT * FROM tb_presensi_pulang" );
     
    // Check
    $check2 = mysqli_num_rows( $get_data2 ); // untuk mengecek apakah di table barang "no/ kode" sudah ada atau belum
     
    $kd2 = ''; // mendefinisikan variable kd ( $kd ) dengan value null/ kosong. Hal ini sangatlah penting jika pada suatu kondisi tertentu nilai variable blm di definisikan, maka akan menimbulkan munculnya error/ notice
     
    if ( empty( $check2 ) ) { // Jk kode blm ada maka
    $kd2 = 1; // kode dimulai dr 1
    } else { // jk sudah ada maka
    $kd = $check2 + 1; // kode sebelumnya ditambah 1.
    }
?>

    <!-- Begin Page Content -->
<div class="container">
    <div class="card-body">
        <?php
            $a = "SELECT * FROM tb_ptk WHERE id_ptk='$_POST[noid]'"; //noid berasal dari file index validasi-QR code artinya sama dgn id
            $b = mysqli_query($koneksi, $a);
            $c = mysqli_num_rows($b);
            
            // jika QR code tidak ditemukan, maka akan ada notif
                if ($c < 1) {
            ?>
           <br><br><br><br><br><br>
                <!-- alert -->
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="alert alert-danger">
                        Data tidak ditemukan.
                    </div>
                </div>
                <!-- /alert -->

            <!-- <script> alert('Data tidak ditemukan') </script>; -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
            <script>
                var sound = new Howl({
                src: ['suara/QRcode_kosong.mp3'],
                volume: 0.5,
                onend: function () {
                window.location='validasi-QR-Pulang';
                }
                });
                sound.play()
            </script>

        <?php      
            } else { //jika QR code ditemukan
        ?>
            
        <?php 

            $x = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
            $y = mysqli_query($koneksi,$x);
            $z = mysqli_fetch_array($y); 
            
        ?>
           <br><br><br><br><br><br>

            <div class="col-xl-5 col-md-6 mb-4">
            <div class="card text-dark bg-light mb-3">
                <!-- <div class="card-header bg-primary shadow h-100 py-2 text-white">
                    Featured
                </div> -->
                <div class="card-body shadow h-100 py-2"><br>
                <div class="text-xs font-weight-bold text-primary text-propercase mb-1"><h5><b><?php echo $z['nama_PTK'] ?></b></h5></div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>ID PTK</b> &nbsp;&nbsp;&nbsp;: <?php echo $z['id_PTK'] ?></h6></div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>Jabatan</b> : <?php echo $z['jabatan_PTK'] ?></h6></div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>Jenis</b> &nbsp; &nbsp; &nbsp;&nbsp;: <?php echo $z['jenis_PTK'] ?></h6></div>
                

        <?php
            // menampilkan data pegawai id ptk yg discan
            
                $mm = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                        
                $nn = mysqli_query($koneksi, $mm);
                $oo = mysqli_fetch_array($nn);
                
        ?> 
        <?php 
                $x9 = "SELECT * FROM tb_jam_pulang";
                $y8 = mysqli_query($koneksi,$x9);
                $z7 = mysqli_fetch_array($y8);      
        ?>    
        <form method="POST" action="SimpanPresensiPulang.php" enctype="multipart/form-data">
            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                window.setTimeout(function() {
                    document.getElementById("submit").click();
                }, 1000); // 1200000 = seconds*1000
            </script>

            <input type="hidden" name="id_PTK" value="<?php echo $oo['id_PTK']; ?>">
            <input type="hidden" name="id_presensi_pulang" value="<?php echo $get3number2.$oo['id_PTK'];?>">    
            <input type="hidden" name="keterangan" value="Pulang">
            <p align="right"><button type="submit" name="submit" id="submit" class="btn btn-success">Status Aktif</button></p>
        </form>
                
        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
   require_once 'Layout/Header.php';
   require_once 'Koneksi.php';
 ?>

<?php
// membuat id otomatis 
    $date = date( 'dmYHsa' ); // Tahun
    $get3number = substr( $date,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
     
     
    // mengambil data dari database untuk pengecekan no
    $get_data = mysqli_query( $koneksi, "SELECT * FROM tb_hasil_presensi" );
     
    // Check
    $check = mysqli_num_rows( $get_data ); // untuk mengecek apakah di table barang "no/ kode" sudah ada atau belum
     
    $kd = ''; // mendefinisikan variable kd ( $kd ) dengan value null/ kosong. Hal ini sangatlah penting jika pada suatu kondisi tertentu nilai variable blm di definisikan, maka akan menimbulkan munculnya error/ notice
     
    if ( empty( $check ) ) { // Jk kode blm ada maka
    $kd = 1; // kode dimulai dr 1
    } else { // jk sudah ada maka
    $kd = $check + 1; // kode sebelumnya ditambah 1.
    }
?>

<?php
// membuat id otomatis 
    $date2 = date( 'dmY' ); // Tahun
    $get3number2 = substr( $date2,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
     
     
    // mengambil data dari database untuk pengecekan no
    $get_data2 = mysqli_query( $koneksi, "SELECT * FROM tb_presensi_pulang" );
     
    // Check
    $check2 = mysqli_num_rows( $get_data2 ); // untuk mengecek apakah di table barang "no/ kode" sudah ada atau belum
     
    $kd2 = ''; // mendefinisikan variable kd ( $kd ) dengan value null/ kosong. Hal ini sangatlah penting jika pada suatu kondisi tertentu nilai variable blm di definisikan, maka akan menimbulkan munculnya error/ notice
     
    if ( empty( $check2 ) ) { // Jk kode blm ada maka
    $kd2 = 1; // kode dimulai dr 1
    } else { // jk sudah ada maka
    $kd = $check2 + 1; // kode sebelumnya ditambah 1.
    }
?>

    <!-- Begin Page Content -->
<div class="container-fluid">

 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hasil Scan QR Code</h1>
   <p class="mb-4"></p>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3">
              
           </div>
           <div class="card-body">
                <?php
                    $a = "SELECT * FROM tb_ptk WHERE id_ptk='$_POST[noid]'"; //noid berasal dari file index validasi-QR code artinya sama dgn id
                    $b = mysqli_query($koneksi, $a);
                    $c = mysqli_num_rows($b);
                    
                    // jika QR code tidak ditemukan, maka akan ada notif
                        if ($c < 1) {
                    ?>
                        <!-- alert -->
                        <div class="alert alert-danger">
                            Data tidak ditemukan.
                        </div>
                        <!-- /alert -->

                    <!-- <script> alert('Data tidak ditemukan') </script>; -->
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
                    <script>
                        var sound = new Howl({
                        src: ['suara/QRcode_kosong.mp3'],
                        volume: 0.5,
                        onend: function () {
                        window.location='validasi-QR-Pulang';
                        }
                        });
                        sound.play()
                    </script>

                <?php      
                    } else { //jika QR code ditemukan
                ?>

                <?php
                 date_default_timezone_set('Asia/Kuala_Lumpur');
                     $waktu = date("H:i:sa");
                     $aaa = "SELECT * FROM tb_jam_pulang ";
                             
                     $bbb = mysqli_query($koneksi, $aaa);
                     while($ooo = mysqli_fetch_array($bbb)){

                       
                        // jika waktu lebih besar atau sama dengan jam mulai dan lebih kecil atau sma dengan jam berakhir
                        if ($waktu >= $ooo['jam_pulang']) {
                    ?>
                


                    <div class="col-xl-5 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <?php 

                                $x = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                                $y = mysqli_query($koneksi,$x);
                                $z = mysqli_fetch_array($y); 
                                
                            ?>

                           
                                
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-propercase mb-1"><h5><?php echo $z['nama_PTK'] ?></h5></div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>ID PTK &nbsp;: <?php echo $z['id_PTK'] ?></h6></div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>Jabatan : <?php echo $z['jabatan_PTK'] ?></h6></div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>Jenis &nbsp; &nbsp; &nbsp;: <?php echo $z['jenis_PTK'] ?></h6></div>
                                
                                
                        <?php
                            // menampilkan data pegawai id ptk yg discan
                           
                                $mm = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                                        
                                $nn = mysqli_query($koneksi, $mm);
                                $oo = mysqli_fetch_array($nn);
                                
                        ?>     
                        <form method="POST" action="SimpanPresensiPulang.php" enctype="multipart/form-data">
                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                window.setTimeout(function() {
                                    document.getElementById("submit").click();
                                }, 1000); // 1200000 = seconds*1000
                            </script>

                            <input type="hidden" name="id_PTK" value="<?php echo $oo['id_PTK']; ?>">
                            <input type="hidden" name="id_presensi_pulang" value="<?php echo $get3number2.$oo['id_PTK'];?>">    
                            <input type="hidden" name="keterangan" value="Pulang">
                            <p align="right"><button type="submit" name="submit" id="submit" class="btn btn-success">Status Aktif</button></p>
                        </form>
                        </div>
                            </div>
                        </div>
                    </div>
                        <!-- <div class="alert alert-danger">
                            Tidak ada jadwal mengajar.
                        </div> -->

                    <?php
                        } else {
                    ?>

                        <div class="alert alert-danger">
                           <p> belum waktunya pulang.</p>
                        </div>

                        <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
                        <script>
                            var sound = new Howl({
                            src: ['suara/belum_waktunya.mp3'],
                            volume: 0.5,
                            onend: function () {
                            window.location='validasi-QR-Pulang';
                            }
                            });
                            sound.play()
                        </script>
                     <?php
                        } 
                    ?>
                     <?php
                        } 
                    ?>
                    <?php
                        } 
                    ?>
        
                   
        </div>
    </div>
 </div>
</div>
                

<?php  
     require_once 'Layout/Footer.php';  
          

