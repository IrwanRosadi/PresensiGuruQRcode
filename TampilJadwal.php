<?php 
     require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>
 
<!-- Begin Page Content -->
<div class="container-fluid">

 
 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Jadwal</h1>
  <!-- <a href="Hal_ImportJadwal.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i><strong> Import Data</strong></a> -->
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="TambahJadwal.php" class="btn btn-outline-primary">
                    <i class="fa fa-plus p-1"></i><strong>Tambah Data</strong>
                </a>&nbsp;&nbsp;
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                    
                                    <th>Id</th>
                                    <th>Nama PTK</th>
                                    <th>Hari</th>
                                    <th>Jam Mengajar</th>
                                    <!-- <th>Jam Berakhir</th> -->
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                            //    $no =1;
                                $query = mysqli_query($koneksi, "SELECT tb_jadwal.id_jadwal, tb_jadwal.hari, tb_ptk.nama_PTK,
                                                                tb_jam.jam_mulai, tb_jam.jam_berakhir, tb_mapel.mapel, tb_kelas.nama_kelas
                                                                FROM tb_jadwal
                                                                JOIN tb_ptk
                                                                ON tb_jadwal.id_PTK=tb_ptk.id_PTK
                                                                JOIN tb_jam
                                                                ON tb_jadwal.id_jam=tb_jam.id_jam
                                                                JOIN tb_mapel
                                                                ON tb_jadwal.kode_mapel=tb_mapel.kode_mapel
                                                                JOIN tb_kelas
                                                                ON tb_jadwal.kode_kelas=tb_kelas.kode_kelas
                                                               ");
                                if(mysqli_num_rows($query) > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr align="center">
                                    <td><?php echo $data['id_jadwal'];?></td>
                                    <td><?php echo $data['nama_PTK'];?></td>
                                    <td><?php echo $data['hari'];?></td>
                                    <td><?php echo $data['jam_mulai'];?> - <?php echo $data['jam_berakhir'];?></td>
                                    <td><?php echo $data['mapel'];?></td>
                                    <td><?php echo $data['nama_kelas'];?></td>
                                    <td>
                                        <a href="UbahJadwal.php?id_jadwal=<?php echo $data['id_jadwal']?>" class="btn btn-success btn-circle">
                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                        </a><br><br>
                                        <a href="HapusJadwal.php?id_jadwal=<?php echo $data['id_jadwal']?>" class="btn btn-danger btn-circle" onclick="return confirm('Anda yakin akan menghapus Data ?')">
                                            <i class="fas fa-trash" data-toggle="tooltip" title="Hapus" ></i>
                                        </a>
                                    
                                    </td>
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
        </div>

<?php  
      require_once 'Layout/Footer.php';  
