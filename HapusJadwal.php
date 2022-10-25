<?php 
  // menggunakan header
  
  

	include 'Koneksi.php';

	$id_jadwal	=$_GET['id_jadwal'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_jadwal WHERE id_jadwal='$id_jadwal'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_jadwal WHERE id_jadwal='$id_jadwal' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilJadwal.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilJadwal.php'</script>";
	}


  // menggunakan footer
 