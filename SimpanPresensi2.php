<?php 
  require_once 'Koneksi.php';
?>

<?php 
	if(isset($_POST['submit3'])) {
		$id_hasil_presensi = $_POST['id_hasil_presensi'];
		$id_jadwal = $_POST['id_jadwal'];
		$keterangan = addslashes($_POST['keterangan']);
		date_default_timezone_set('Asia/Kuala_Lumpur'); //lingkup tgl, bulan dan waktu
		$tanggal = date ("d-m-Y");
		$bulan = date ("m");
		$jam_presensi = date ("h:i:sa");
		$id_PTK = $_POST['id_PTK'];
		$keterlambatan = $_POST['keterlambatan'];

	$queri=mysqli_query($koneksi,"SELECT * FROM tb_hasil_presensi WHERE id_jadwal='$id_jadwal' AND tanggal='$tanggal'");
	$cek=mysqli_num_rows($queri);
	if($cek > 0){
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/sudah_presensi.mp3'],
			volume: 0.5,
			onend: function () {
			window.location='validasi-QR2';
			}
			});
			sound.play()
		</script>
	<?php
	}else{
		
	$a = "INSERT INTO tb_hasil_presensi VALUES ('$id_hasil_presensi','$id_jadwal','$jam_presensi','$keterangan','$tanggal','$bulan','$id_PTK','$keterlambatan')";
	$b = mysqli_query($koneksi, $a);
		if($b) {
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/berhasil2.mp3'],
			volume: 0.5,
			onend: function () {
			// window.location='validasi-QR2';
			window.location='Beranda.php';
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

	
