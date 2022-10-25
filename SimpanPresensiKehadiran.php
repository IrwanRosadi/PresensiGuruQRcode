<?php 
  require_once 'Koneksi.php';
?>

<?php 
	if(isset($_POST['submit2'])) {
		$id_kehadiran = $_POST['id_kehadiran'];
		$id_PTK = $_POST['id_PTK'];
		$keterangan = addslashes($_POST['keterangan']);
		date_default_timezone_set('Asia/Kuala_Lumpur'); //lingkup tgl, bulan dan waktu
		$tanggal = date ("d-m-Y");
		$bulan = date ("m");
		$jam_presensi = date ("h:i:sa");
		$keterlambatan = $_POST['keterlambatan'];

	$queri=mysqli_query($koneksi,"SELECT * FROM tb_kehadiran WHERE id_kehadiran='$id_kehadiran' AND tanggal='$tanggal'");
	$cek=mysqli_num_rows($queri);
	if($cek > 0){
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/sudah_presensi.mp3'],
			volume: 0.5,
			onend: function () {
			window.location='validasi-QR1';
			}
			});
			sound.play()
		</script>
	<?php
	}else{
		
	$aa = "INSERT INTO tb_kehadiran VALUES ('$id_kehadiran','$jam_presensi','$keterangan','$tanggal','$bulan','$id_PTK','$keterlambatan')";
	$b = mysqli_query($koneksi, $aa);
		if($b) {
	?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js'></script>
		<script>
			var sound = new Howl({
			src: ['suara/berhasil.mp3'],
			volume: 0.5,
			onend: function () {
			window.location='validasi-QR1';
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

	
