<?php
    // menghubungkan dengan koneksi
include 'Koneksi.php';
// menghubungkan dengan library excel reader
include 'excel_reader2.php';
?>
 
<?php
// upload file xls
$target = basename($_FILES['filePTK']['name']) ;
move_uploaded_file($_FILES['filePTK']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filePTK']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filePTK']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id_PTK      	  = $data->val($i, 1);
	$nama_PTK      	  = $data->val($i, 2);
	$jk_PTK      	  = $data->val($i, 3);
	$jabatan_PTK      = $data->val($i, 4);
	$jenis_PTK        = $data->val($i, 5);
 
	if($id_PTK != "" && $nama_PTK != "" && $jk_PTK != "" && $jabatan_PTK != "" && $jenis_PTK != "" ){
		// input data ke database (table data_pegawai)
		
		mysqli_query($koneksi,"INSERT INTO tb_ptk VALUES ('$id_PTK')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filePTK']['name']);
 
// alihkan halaman ke index.php
header("location:TampilPTK.php");
?>