<?php
    // Load file koneksi.php
    $host = 'localhost'; // Nama hostnya
    $username = 'root'; // Username
    $password = ''; // Password (Isi jika menggunakan password)
    $database = 'db_presensi'; // Nama databasenya

    // Koneksi ke MySQL dengan PDO
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);


    if(isset($_POST['import'])){ // Jika user mengklik tombol Import
    $nama_file_baru = 'DataJamBerakhir.xlsx';
    
    // Memanggil librari PHPExcel nya
    require_once 'PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat query Insert
    $sql = $pdo->prepare("INSERT INTO tb_jam_berakhir VALUES(:id_jam_berakhir,:jam_berakhir)");
    

    
    
    $numrow = 1;
    foreach($sheet as $row){
        // Ambil data pada excel sesuai Kolom
        $id_jam_berakhir      = $row['A']; // Ambil data kode mapel
        $jam_berakhir         = $row['B']; // Ambil data mapel

    
        // Cek jika semua data tidak diisi
        if(empty($id_jam_berakhir) && empty($jam_berakhir) )
        
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        
        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if($numrow > 1){
        // Proses simpan ke Database
        $sql->bindParam(':id_jam_berakhir', $id_jam_berakhir);
        $sql->bindParam(':jam_berakhir', $jam_berakhir);
        
        $sql->execute(); // Eksekusi query insert
        
        }
        $numrow++; // Tambah 1 setiap kali looping
    }
    }

    echo "<script>alert( 'Data jam berakhir mengajar berhasil di import ' );window.location='TampilJamBerakhir.php';</script>"; // kemabali ke halaman tampil_siswa.php
?>