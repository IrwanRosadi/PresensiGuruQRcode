<?php 
 
  

	include 'Koneksi.php';

	$kode_mapel	=$_GET['kode_mapel'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_mapel WHERE kode_mapel='$kode_mapel'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_mapel WHERE kode_mapel='$kode_mapel' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilMapel.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilMapel.php'</script>";
	}

