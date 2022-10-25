<?php 
	session_start(); //jalankan session
	$_SESSION = []; //utk lebih memastikan bahwa session sudah hliang
	session_unset(); //utk lebih memastikan bahwa session sudah hliang
	session_destroy(); //hilangkan/hancurkan sessionya

	 header("location:login.php");
 ?>	