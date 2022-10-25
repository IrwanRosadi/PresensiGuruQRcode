<?php 
   require_once 'Layout/Header.php';
   require_once 'Koneksi.php';
 ?>

<!-- Begin Page Content -->
<div class="container-fluid">

 
 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Presensi Pulang</h1>
  <!-- <a href="Hal_ImportMapel.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i><strong> Import Data</strong></a> -->
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
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
                                 
                                 $no = 1;
                                 $query = mysqli_query($koneksi, "SELECT * FROM tb_presensi_pulang, tb_ptk
                                 WHERE tb_ptk.id_PTK = tb_presensi_pulang.id_PTK");
                                 if(mysqli_num_rows($query) > 0){
                                 while ($data = mysqli_fetch_array($query)) {
                              ?>
                                 <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $data['jam_presensi'];?></td>
                                    <td><?php echo $data['tanggal'];?></td>
                                    
                                    <?php
                                    // logic warna hijau jika keterangan hadir
                                       $kamu = $data['keterangan'];
                                       if($kamu == 'Pulang'){
                                    ?>
                                       <td><font size="4"><span class="badge badge-success"><?php echo $data['keterangan'];?></span></font></td>
                                    
                                       
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
                                    <td colspan="5" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Data Kosong<h6></td>
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