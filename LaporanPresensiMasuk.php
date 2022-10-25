<?php 
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>

 
<!-- Begin Page Content -->
<div class="container-fluid">

 
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Laporan Presensi Kehadiran Tetap</h1>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
                <div class="card-body">
                    <div class="table-responsive text-gray-900">
                        <form method="post">
                        <div class="row form-group">
                            <!-- <div class="col col-md-3">
                                <label for="select" class=" form-control-label"><font color="red"></font></label>
                            </div> -->
                            <div class="col-12 col-md-2">
                                <!-- <input type="date" id="text-input" name="dari_tgl" class="form-control" value="" required="required"> -->
                                
                            </div>
                            <div class="col-12 col-md-2">
                                <!-- <input type="date" id="text-input" name="sampai_tgl" class="form-control" value="" required="required"> -->
                                
                            </div>
                            <!-- <button type="submit" name="cari" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Cari</button> -->

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                            
                            <a href="CetakPresensiMasuk.php" target="_blank" class="btn btn-success "><i class="fas fa-print"></i>&nbsp;&nbsp;<b>Print</b></a>
                        </div><br>
                    </form>


                        <table align="center" border="0" width="" height="50%">
                            <tr>
                                <td><img src="img/logo_sma.PNG" height="63px" width="63px"><td> &nbsp;&nbsp;&nbsp;&nbsp;
                                <td><h3 style="text-align: center; line-height: 1.4; font-weight: bold"><font size="4px">
                                    Laporan Presensi Kehadiran Guru Tetap dan Pegawai</br>SMAN 1 Pringgabaya</font></h3><td>
                            <tr>
                        </table><br>
                        
                        <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                   
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Nama PTK</th>
                                    <th colspan="5">Total Presensi</th>
                                </tr>
                                <tr align="center">
                                    <!-- <th colspan="4"></th> -->
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                    <th>Terlambat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                // if (isset($_POST['cari'])) {
                                //     $dari_tgl =  mysqli_real_escape_string($koneksi, $_POST['dari_tgl']);
                                //     $sampai_tgl =  mysqli_real_escape_string($koneksi, $_POST['sampai_tgl']);
                                //     $oke = mysqli_query($koneksi, "SELECT * from tb_ptk WHERE EXISTS (
                                //                                     SELECT * FROM tb_kehadiran
                                //                                     WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK)
                                //                                     WHERE tanggal between ' $dari_tgl' AND '$sampai_tgl'");
                                // }else{
                                    $a ="SELECT * from tb_ptk WHERE EXISTS (
                                        SELECT * FROM tb_kehadiran
                                        WHERE tb_ptk.id_PTK = tb_kehadiran.id_PTK)";
                                    $b =mysqli_query($koneksi,$a);
                                // }


                               
                                while($c=mysqli_fetch_array($b)){
                                ?>
                                <tr align="">
                                    <td align="center"><?php echo  $no++ ?></td>
                                    <td><?php echo $c['nama_PTK']; ?></td>
                                   
                                    <?php
                                        $get = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran WHERE keterangan = 'Hadir' AND id_PTK='$c[id_PTK]'" );
                                        $count = mysqli_num_rows($get);

                                        $get1 = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran WHERE keterangan = 'Izin' AND id_PTK='$c[id_PTK]'");
                                        $count1 = mysqli_num_rows($get1);

                                        $get2 = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran WHERE keterangan = 'Sakit' AND id_PTK='$c[id_PTK]'");
                                        $count2 = mysqli_num_rows($get2);

                                        $get3 = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran WHERE keterangan = 'Alpa' AND id_PTK='$c[id_PTK]'" );
                                        $count3 = mysqli_num_rows($get3);

                                        $get4 = mysqli_query($koneksi, "SELECT * FROM tb_kehadiran WHERE keterlambatan = 'Terlambat' AND id_PTK='$c[id_PTK]'" );
                                        $count4 = mysqli_num_rows($get4);
                                        ?>
 
                                    <td align="center"><?php echo $count; ?></td>
                                    <td align="center"><?php echo $count1; ?></td>
                                    <td align="center"><?php echo $count2; ?></td>
                                    <td align="center"><?php echo $count3; ?></td>
                                    <td align="center"><?php echo $count4; ?></td>
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
