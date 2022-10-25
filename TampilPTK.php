<?php 
     require_once 'Layout/Header.php';
    require_once 'Koneksi.php';
 ?>
 
<!-- Begin Page Content -->
<div class="container-fluid">

 
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Pendidik dan Tenaga Kependidikan</h1>
  <!-- <a href="Hal_ImportPTK.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i><strong> Import Data</strong></a> -->
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="TambahPTK.php" class="btn btn-outline-primary">
                    <i class="fa fa-plus p-1"></i><strong>Tambah Data</strong>
                </a>&nbsp;&nbsp;
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-800" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align='center' bgcolor=''>
                                    <th>No.</th>
                                    <th>ID PTK</th>
                                    <th>Nama PTK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jabatan</th>
                                    <th>Jenis PTK</th>
                                    <th>Aksi</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM tb_ptk");
                                    if(mysqli_num_rows($query) > 0){
                                    while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr align="center">
                                        <td><?php echo $no++?></td>
                                        <td><?php echo $data['id_PTK'];?></td>
                                        <td><?php echo $data['nama_PTK'];?></td>
                                        <td><?php echo $data['jk_PTK'];?></td>
                                        <td><?php echo $data['jabatan_PTK'];?></td>
                                        <td><?php echo $data['jenis_PTK'];?></td>
                                        <td>
                                            <a href="UbahPTK.php?id_PTK=<?php echo $data["id_PTK"]; ?>" class="btn btn-success btn-circle">
                                                <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <a href="HapusPTK.php?id_PTK=<?php echo $data['id_PTK']?>" class="btn btn-danger btn-circle" onclick="return confirm('Anda yakin akan menghapus Data atas nama <?php echo $data['nama_PTK'];?> ?')">
                                                <i class="fas fa-trash" data-toggle="tooltip" title="Hapus" ></i>
                                            </a><br><br>
                                             <!--buat QR code  -->
                                            <a href="buatQRCode.php?id_PTK=<?php echo $data['id_PTK']?>&nomor=<?php echo $data['id_PTK']?>" class="btn btn-info btn-circle">
                                                <i class="fas fa-qrcode" data-toggle="tooltip" title="Buat QR Code" ></i>
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <!-- Cetak QR Code -->
                                            <a href="CetakQRcodePTK.php?id_PTK=<?php echo $data['id_PTK']?>" target="_blank" class="btn btn-warning btn-circle" >
                                                <!-- <i class="fa fa-eye" data-toggle="tooltip" title="Detail QR Code" ></i> -->
                                                <i class="fa fa-print" data-toggle="tooltip" title="Cetak QR Code" ></i>
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

        

 
<?php  
     require_once 'Layout/Footer.php'; 
