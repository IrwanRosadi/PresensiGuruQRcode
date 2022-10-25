<?php 
      require_once 'Layout/Header.php';
 ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Import Data Kelas</h1>
    </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body text-gray-700">
                                <p style="color:;">Sebelum upload data terlebih dahulu <b>download format Excel</b> dibawah, Karena tidak diperkenankan menggunakan formal lain.</p>
                                    <a href="Format_Kelas.xlsx" class="btn btn-success btn-icon-split">
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
            $nama_file_baru = 'data.xlsx';
            
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
            echo "<form method='post' action='Import_kelas.php'>";
            
            
            //tampilkan semua field jika diklik tombol Preview
            echo "<div class='table-responsive p-3'><table class='table align-items-center table-flush table-hover' id='dataTableHover'>
                <tr>
                    <th>Kode Kelas</th>
                    <th>Kelas</th>
                </tr>
            ";
            
            $numrow = 1;
            $kosong = 0;
            foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $kode_kelas     = $row['A']; // Ambil data kode kelas
                $nama_kelas     = $row['B']; // Ambil data nama kelas
                
                // Cek jika semua data tidak diisi
                if(empty($kode_kelas) && empty($nama_kelas))
                continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                
                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 1){
                // Validasi apakah semua data telah diisi
                $kode_kelas_td = ( ! empty($kode_kelas))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                $nama_kelas_td = ( ! empty($nama_kelas))? "" : " style='background:  #E07171;'"; // Jika Nama kosong, beri warna merah
                
                
                // Jika salah satu data ada yang kosong
                if(empty($kode_kelas) or empty($nama_kelas)){
                    $kosong++; // Tambah 1 variabel $kosong
                }
                
                echo "<tr>";
                    echo "<td".$kode_kelas_td." >".$kode_kelas."</td>";
                    echo "<td".$nama_kelas_td." >".$nama_kelas."</td>";
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