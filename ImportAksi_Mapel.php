<?php
    // menghubungkan dengan koneksi
include 'Koneksi.php';
// menghubungkan dengan library excel reader
include 'excel_reader2.php';
?>
 
<?php
// upload file xls
$target = basename($_FILES['filemapel']['name']) ;
move_uploaded_file($_FILES['filemapel']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filemapel']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filemapel']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$kode_mapel      = $data->val($i, 1);
	$mapel      = $data->val($i, 2);
 
	if($kode_mapel != "" && $mapel != "" ){
		// input data ke database (table data_pegawai)
		
		mysqli_query($koneksi,"INSERT INTO tb_mapel VALUES ('$kode_mapel')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filemapel']['name']);
 
// alihkan halaman ke index.php
header("location:TampilMapel.php");
?>