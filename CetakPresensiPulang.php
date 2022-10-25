<?php 
    // require_once 'Tamplate/Layout/Header.php';
    session_start();
    require_once 'Koneksi.php';
 ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        th{
            background-color:silver;
        }
        hr{
            border: 0;
            border-top: 4px double black;
        }
        table{
            font-family:arial;
            
        }
        
    </style>
</head>
<body>
    <br><br>
    <table color="black" align="center" border="0" width="" height="">
        <tr>
            <td><img src="img/logo_sma.PNG" height="75px" width="75px"><td> &nbsp;&nbsp;&nbsp;&nbsp;
            <td><h3 style="text-align: center; line-height: 1.4; font-weight: bold"><font size="4px">
                Laporan Presensi Kehadiran Guru tetap dan Pegawai</br>SMAN 1 Pringgabaya</font></h3><td>
        <tr>
    </table><hr width="80%">
    
    <br>
    <table border="1" align="center" width="80%" cellspacing="0">
        <tr align='center' bgcolor=''>
                                   
            <th rowspan="">No.</th>
            <th rowspan="">Nama PTK</th>
            <th colspan="">Total Presensi</th>
        </tr>
        
        <?php
        $no = 1;
        $tgl = date ("d-m-Y");//format tgl
        $a ="SELECT * from tb_ptk WHERE EXISTS (
            SELECT * FROM tb_presensi_pulang
            WHERE tb_ptk.id_PTK = tb_presensi_pulang.id_PTK)";
        $b =mysqli_query($koneksi,$a);     
        while($c=mysqli_fetch_array($b)){
        ?>
        <tr align="">
            <td align="center"><?php echo  $no++ ?></td>
            <td>&nbsp;<?php echo $c['nama_PTK']; ?></td>
            
            <?php
                $get = mysqli_query($koneksi, "SELECT * FROM tb_presensi_pulang WHERE keterangan = 'Pulang' AND id_PTK='$c[id_PTK]'" );
                $count = mysqli_num_rows($get);

                ?>

            <td align="center"><?php echo $count; ?></td>
            
        </tr>
        <?php } ?>
    </table>

</table><br>
<!--Desain tampilan utk Ttd Siswa dan Admin serta tgl -->
<table border="0" cellspacing="" align="center" width="80%">
<tr>
	<!-- <td width="" align="center">Siswa,</td> -->
	
	<td align="right" width="">Pringgabaya, <?php echo $tgl;?><br>Kepala Sekolah,</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>

<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>

<?php
//menampilkan nama Admin pada ttd sesuai yg login
// $aa="select * from tb_user where username='$_SESSION[username]'";
// $bb=mysqli_query($koneksi,$aa);
// $cc=mysqli_fetch_array($bb);
?>
<tr>
	
	<td align="right"><b>Hasanudin, S.Pd</b></td>
</tr>
</table>

</body>
</html>
    
<!-- Script utk print -->
     <script> 
		window.print();
	</script> 
 