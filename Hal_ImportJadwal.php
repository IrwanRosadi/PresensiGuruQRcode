<?php 
     require_once 'Layout/Header.php';
 ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Import Data Jadwal</h1>
    </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body text-gray-700">
                                <p style="color:;">Sebelum upload data terlebih dahulu <b>download format Excel</b> dibawah, Karena tidak diperkenankan menggunakan formal lain.</p>
                                    <a href="Format_Jadwal.xlsx" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-download"></i>
                                        </span>
                                        <span class="text">Download format excel</span>
                                    </a>
                                <br><br>
                                
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <p><b>Silahkan pilih file</b></p>
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="preview" >Preview</button>
                                    </form>
                        </div>
       

       
    <?php
        // Jika user telah mengklik tombol Preview
        if(isset($_POST['preview'])){
            $nama_file_baru = 'DataJadwal.xlsx';
            
            // Cek apakah terdapat file data.xlsx pada folder tmp
            if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
            unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
            
            $tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
            $tmp_file = $_FILES['file']['tmp_name'];
            
            // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
            if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
            // Upload file yang dipilih ke folder tmp
            move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
            
            // Load librari PHPExcel nya
            require_once 'PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Buat sebuah tag form untuk proses import data ke database
            echo "<form method='post' action='Import_Jadwal.php'>";
            
            
            //tampilkan semua field jika diklik tombol Preview
            echo "<div class='table-responsive p-3'><table class='table align-items-center table-flush table-hover' id='dataTableHover'>
                <tr>
                    <th>ID Jadwal</th>
                    <th>Hari</th>
                    <th>ID Jam Mulai</th>
                    <th>ID Jam Berakhir</th>
                    <th>Kode Kelas</th>
                    <th>Kode Mapel</th>
                    <th>ID PTK</th>
                </tr>
            ";
            
            $numrow = 1;
            $kosong = 0;
            foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $id_jadwal        = $row['A']; // Ambil data kode kelas
                $hari             = $row['B']; // Ambil data nama kelas
                $id_jam_mulai     = $row['C']; // Ambil data kode kelas
                $id_jam_berakhir  = $row['D']; // Ambil data nama kelas
                $kode_kelas       = $row['E']; // Ambil data kode kelas
                $kode_mapel       = $row['F']; // Ambil data nama kelas
                $id_PTK           = $row['G']; // Ambil data nama kelas
                
                // Cek jika semua data tidak diisi
                if(empty($id_jadwal) && empty($hari) && empty($id_jam_mulai) && empty($id_jam_berakhir) && empty($kode_kelas)
                && empty($kode_kelas) && empty($id_PTK))
                continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                
                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 1){
                // Validasi apakah semua data telah diisi
                $id_jadwal_td       = ( ! empty($id_jadwal))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                $hari_td            = ( ! empty($hari))? "" : " style='background:  #E07171;'"; // Jika Nama kosong, beri warna merah
                $id_jam_mulai_td    = ( ! empty($id_jam_mulai))? "" : " style='background:  #E07171;'";
                $id_jam_berakhir_td = ( ! empty($id_jam_berakhir))? "" : " style='background:  #E07171;'";
                $kode_kelas_td      = ( ! empty($kode_kelas))? "" : " style='background:  #E07171;'";
                $kode_mapel_td      = ( ! empty($kode_mapel))? "" : " style='background:  #E07171;'";
                $id_PTK_td          = ( ! empty($id_PTK))? "" : " style='background:  #E07171;'";
                
                // Jika salah satu data ada yang kosong
                if(empty($id_jadwal) or empty($hari) or empty($id_jam_mulai) or empty($id_jam_berakhir) or empty($kode_kelas)
                 or empty($kode_mapel) or empty($id_PTK)){
                    $kosong++; // Tambah 1 variabel $kosong
                }
                
                echo "<tr>";
                    echo "<td".$id_jadwal_td." >".$id_jadwal."</td>";
                    echo "<td".$hari_td." >".$hari."</td>";
                    echo "<td".$id_jam_mulai_td." >".$id_jam_mulai."</td>";
                    echo "<td".$id_jam_berakhir_td." >".$id_jam_berakhir."</td>";
                    echo "<td".$kode_kelas_td." >".$kode_kelas."</td>";
                    echo "<td".$kode_mapel_td." >".$kode_mapel."</td>";
                    echo "<td".$id_PTK_td." >".$id_PTK."</td>";
                echo "</tr>";
                }
                
                $numrow++; // Tambah 1 setiap kali looping
            }
            
            echo "</table></div>";
            
            // Cek apakah variabel ada yg kosong
            // Jika ada variabel yg kosong lebih dari atau sama dgn 1
            if($kosong >= 1){
                // Buat sebuah div untuk alert validasi kosong
                echo "<div class='col-lg-12 mb-4'>
                    <p><div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                            Baris yang berwarna merah kosong, silahkan isi kembali pada Format Excel !</div>
                ";
            ?>    
                <script>
                $(document).ready(function(){
                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                
                $("#kosong").show(); // Munculkan alert validasi kosong
                });
                </script>

            <?php
            }else{ // Jika semua data sudah diisi
                echo "";
                
                // Buat sebuah tombol untuk mengimport data ke database
                echo "<div class='card-body'><button type='submit' name='import' class='btn btn-success'>Import</button></div>";
            }
            
            echo "</form>";
            }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
            // Munculkan pesan validasi
            echo "
            <code>&nbsp;&nbsp;&nbsp;Hanya File Excel (.xlsx) yang diperbolehkan.</code><br>
            ";
            }
        }
    ?>
                </div>
            </div>
        </div>
    </div>
</div><br><br>

<?php  
      require_once 'Layout/Footer.php'; 
?>  