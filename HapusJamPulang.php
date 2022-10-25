<?php 
  // menggunakan header
  
  

	include 'Koneksi.php';

	$id_jam_pulang	=$_GET['id_jam_pulang'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_jam_pulang WHERE id_jam_pulang='$id_jam_pulang'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_jam_pulang WHERE id_jam_pulang='$id_jam_pulang' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilJamPulang.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilJamPulang.php'</script>";
	}


  // menggunakan footer
 