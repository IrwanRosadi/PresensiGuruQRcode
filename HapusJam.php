<?php 
  // menggunakan header
  
  

	include 'Koneksi.php';

	$id_jam	=$_GET['id_jam'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_jam WHERE id_jam='$id_jam'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_jam WHERE id_jam='$id_jam' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilJam.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilJam.php'</script>";
	}


  // menggunakan footer
 