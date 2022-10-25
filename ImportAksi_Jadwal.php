<?php
    // menghubungkan dengan koneksi
include 'Koneksi.php';
// menghubungkan dengan library excel reader
include 'excel_reader2.php';
?>
 
<?php
// upload file xls
$target = basename($_FILES['fileJadwal']['name']) ;
move_uploaded_file($_FILES['fileJadwal']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['fileJadwal']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['fileJadwal']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id_jadwal      	  = $data->val($i, 1);
	$hari      	  		  = $data->val($i, 2);
	$id_jam_mulai      	  = $data->val($i, 3);
	$id_jam_berakhir      = $data->val($i, 4);
	$kode_kelas           = $data->val($i, 5);
	$kode_mapel           = $data->val($i, 6);
	$id_PTK               = $data->val($i, 7);
 
	if($id_jadwal != "" && $hari != "" && $id_jam_mulai != "" && $id_jam_berakhir != "" && $kode_kelas != ""
		&& $kode_mapel != "" && $id_PTK != ""){
		// input data ke database (table data_pegawai)
		
		mysqli_query($koneksi,"INSERT INTO tb_jadwal VALUES ('$id_jadwal')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['fileJadwal']['name']);
 
// alihkan halaman ke index.php
header("location:TampiljJadwal.php");
?>