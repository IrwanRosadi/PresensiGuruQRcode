<?php 
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>

<?php 
$date = date( 'dmY' ); // Tahun
$get3number = substr( $date,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
 
 
// mengambil data dari database untuk pengecekan no
$get_data = mysqli_query( $koneksi, "SELECT * FROM tb_kehadiran" );
 
// Check
$check = mysqli_num_rows( $get_data ); // untuk mengecek apakah di table barang "no/ kode" sudah ada atau belum
 
$kd = ''; // mendefinisikan variable kd ( $kd ) dengan value null/ kosong. Hal ini sangatlah penting jika pada suatu kondisi tertentu nilai variable blm di definisikan, maka akan menimbulkan munculnya error/ notice
 
if ( empty( $check ) ) { // Jk kode blm ada maka
$kd = 1; // kode dimulai dr 1
} else { // jk sudah ada maka
$kd = $check + 1; // kode sebelumnya ditambah 1.
}

if(isset($_POST['simpan'])) {
   $id_kehadiran = $_POST['id_kehadiran'];
   $id_PTK = $_POST['id_PTK'];
   $keterangan = $_POST['keterangan'];
   date_default_timezone_set('Asia/Kuala_Lumpur'); //lingkup tgl, bulan dan waktu
   $tanggal = date ("d-m-Y");
   $bulan = date ("m");
   $jam_presensi = 0; //nilainya 0
   $keterlambatan = 0;

	$jumlah=count($id_kehadiran);	
	for($x=0;$x<$jumlah;$x++){
		
	$a="INSERT into tb_kehadiran (id_kehadiran, jam_presensi, keterangan, tanggal, bulan, id_PTK, keterlambatan) values('$id_kehadiran[$x]','$jam_presensi','$keterangan[$x]','$tanggal','$bulan','$id_PTK[$x]', $keterlambatan)";
	$b=mysqli_query($koneksi,$a);
	if($b) {
	   echo "<script>alert( 'Data presensi berhasil di simpan !' );
      window.location='PresensiMasuk.php';</script>";
       } else {
      echo "<script>alert( 'Data presensi gagal di simpan !' );
      window.location='TambahKeteranganBelumPresensiMasuk.php';</script>";	
}
}
}
 ?>
 
 
<?php 
// membuat id otomatis 
    $date = date( 'dmYHsa' ); // Tahun
    $get3number1 = substr( $date,-14 ); // mengambil 3 angka dari sebelah kanan pada tahun sekarang
     
     
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

   <div class="container-fluid">
   <h1 class="h3 mb-2 text-gray-800">Data Belum Presensi</h1>
   <p class="mb-4"></p>

       <!-- DataTales Example -->
       <div class="card shadow mb-4 text-gray-700">
           <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Presensi guru tetap dan pegawai</h6>
           </div>
         <form method="post">
            <div class="card-body">
            <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                 <tr align='center' bgcolor=''>
                                    <th>No.</th>
                                    <th>ID PTK</th>
                                    <th>Nama PTK</th>
                                    <!-- <th>Jam Presensi</th>-->
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 
                                 $no = 1;
                                 // $query = mysqli_query($koneksi, "SELECT tb_ptk.* FROM tb_ptk 
                                 //                                   LEFT JOIN tb_kehadiran 
                                 //                                   ON tb_ptk.id_PTK = tb_kehadiran.id_PTK 
                                 //                                   WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK IS NULL
                                 //                                ");
                                 // $query = mysqli_query($koneksi, "SELECT tb_ptk.nama_PTK, tb_kehadiran.jam_presensi, tb_kehadiran.tanggal, tb_kehadiran.keterangan 
                                 // FROM tb_ptk INNER JOIN tb_kehadiran ON tb_ptk.id_PTK= tb_kehadiran.id_PTK
                                 // LEFT JOIN tb_kehadiran 
                                 // ON tb_ptk.id_PTK = tb_kehadiran.id_PTK 
                                 // WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK IS NULL
                                 $tanggal = date ("d-m-Y");
                                 $query = mysqli_query($koneksi, "SELECT * FROM tb_ptk WHERE NOT EXISTS
                                                                  (SELECT * FROM tb_kehadiran
                                                                  WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK
                                                                  AND tb_kehadiran.tanggal='$tanggal')");
                                 if(mysqli_num_rows($query) > 0){
                                 while ($data = mysqli_fetch_array($query)) {
                              ?>
                                 <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['id_PTK'];?>
                                       <input type='hidden' name='id_kehadiran[]' value='<?php echo $get3number. $data['id_PTK'];?>'>
                                       <input type='hidden' name='id_PTK[]' value='<?php echo $data['id_PTK'];?>'>
                                    </td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $tanggal;?></td>
                                    
                                    <td>
                                       <div class="col-12 col-md-9">
                                          <select name="keterangan[]"  id="select" class="form-control" required oninvalid="this.setCustomValidity('Keterangan harus dipilih')" oninput="setCustomValidity('')" autocomplete="off">
                                          <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- Pilih --</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Alpa">Alpa</option>
                                          </select> 
                                       </div>
                                    </td>
                                 </tr>
                                 </tbody>
                                 <?php } ?>
                        </table><br>
                        <div class="row form-group">
                        <div class="col- col-md-9">
                        
                        </div>
                        <div class="col- col-md-3">
                           <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>&nbsp;&nbsp;&nbsp;
                           <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> BATAL</button>
                        </div>
                     </div><br>
                     <?php } else {?>
                        <!-- <tr>
                           <td colspan="5" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Data Kosong<h6></td>
                        </tr> -->
                     <?php } ?>
                             
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>


      <!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Presensi Guru & Staff SAMANSABAYA by
                         <b><a href="" target="_blank">Irwan Rosadi</a></b>
                     </span>
                    </div>
                </div>
</footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin akan logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

   

</body>

</html>