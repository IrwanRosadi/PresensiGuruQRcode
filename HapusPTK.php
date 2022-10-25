<?php 

  

	include 'Koneksi.php';

	$id_PTK	=$_GET['id_PTK'];
	$a=mysqli_query($koneksi,"SELECT * FROM tb_ptk WHERE id_PTK='$id_PTK'");
	$b=mysqli_fetch_array($a);

	$query=mysqli_query($koneksi," DELETE FROM tb_ptk WHERE id_PTK='$id_PTK' ");						
	if ($query) {
		echo "<script> alert('Data berhasil dihapus') </script>";
		echo "<script>location='TampilPTK.php'</script>";
	}
	else{
		echo "<script> alert('Data gagal dihapus') </script>";
		echo "<script>location='TampilPTK.php'</script>";
	}

