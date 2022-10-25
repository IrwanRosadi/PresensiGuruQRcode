<?php 
   require_once 'Layout/Header.php';
   require_once 'Koneksi.php';
 ?>

    <!-- Begin Page Content -->
<div class="container-fluid">

 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Presensi Masuk</h1>
   <p class="mb-4"></p>

       <!-- DataTales Example -->
          </div>
    </div>
   

<!-- Presensi Masuk Guru Sesuai Jadwal mengajar Di Kelas -->
<div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-gray-700">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Presensi kehadiran guru tetap dan pegawai</h6>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr align='center' bgcolor=''>
                                 <!-- <th>No.</th> -->
                                 <th>No.</th>
                                 <th>Nama PTK</th>
                                 <th>Jam Presensi</th>
                                 <th>Tanggal</th>
                                 <th>Keterangan</th>
                              </tr>
                           </thead>
                           <tbody>

                            <?php
                              date_default_timezone_set('Asia/Kuala_Lumpur');
                              $waktu = date("H:i:sa");
                              $aaa = "SELECT * FROM tb_jam_masuk ";
                           
                              $bbb = mysqli_query($koneksi, $aaa);
                              while($ooo = mysqli_fetch_array($bbb))
                                 // jika waktu lebih besar atau sama dengan jam mulai dan lebih kecil atau sma dengan jam berakhir
                                 $waktu = $ooo['jam_masuk'] 
                           ?>
                                 <?php
                                 
                                 $no = 1;
                                 $query = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran, tb_ptk
                                 WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK");
                                 if(mysqli_num_rows($query) > 0){
                                 while ($data = mysqli_fetch_array($query)) {
                              ?>
                                 <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $data['jam_presensi'];?>
                                    <?php
                                     $kamuuuuu = $data['jam_presensi'];
                                     $kamuuuuu2 = $data['keterlambatan'];
                                       if ($kamuuuuu == 0) {
                                    ?>
                                       
                                    <?php } elseif ($kamuuuuu2 == 0) { ?> 

                                    <?php
                                        } else{
                                    ?>
                                       <span class='badge badge-danger'>
                                          <?php
                                          $awal  = strtotime($waktu); /*jam mulai berasal dari jadwal guru jam berapa dia harus masuk kelas*/
                                          $akhir = strtotime($data['jam_presensi']); /*jam absensi berasal dari waktu yang terinput otomatis ketika guru sudah absen*/
                                          $diff  = $akhir - $awal; /*logikanya jam saat guru absen dikurangi dengan jam di jadwal guru*/

                                          $jam   = floor($diff / (60 * 60)); /*ikuti koding ini*/
                                          $menit = $diff - ( $jam * (60 * 60) ); /*ikuti koding ini*/
                                          $detik = $diff % 60; /*ikuti koding ini*/

                                          echo 'Terlambat: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik'; /*kemudian ini akan memunculkan guru terlambat berapa jam, berapa menit dan berapa detik*/
                                          ?>
                                       </span> 
                                    <?php
                                       }
                                    ?>
                                   
                                    </td>
                                    <td><?php echo $data['tanggal'];?></td>
                                    
                                    <?php
                                    // logic warna hijau jika keterangan hadir
                                       $kamu = $data['keterangan'];
                                       if($kamu == 'Hadir'){
                                    ?>
                                       <td><font size="4"><span class="badge badge-success"><?php echo $data['keterangan'];?></span></font></td>
                                    <?php
                                       }elseif ($kamu == 'Alpa') {
                                    ?>
                                       <td><font size="4"><span class="badge badge-danger"><?php echo $data['keterangan'];?></span></font></td>
                                    <?php
                                       }else{
                                    ?>
                                       <td><font size="4"><span class="badge badge-warning"><?php echo $data['keterangan'];?></span></font></td>
                                    <?php 
                                    } // End logic warna hijau jika keterangan hadir
                                    ?>

                                 </tr>
                                 <?php }}else{ ?>
                                 <tr>
                                    <td colspan="5" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Data Kosong<h6></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>    
     </div>      




   <!-- Presensi Masuk Guru Sesuai Jadwal mengajar Di Kelas -->
   <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-gray-700">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Presensi kehadiran guru sesuai jadwal mengajar di kelas</h6>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                            <thead align="center">
                                    <th>No.</th>
                                    <th>Nama PTK</th>
                                    <th>Jam Presensi</th>
                                    <th>Tanggal</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Keterangan</th>
                            </thead>
                            <tbody>
                              <?php
                              
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT * FROM tb_hasil_presensi, tb_jadwal, tb_ptk, tb_mapel, tb_kelas, tb_jam
                              WHERE tb_jadwal.id_jadwal = tb_hasil_presensi.id_jadwal
                              AND tb_ptk.id_PTK = tb_jadwal.id_PTK
                              AND tb_mapel.kode_mapel = tb_jadwal.kode_mapel
                              AND tb_kelas.kode_kelas = tb_jadwal.kode_kelas
                              AND tb_jam.id_jam = tb_jadwal.id_jam
                              ");
                              if(mysqli_num_rows($query) > 0){
                              while ($data = mysqli_fetch_array($query)) {
                             
                           ?>
                              <tr align="center">
                                 <td><?php echo $no++?></td>
                                 <td><?php echo $data['nama_PTK'];?></td>
                                 <td><?php echo $data['jam_presensi'];?>
                                    <?php
                                     $kamuuuuu = $data['jam_presensi'];
                                     $kamuuuuu2 = $data['keterlambatan'];
                                       if ($kamuuuuu == 0) {
                                    ?>
                                       
                                    <?php } elseif ($kamuuuuu2 == 0) { ?> 

                                    <?php
                                        } else{
                                    ?>
                                       <span class='badge badge-danger'>
                                          <?php
                                          $awal  = strtotime($data['toleransi']); /*jam mulai berasal dari jadwal guru jam berapa dia harus masuk kelas*/
                                          $akhir = strtotime($data['jam_presensi']); /*jam absensi berasal dari waktu yang terinput otomatis ketika guru sudah absen*/
                                          $diff  = $akhir - $awal; /*logikanya jam saat guru absen dikurangi dengan jam di jadwal guru*/

                                          $jam   = floor($diff / (60 * 60)); /*ikuti koding ini*/
                                          $menit = $diff - ( $jam * (60 * 60) ); /*ikuti koding ini*/
                                          $detik = $diff % 60; /*ikuti koding ini*/

                                          echo 'Terlambat: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik'; /*kemudian ini akan memunculkan guru terlambat berapa jam, berapa menit dan berapa detik*/
                                          ?>
                                       </span> 
                                    <?php
                                       }
                                    ?>
                                   
                                    </td>
                                 <td><?php echo $data['tanggal'];?></td>
                                 <td><?php echo $data['mapel'];?></td>
                                 <td><?php echo $data['nama_kelas'];?></td>

                                 <?php
                                 // logic warna hijau jika keterangan hadir
                                    $kamu = $data['keterangan'];
                                     if($kamu == 'Hadir'){
                                 ?>
                                    <td><font size="4"><span class="badge badge-success"><?php echo $data['keterangan'];?></span></font></td>
                                 <?php
                                     }elseif ($kamu == 'Alpa') {
                                 ?>
                                    <td><font size="4"><span class="badge badge-danger"><?php echo $data['keterangan'];?></span></font></td>
                                 <?php
                                     }else{
                                 ?>
                                    <td><font size="4"><span class="badge badge-warning"><?php echo $data['keterangan'];?></span></font></td>
                                 <?php 
                                 } // End logic warna hijau jika keterangan hadir
                                 ?>
                                
                              </tr>
                              <?php }} else{ ?>
                              <tr>
                                 <td colspan="7" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Data Kosong<h6></td>
                              </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>    
     </div>
    
<?php  
     require_once 'Layout/Footer.php';  