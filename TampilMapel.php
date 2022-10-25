<?php 
    require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>
 
<!-- Begin Page Content -->
<div class="container-fluid">

 
 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Mata Pelajaran</h1>
  <!-- <a href="Hal_ImportMapel.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i><strong> Import Data</strong></a> -->
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="TambahMapel.php" class="btn btn-outline-primary">
                    <i class="fa fa-plus p-1"></i><strong>Tambah Data</strong>
                </a>&nbsp;&nbsp;
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                    <th>No.</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Aksi</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_mapel");
                                if(mysqli_num_rows($query) > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['kode_mapel'];?></td>
                                    <td><?php echo $data['mapel'];?></td>
                                    <td>
                                        <a href="UbahMapel.php?kode_mapel=<?php echo $data['kode_mapel']?>" class="btn btn-success btn-circle">
                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                        </a>&nbsp;&nbsp;&nbsp;
                                        <a href="HapusMapel.php?kode_mapel=<?php echo $data['kode_mapel']?>" class="btn btn-danger btn-circle" onclick="return confirm('Anda yakin akan menghapus Data Mata Pelajaran <?php echo $data['mapel'];?> ?')">
                                            <i class="fas fa-trash" data-toggle="tooltip" title="Hapus" ></i>
                                        </a>
                                    
                                    </td>
                                </tr>
                                <?php }} else{ ?>
                                <tr>
                                    <td colspan="4" align="center"><h6 style="font-weight: bold; color:red; font-size:15px;">Data Kosong<h6></td>
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
