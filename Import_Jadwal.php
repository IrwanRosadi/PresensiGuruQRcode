<?php
    // Load file koneksi.php
    $host = 'localhost'; // Nama hostnya
    $username = 'root'; // Username
    $password = ''; // Password (Isi jika menggunakan password)
    $database = 'db_presensi'; // Nama databasenya

    // Koneksi ke MySQL dengan PDO
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);


    if(isset($_POST['import'])){ // Jika user mengklik tombol Import
    $nama_file_baru = 'DataJadwal.xlsx';
    
    // Memanggil librari PHPExcel nya
    require_once 'PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat query Insert
    $sql = $pdo->prepare("INSERT INTO tb_jadwal VALUES(:id_jadwal,:hari,:id_jam_mulai,:id_jam_berakhir,:kode_kelas,:kode_mapel,:id_PTK)");
    
    
    $numrow = 1;
    foreach($sheet as $row){
        // Ambil data pada excel sesuai Kolom
        $id_jadwal            = $row['A']; // Ambil data kode mapel
        $hari                 = $row['B']; // Ambil data mapel
        $id_jam_mulai         = $row['C']; // Ambil data kode mapel
        $id_jam_berakhir      = $row['D']; // Ambil data mapel
        $kode_kelas           = $row['E']; // Ambil data mapel
        $kode_mapel           = $row['F'];
        $id_PTK               = $row['G'];
    
        // Cek jika semua data tidak diisi
        if(empty($id_jadwal) && empty($hari) && empty($id_jam_mulai) && empty($id_jam_berakhir) 
            && empty($kode_kelas) && empty($kode_mapel) && empty($id_PTK))
        
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        
        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if($numrow > 1){
        // Proses simpan ke Database
        $sql->bindParam(':id_jadwal', $id_jadwal);
        $sql->bindParam(':hari', $hari);
        $sql->bindParam(':id_jam_mulai', $id_jam_mulai);
        $sql->bindParam(':id_jam_berakhir', $id_jam_berakhir);
        $sql->bindParam(':kode_kelas', $kode_kelas);
        $sql->bindParam(':kode_mapel', $kode_mapel);
        $sql->bindParam(':id_PTK', $id_PTK);
        
        $sql->execute(); // Eksekusi query insert
        
        }
        $numrow++; // Tambah 1 setiap kali looping
    }
    }

    echo "<script>alert( 'Data Jadwal berhasil di import ' );window.location='TampiJadwal.php';</script>"; // kemabali ke halaman tampil_siswa.php
?>