<?php 
  require_once 'Koneksi.php';
?>

<?php 
	if(isset($_POST['submit'])) {
		$id_presensi_pulang = $_POST['id_presensi_pulang'];
		$id_PTK = $_POST['id_PTK'];
		$keterangan = addslashes($_POST['keterangan']);
		date_default_timezone_set('Asia/Kuala_Lumpur'); //lingkup tgl, bulan dan waktu
		$tanggal = date ("d-m-Y");
		$bulan = date ("m");
		$jam_presensi = date ("h:i:sa");

	$queri=mysqli_query($koneksi,"SELECT * FROM tb_presensi_pulang WHERE id_presensi_pulang='$id_presensi_pulang' AND tanggal='$tanggal'");
	$cek=mysqli_num_rows($queri);
	if($cek > 0){
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/sudah_presensi.mp3'],
			volume: 0.5,
			onend: function () {
			window.location='validasi-QR-Pulang';
			}
			});
			sound.play()
		</script>
	<?php
	}else{
		
	$aa = "INSERT INTO tb_presensi_pulang VALUES ('$id_presensi_pulang','$jam_presensi','$tanggal','$bulan','$keterangan','$id_PTK')";
	$b = mysqli_query($koneksi, $aa);
		if($b) {
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/berhasil.mp3'],
			volume: 0.5,
			onend: function () {
			window.location='validasi-QR-Pulang';
			}
			});
			sound.play()
		</script>
	<?php	} else {
		echo "gagal";
	}	
	}
	}
 ?>	

	
