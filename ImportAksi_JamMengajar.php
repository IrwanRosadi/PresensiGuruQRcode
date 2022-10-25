<?php
    // menghubungkan dengan koneksi
include 'Koneksi.php';
// menghubungkan dengan library excel reader
include 'excel_reader2.php';
?>
 
<?php
// upload file xls
$target = basename($_FILES['fileJamMulai']['name']) ;
move_uploaded_file($_FILES['fileJamMulai']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['fileJamMengajar']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['fileJamMengajar']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id_jam     		= $data->val($i, 1);
	$jam_mulai          = $data->val($i, 2);
	$jam_berakhir    	= $data->val($i, 3);
	$keterangan          = $data->val($i, 4);
 
	if($id_jam_mulai != "" && $jam_mulai != "" && $jam_berakhir != "" && $keterangan != "" ){
		// input data ke database (table data_pegawai)
		
		mysqli_query($koneksi,"INSERT INTO tb_jam VALUES ('$id_jam')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['fileJamMengajar']['name']);
 
// alihkan halaman ke index.php
header("location:TampilJam.php");
?>