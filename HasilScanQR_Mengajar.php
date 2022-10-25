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
    $get_data2 = mysqli_query( $koneksi, "SELECT * FROM tb_kehadiran" );
     
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
                window.location='validasi-QR2';
                }
                });
                sound.play()
            </script>
<br><br><br><br><br><br>
            <?php      
                } else { //jika QR code ditemukan
            ?>
                
            <?php 

                $x = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                $y = mysqli_query($koneksi,$x);
                $z = mysqli_fetch_array($y); 
                
            ?>
            <br><br><br><br><br><br>
            <div class="row">
                <div class="col-xl-5 col-md-6 mb-4">
                <div class="card text-dark bg-light mb-3">
                    <!-- <div class="card-header bg-primary shadow h-100 py-2 text-white">
                        Featured
                    </div> -->
                    <div class="card-body shadow h-100 py-2">
                    <div class="text-xs font-weight-bold text-primary text-propercase mb-1"><h5><b><?php echo $z['nama_PTK'] ?></b></h5></div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>ID PTK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $z['id_PTK'] ?></h6></div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>Jabatan&nbsp;&nbsp;&nbsp; :</b> <?php echo $z['jabatan_PTK'] ?></h6></div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6><b>Jenis &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;:</b> <?php echo $z['jenis_PTK'] ?></h6></div>
                    </div>
                    </div>
                </div>

                    <?php
                    // logic cek jenis PTK yaitu guru atau pegawai
                        $l = $z['jenis_PTK'];

                        // jika termasuk guru
                        if ($l == 'Guru' ) {
                    ?> 

                    <?php
                    //cek jadwal berdasarkan hari ini
                    date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                    $hari = date('l'); //baca hari ini
                    //$waktu = date("H:i:sa"); //baca berdasarkan
                    $p = "SELECT * FROM tb_ptk, tb_jadwal, tb_kelas, tb_jam, tb_mapel
                        WHERE tb_ptk.id_PTK = tb_jadwal.id_PTK
                        AND tb_kelas.kode_kelas=tb_jadwal.kode_kelas
                        AND tb_jam.id_jam=tb_jadwal.id_jam
                        AND tb_mapel.kode_mapel=tb_jadwal.kode_mapel
                        AND tb_jadwal.hari='$hari'
                        AND tb_ptk.id_PTK='$_POST[noid]'";
                        
                        $q = mysqli_query($koneksi, $p);
                        $r = mysqli_num_rows($q);

                        if ($r < 1) { //jika tidak ada jadwal hari ini
                     ?>

                        <br><br><br><br><br><br>
                        <!-- alert -->
                        <div class="col-xl-7 col-md-6 mb-4">
                            <div class="alert alert-danger">
                                Tidak ada jadwal mengajar.
                            </div>
                        </div>
                        <!-- /alert -->

                        <!-- <script> alert('Data tidak ditemukan') </script>; -->
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
                        <script>
                            var sound = new Howl({
                            src: ['suara/Tidak_ada_jadwal.mp3'],
                            volume: 0.5,
                            onend: function () {
                            window.location='validasi-QR2';
                            }
                            });
                            sound.play()
                        </script>

                    <?php
                        } else { //jika ada jadwal
                    ?>

                    <!-- cek jadwal berdasarkan hari ini -->
                    <?php
                        // menampilkan data guru dan data jadwal berdasarkan id ptk yg discan
                        date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                        $hari = date('l'); //baca hari ini
                        $waktu = date("H:i:sa");
                            $m = "SELECT * FROM tb_ptk, tb_jadwal, tb_kelas, tb_jam, tb_mapel
                                    WHERE tb_ptk.id_PTK = tb_jadwal.id_PTK
                                    AND tb_kelas.kode_kelas=tb_jadwal.kode_kelas
                                    AND tb_jam.id_jam=tb_jadwal.id_jam
                                    -- AND tb_jam_berakhir.id_jam_berakhir=tb_jadwal.id_jam_berakhir
                                    AND tb_mapel.kode_mapel=tb_jadwal.kode_mapel
                                    AND tb_jadwal.hari='$hari'
                                    AND tb_ptk.id_PTK='$_POST[noid]'";
                    ?>
                            <div class="col-xl-7 col-md-7 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary shadow h-100 py-2 text-white">
                                    <center><b>Jadwal Mengajar</b></center>
                                </div>
                                <div class="card-body shadow h-100 py-2">  
                    <?php                
                            $n = mysqli_query($koneksi, $m);
                            while($o = mysqli_fetch_array($n)){
                    ?>        
                    
                                    <table border="0" width="100%" style="margin-top:10px;">
                        
                                        <tr>
                                            <td><h6><b>Mata Pelajaran</b></td>
                                            <td><h6><b>:</b></h6></td>
                                            <td><h6><?php echo $o['mapel'] ?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><b>Jam</b></td>
                                            <td><h6><b>:</b></h6></td>
                                            <td><h6><?php echo $o['jam_mulai'] ?> - <?php echo $o['jam_berakhir'] ?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><b>Kelas</b></td>
                                            <td><h6><b>:</b></h6></td>
                                            <td><h6><?php echo $o['nama_kelas'] ?></h6></td>
                                        </tr>
                                        <tr>
                                            <?php
                                                date_default_timezone_set('Asia/Kuala_Lumpur'); 
                                                $waktu = date("H:i:sa"); //baca berdasarkan
                                                // jika waktu lebih besar atau sama dengan jam mulai dan lebih kecil atau sma dengan jam berakhir
                                                if (($waktu >= $o['jam_mulai']) && ($waktu <= $o['jam_berakhir'])) {
                                            ?>

                                            <form method="POST" action="SimpanPresensi2.php" enctype="multipart/form-data">
                                            <!-- maka jadwal aktif -->
                                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                                window.setTimeout(function() {
                                                    document.getElementById("submit3").click();
                                                }, 1000); // 1200000 = seconds*1000
                                            </script>
                                            <!-- menampilkan input tb_id_hasil_presesi scr tersembunyi -->
                                            <input type="hidden" name="id_hasil_presensi" value="<?php echo $get3number.$o['id_PTK'].$o['kode_mapel'].$o['kode_kelas']; ?>">
                                            <input type="hidden" name="id_jadwal" value="<?php echo $o['id_jadwal']; ?>">
                                            <input type="hidden" name="id_PTK" value="<?php echo $o['id_PTK']; ?>">
                                            <input type="hidden" name="keterangan" value="Hadir">
                                            <?php
                                                date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                                                $waktu = date("H:i:sa"); //baca berdasarkan
                                                if ($waktu > $o['toleransi']){
                                            ?>
                                                <input type="hidden" name="keterlambatan" value="Terlambat">    
                                            <?php
                                                }else{
                                            ?>
                                                <input type="hidden" name="keterlambatan" value="0">
                                            <?php
                                                }
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <td><p align="right"><button type="submit" name="submit3" id="submit3" class="btn btn-success">Status Aktif</button></p></td>
                                            </form>
                                            <?php
                                             }else{
                                            ?>

                                            <form method="POST" action="blank.php" enctype="multipart/form-data">
                                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                                window.setTimeout(function() {
                                                    document.getElementById("submit1").click();
                                                }, 1500); // 1200000 = seconds*1000
                                            </script>
                                            <td></td>
                                            <td></td>
                                            <td><p align="right"><button class="btn btn-danger" id="submit1" >Status Non Aktif</button></p></td>
                                            
                                            <?php } ?>
                                        </tr>
                                            </form>
                                    </table>
                            
                        

                    <?php } ?>

                    </div>
                </div> 
                
                <?php } // end jika ada jadwal?>
            
                <?php } else {// End jika termasuk Pegawai ?>
                    <br><br><br><br><br><br>
                        <!-- alert -->
                        <div class="col-xl-7 col-md-6 mb-4">
                            <div class="alert alert-danger">
                                Tidak ada jadwal mengajar.
                            </div>
                        </div>
                        <!-- /alert -->

                        <!-- <script> alert('Data tidak ditemukan') </script>; -->
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
                        <script>
                            var sound = new Howl({
                            src: ['suara/tidak_ada_jadwal_silahkan_pilih_presensi.mp3'],
                            volume: 0.5,
                            onend: function () {
                            window.location='Beranda.php';
                            }
                            });
                            sound.play()
                        </script>
                <?php } ?>     
            <?php } // End jika QR code ditemukan?>
                
        </div>
    </div>
    </div>
    <br><br><br><br><br><br><br><br> <br>             

<?php
include_once 'Layout_User/F_User.php';
?>