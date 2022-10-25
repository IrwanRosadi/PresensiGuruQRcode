<?php 
   require_once 'Tamplate/Layout/Header.php';
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

                            <?php
                                    // memanggil suara dari folder suara berdasarkan id_PTK/nama file suara
                                    $h = "SELECT * FROM tb_ptk WHERE id_PTK='$_POST[noid]'";
                                    $i = mysqli_query($koneksi,$h);
                                    $j = mysqli_fetch_array($i); 
                                    $k = $z['id_PTK'];
                                    if (($j = $k)) {
                                        echo "
                                        <script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
                                        <script>
                                            var sound = new Howl({
                                            src: ['suara/$k.mp3'],
                                            volume: 0.5,
                                            onend: function () {
                                            }
                                            });
                                            sound.play()
                                        </script>";
                                    }
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
                            $p = "SELECT * FROM tb_ptk, tb_jadwal, tb_kelas, tb_jam_mulai, tb_jam_berakhir, tb_mapel
                                WHERE tb_ptk.id_PTK = tb_jadwal.id_PTK
                                AND tb_kelas.kode_kelas=tb_jadwal.kode_kelas
                                AND tb_jam_mulai.id_jam_mulai=tb_jadwal.id_jam_mulai
                                AND tb_jam_berakhir.id_jam_berakhir=tb_jadwal.id_jam_berakhir
                                AND tb_mapel.kode_mapel=tb_jadwal.kode_mapel
                                AND tb_jadwal.hari='$hari'
                                AND tb_ptk.id_PTK='$_POST[noid]'";
                                
                            $q = mysqli_query($koneksi, $p);
                            $r = mysqli_num_rows($q);

                            if ($r < 1) { //jika tidak ada jadwal hari ini
                        ?>
                            <br>
                            <div class="alert alert-danger">
                                Tidak ada jadwal mengajar hari ini.
                            </div>
                        <?php
                            } else {
                        ?>

                        <form method="POST" action="SimpanPresensi.php" enctype="multipart/form-data">
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
                                                $m = "SELECT * FROM tb_ptk, tb_jadwal, tb_kelas, tb_jam_mulai, tb_jam_berakhir, tb_mapel
                                                        WHERE tb_ptk.id_PTK = tb_jadwal.id_PTK
                                                        AND tb_kelas.kode_kelas=tb_jadwal.kode_kelas
                                                        AND tb_jam_mulai.id_jam_mulai=tb_jadwal.id_jam_mulai
                                                        AND tb_jam_berakhir.id_jam_berakhir=tb_jadwal.id_jam_berakhir
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
                                                        <!-- maka jadwal aktif -->
                                                        <script type="text/javascript"> //refres sendiri ke halaman SimpanPresensi.php
                                                            window.setTimeout(function() {
                                                                document.getElementById("submit").click();
                                                            }, 4000); // 1200000 = seconds*1000
                                                        </script>
                                                        <!-- menampilkan input tb_id_hasil_presesi scr tersembunyi -->
                                                         <input type="hidden" name="id_hasil_presensi" value="<?php echo $get3number.$o['id_PTK'].$o['kode_mapel'].$o['kode_kelas']; ?>">
                                                         
                                                         <input type="hidden" name="id_jadwal" value="<?php echo $o['id_jadwal']; ?>">
                                                         <input type="hidden" name="keterangan" value="Hadir">
                                                        <p align="right"><button type="submit" name="submit" id="submit" class="btn btn-success" >Status Aktif</button></p>
                                                <?php 
                                                    } else {
                                                ?>
                                                    <p align="right"><button class="btn btn-danger" disabled>Status Non Aktif</button></p>
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
                        </form>
                            
                            
                               
                     <?php } ?>      

                    <?php
                        //jika bukan guru
                        } else {
                    ?>
                        <br>
                        <div class="alert alert-danger">
                            Tidak ada jadwal mengajar.
                        </div>

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
</div>
                

<?php  
     require_once 'Tamplate/Layout/Footer.php';  