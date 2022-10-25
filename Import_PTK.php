<?php
    // Load file koneksi.php
    $host = 'localhost'; // Nama hostnya
    $username = 'root'; // Username
    $password = ''; // Password (Isi jika menggunakan password)
    $database = 'db_presensi'; // Nama databasenya

    // Koneksi ke MySQL dengan PDO
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);


    if(isset($_POST['import'])){ // Jika user mengklik tombol Import
    $nama_file_baru = 'dataPTK.xlsx';
    
    // Memanggil librari PHPExcel nya
    require_once 'PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat query Insert
    $sql = $pdo->prepare("INSERT INTO tb_ptk VALUES(:id_PTK,:nama_PTK,:jk_PTK,:jabatan_PTK,:jenis_PTK)");
    

    
    
    $numrow = 1;
    foreach($sheet as $row){
        // Ambil data pada excel sesuai Kolom
        $id_PTK            = $row['A']; // Ambil data kode mapel
        $nama_PTK          = $row['B']; // Ambil data mapel
        $jk_PTK            = $row['C']; // Ambil data kode mapel
        $jabatan_PTK       = $row['D']; // Ambil data mapel
        $jenis_PTK         = $row['E']; // Ambil data mapel

    
        // Cek jika semua data tidak diisi
        if(empty($id_PTK) && empty($nama_PTK) && empty($jk_PTK) && empty($jabatan_PTK) && empty($jenis_PTK))
        
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        
        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if($numrow > 1){
        // Proses simpan ke Database
        $sql->bindParam(':id_PTK', $id_PTK);
        $sql->bindParam(':nama_PTK', $nama_PTK);
        $sql->bindParam(':jk_PTK', $jk_PTK);
        $sql->bindParam(':jabatan_PTK', $jabatan_PTK);
        $sql->bindParam(':jenis_PTK', $jenis_PTK);
        
        $sql->execute(); // Eksekusi query insert
        
        }
        $numrow++; // Tambah 1 setiap kali looping
    }
    }

    echo "<script>alert( 'Data Mata Pelajaran berhasil di import ' );window.location='TampilPTK.php';</script>"; // kemabali ke halaman tampil_siswa.php
?>