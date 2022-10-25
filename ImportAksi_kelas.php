<?php
    // menghubungkan dengan koneksi
include 'Koneksi.php';
// menghubungkan dengan library excel reader
include 'excel_reader2.php';
?>
 
<?php
// upload file xls
$target = basename($_FILES['filekelas']['name']) ;
move_uploaded_file($_FILES['filekelas']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filekelas']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filekelas']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$kode_kelas      = $data->val($i, 1);
	$nama_kelas      = $data->val($i, 2);
 
	if($kode_kelas != "" && $nama_kelas != "" ){
		// input data ke database (table data_pegawai)
		
		mysqli_query($koneksi,"INSERT INTO tb_kelas VALUES ('$kode_kelas')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filekelas']['name']);
 
// alihkan halaman ke index.php
header("location:TampilKelas.php");
?>