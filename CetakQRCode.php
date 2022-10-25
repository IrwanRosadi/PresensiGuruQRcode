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
    <title>Cetak ID Card</title>
    <style>
        *{
            margin:10px;
        }
    </style>
</head>
<body>



<?php
    include_once 'Koneksi.php';
    $x="select * from tb_ptk WHERE tb_ptk.id_PTK='$_GET[id_PTK]'";
    $y=mysqli_query($koneksi,$x);
    $z=mysqli_fetch_array($y);  
?>

    <table border="1" align="left" width="85,60mm" height="53,98mm" cellspacing="0">
        <tr>   
            <th> <img src="temp/<?php echo $z['id_PTK'].".png"; ?>" height="150" width="150">&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr align="center">
    
        </tr>         
    </table>

</body>
</html>
    
<!-- Script utk print -->
     <!-- <script> 
		window.print();
	</script>  -->
 