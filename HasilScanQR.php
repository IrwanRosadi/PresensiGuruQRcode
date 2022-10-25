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
                        window.location='validasi-QR';
                        }
                        });
                        sound.play()
                    </script>

                <?php      
                    } else { //jika QR code ditemukan
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
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // logic cek jenis PTK yaitu guru atau pegawai
                        $l = $z['jenis_PTK'];

                        // jika termasuk guru
                        if ($l == 'Guru' ) {
                    ?> 
                        <br><br>
                        <div class="alert alert-success">
                            Jadwal mengajar guru
                        </div>

                        <?php
                        //cek jadwal berdasarkan hari ini
                            date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                            $hari = date('l'); //baca hari ini
                            //$waktu = date("H:i:sa"); //baca berdasarkan
                            $p = "SELECT * FROM tb_ptk, tb_jadwal, tb_kelas, tb_jam, tb_mapel
                                WHERE tb_ptk.id_PTK = tb_jadwal.id_PTK
                                AND tb_kelas.kode_kelas=tb_jadwal.kode_kelas
                                AND tb_jam.id_jam=tb_jadwal.id_jam
                                -- AND tb_jam_berakhir.id_jam_berakhir=tb_jadwal.id_jam_berakhir
                                AND tb_mapel.kode_mapel=tb_jadwal.kode_mapel
                                AND tb_jadwal.hari='$hari'
                                AND tb_ptk.id_PTK='$_POST[noid]'";
                                
                            $q = mysqli_query($koneksi, $p);
                            $qq = mysqli_fetch_array($q);
                            $r = mysqli_num_rows($q);

                            if ($r < 1) { //jika tidak ada jadwal hari ini
                        ?>
                            <br>
                            
                            <?php 
                                $x9 = "SELECT * FROM tb_jam_masuk";
                                $y8 = mysqli_query($koneksi,$x9);
                                $z7 = mysqli_fetch_array($y8);      
                        ?>    
                        <form method="POST" action="SimpanPresensiKehadiran.php" enctype="multipart/form-data">
                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                window.setTimeout(function() {
                                    document.getElementById("submit").click();
                                }, 1000); // 1200000 = seconds*1000
                            </script>

                            <input type="hidden" name="id_PTK" value="<?php echo $z['id_PTK']; ?>">
                            <input type="hidden" name="id_kehadiran" value="<?php echo $get3number2.$z['id_PTK'];?>">    
                            <input type="hidden" name="keterangan" value="Hadir">
                            <?php
                            date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                            $waktu = date("H:i:sa"); //baca berdasarkan
                            if ($waktu > $z7['toleransi']){
                            ?>
                                <input type="hidden" name="keterlambatan" value="Terlambat">    
                            <?php
                            }else{
                            ?>
                                <input type="hidden" name="keterlambatan" value="0">
                            <?php
                            }
                            ?>
                            <p align="right"><button type="submit" name="submit2" id="submit" class="btn btn-success" >Status Aktif</button></p>
                        </form>

                            

                        <?php
                            } else {
                        ?>

                        
                            <div class="row">
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-12 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
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
                                                        
                                                $n = mysqli_query($koneksi, $m);
                                                while($o = mysqli_fetch_array($n)){
                                        ?>                                                
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>Kelas : <?php echo $o['nama_kelas'] ?></h6></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>Mata Pelajaran : <?php echo $o['mapel'] ?></h6></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><h6>Jam : <?php echo $o['jam_mulai'] ?> - <?php echo $o['jam_berakhir'] ?></h6></div>
                                            <div class="col-auto">
                                                <?php 
                                                    $waktu = date("H:i:sa"); //baca berdasarkan
                                                    // jika waktu lebih besar atau sama dengan jam mulai dan lebih kecil atau sma dengan jam berakhir
                                                    if (($waktu >= $o['jam_mulai']) && ($waktu <= $o['jam_berakhir'])) {
                                                ?>
                                                    

                                                         <?php
                                                        //  Cek id kehadiran
                                                         $tgl= date ("d-m-Y");
                                                         $co=mysqli_query($koneksi,"SELECT * FROM tb_kehadiran,tb_ptk WHERE tb_kehadiran.id_PTK=tb_ptk.id_PTK AND tb_kehadiran.id_PTK='$o[id_PTK]' AND tb_kehadiran.tanggal='$tgl' and tb_ptk.id_PTK='$_POST[noid]'");
	                                                     $ba=mysqli_num_rows($co);
	                                                     if($ba > 0){
	                                                     ?>
                                                          <!-- jika sudah presensi kehadiran, maka presesni masuk ke kehadiran sesuai jadwal saja -->
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
                                                            <p align="right"><button type="submit" name="submit3" id="submit3" class="btn btn-success">Status Aktif</button></p>
                                                            </form>       
                                                        <?php }else{?>
                                                            <!-- jika ada jadwal dan belum prsensi ke kehadiran guru tetap -->
                                                            <form method="POST" action="SimpanPresensi.php" enctype="multipart/form-data">
                                                            <!-- maka jadwal aktif -->
                                                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                                                window.setTimeout(function() {
                                                                    document.getElementById("submit").click();
                                                                }, 1000); // 1200000 = seconds*1000
                                                            </script>
                                                            <!-- menampilkan input tb_id_hasil_presesi scr tersembunyi -->
                                                            <input type="hidden" name="id_hasil_presensi" value="<?php echo $get3number.$o['id_PTK'].$o['kode_mapel'].$o['kode_kelas']; ?>">
                                                            <input type="hidden" name="id_kehadiran" value="<?php echo $get3number2.$o['id_PTK'];?>">
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
                                                            <p align="right"><button type="submit" name="submit" id="submit" class="btn btn-success">Status Aktif</button></p>
                                                            </form>
                                                        
                                                        <?php } ?>
                                                  
                                                <?php 
                                                
                                                    } else {
                                                ?>
                                                    <?php 
                                                        $x9 = "SELECT * FROM tb_jam_masuk";
                                                        $y8 = mysqli_query($koneksi,$x9);
                                                        $z7 = mysqli_fetch_array($y8);      
                                                    ?>  
                                                    <!-- ketika tidak ada jadwal presensi masuk ke kehadiran guru tetap -->
                                                    <form method="POST" action="SimpanPresensiKehadiran.php" enctype="multipart/form-data">
                                                    <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                                        window.setTimeout(function() {
                                                            document.getElementById("submit2").click();
                                                        }, 2000); // 1200000 = seconds*1000
                                                    </script>

                                                    <input type="hidden" name="id_kehadiran" value="<?php echo $get3number2.$o['id_PTK'];?>">
                                                    <input type="hidden" name="id_PTK" value="<?php echo $o['id_PTK']; ?>">
                                                    <input type="hidden" name="keterangan" value="Hadir">
                                                    <?php
                                                    date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                                                    $waktu = date("H:i:sa"); //baca berdasarkan
                                                    if ($waktu > $z7['toleransi']){
                                                    ?>
                                                        <input type="hidden" name="keterlambatan" value="Terlambat">    
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <input type="hidden" name="keterlambatan" value="0">
                                                    <?php
                                                    }
                                                    ?>
                                                    <p align="right"><button class="btn btn-danger" name="submit2" id="submit2">Status Non Aktif</button></p>
                                                        <!-- <script> alert('Data tidak ditemukan') </script>; -->
                                                    </form>
                                                <?php
                                                }
                                              ?>
                                            </div>
                                            <br>
                                    <?php } ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        
                            
                            
                               
                     <?php } ?>      

                    <?php
                        //jika bukan guru
                        } else {
                    ?>
                        <br>
                        <?php
                            // menampilkan data pegawai id ptk yg discan
                           
                                $mm = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                                        
                                $nn = mysqli_query($koneksi, $mm);
                                $oo = mysqli_fetch_array($nn);
                                
                        ?> 
                        <?php 
                                $x9 = "SELECT * FROM tb_jam_masuk";
                                $y8 = mysqli_query($koneksi,$x9);
                                $z7 = mysqli_fetch_array($y8);      
                        ?>    
                        <form method="POST" action="SimpanPresensiKehadiran.php" enctype="multipart/form-data">
                            <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                window.setTimeout(function() {
                                    document.getElementById("submit").click();
                                }, 1000); // 1200000 = seconds*1000
                            </script>

                            <input type="hidden" name="id_PTK" value="<?php echo $oo['id_PTK']; ?>">
                            <input type="hidden" name="id_kehadiran" value="<?php echo $get3number2.$oo['id_PTK'];?>">    
                            <input type="hidden" name="keterangan" value="Hadir">
                            <?php
                            date_default_timezone_set('Asia/Kuala_Lumpur'); //WITA
                            $waktu = date("H:i:sa"); //baca berdasarkan
                            if ($waktu > $z7['toleransi']){
                            ?>
                                <input type="hidden" name="keterlambatan" value="Terlambat">    
                            <?php
                            }else{
                            ?>
                                <input type="hidden" name="keterlambatan" value="0">
                            <?php
                            }
                            ?>
                            <p align="right"><button type="submit" name="submit2" id="submit" class="btn btn-success" >Status Aktif</button></p>
                        </form>

                        <!-- <div class="alert alert-danger">
                            Tidak ada jadwal mengajar.
                        </div> -->

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