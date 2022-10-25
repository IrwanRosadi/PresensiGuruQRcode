<?php 
  

	include 'Koneksi.php';

	$kode_kelas	=$_GET['kode_kelas'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_kelas WHERE kode_kelas='$kode_kelas'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_kelas WHERE kode_kelas='$kode_kelas' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilKelas.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilKelas.php'</script>";
	}


