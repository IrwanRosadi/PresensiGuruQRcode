<!-- ======= Hero Section ======= -->
<section id="hero" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="Layout_User/assets/img/d.svg" alt="" class="img-fluid">
      </div>

      <div class="hero-info" data-aos="zoom-in" data-aos-delay="100">
        <h2>Sistem Informasi Presensi Guru & Pegawai.</h2>
        <div>
          <!-- <a href="#" class="btn-get-started scrollto">Get Started</a> -->
          <a href="validasi-QR1" class="btn-services scrollto">Presensi Guru & Pegawai</a>
          <a href="validasi-QR2" class="btn-services scrollto">Presensi Mengajar</a>
          <?php
              include_once 'Koneksi.php';
              date_default_timezone_set('Asia/Kuala_Lumpur');
              $waktu = date("H:i:sa");
              $aaa = "SELECT * FROM tb_jam_pulang ";
                      
              $bbb = mysqli_query($koneksi, $aaa);
              while($ooo = mysqli_fetch_array($bbb)){

              if ($waktu >= $ooo['jam_pulang']) {
            ?>
              <center><a href="validasi-QR-Pulang" class="btn-services scrollto">Presensi Pulang</a><center>
            <?php } else { ?>
              <center><a href="validasi-QR-Pulang" class="btn-services scrollto" disabled="disabled">Presensi Pulang</a><center>
              <?php } ?>
          <?php } ?>
        </div>
      </div>

    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h3> -- Histori Presensi --</h3>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
        </header>

        <div class="row about-container">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <!-- <div class="icon"><i class="bi bi-card-checklist"></i></div><br> -->
              <div class="icon"><i class="">1</i></div><br>
              <h4 class="title">Presensi Guru Tetap dan Pegawai</h4>
              <!-- <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p> -->
          </div>

          <div class="col-lg-12 content order-lg-1 order-2">
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                    <th>No.</th>
                                    <th>Nama PTK</th>
                                    <th>Jam Presensi</th>
                                    <th>Tanggal</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $tanggal = date ("d-m-Y");
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran, tb_ptk
                                    WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK
                                    AND tb_kehadiran.tanggal='$tanggal'");
                                if(mysqli_num_rows($query) > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $data['jam_presensi'];?></td>
                                    <td><?php echo $data['tanggal'];?></td>
                                </tr>
                                <?php }} else{ ?>
                                <tr>
                                    <td colspan="4" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Belum ada presensi<h6></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

          </div>

          <!-- <div class="col-lg-6 background order-lg-2" data-aos="zoom-in">
            <img src="assets/img/about-img.svg" class="img-fluid" alt="">
          </div> -->
        </div><br><br>
      

        <div class="row about-container">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="">2</i></div><br>
              <h4 class="title">Presensi Guru Mengajar di Kelas</h4>
              <!-- <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p> -->
          </div>

          <div class="col-lg-12 content order-lg-1 order-2">
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                    <th>No.</th>
                                    <th>Nama PTK</th>
                                    <th>Jam Presensi</th>
                                    <th>Tanggal</th>
                                    <th>Mata Pelajaran</th>
                                    <th>kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tanggal = date ("d-m-Y");
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_hasil_presensi, tb_jadwal, tb_ptk, tb_mapel, tb_kelas, tb_jam
                                WHERE tb_jadwal.id_jadwal = tb_hasil_presensi.id_jadwal
                                AND tb_ptk.id_PTK = tb_jadwal.id_PTK
                                AND tb_mapel.kode_mapel = tb_jadwal.kode_mapel
                                AND tb_kelas.kode_kelas = tb_jadwal.kode_kelas
                                AND tb_jam.id_jam = tb_jadwal.id_jam
                                AND tb_hasil_presensi.tanggal='$tanggal'
                                ");
                                if(mysqli_num_rows($query) > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $data['jam_presensi'];?></td>
                                    <td><?php echo $data['tanggal'];?></td>
                                    <td><?php echo $data['mapel'];?></td>
                                    <td><?php echo $data['nama_kelas'];?></td>
                                </tr>
                                <?php }} else{ ?>
                                <tr>
                                    <td colspan="6" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Belum ada presensi<h6></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

          </div>

          <!-- <div class="col-lg-6 background order-lg-2" data-aos="zoom-in">
            <img src="assets/img/about-img.svg" class="img-fluid" alt="">
          </div> -->
        </div>
      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->
