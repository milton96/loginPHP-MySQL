<?php
	$host = "localhost";
	$hostuser = "root";
	$hostpw = "1234";
	$hostdb = "login";

	$conexion = mysqli_connect($host, $hostuser, $hostpw, $hostdb);
	
	if($conexion){
		#echo "conectado";
		return;
	}else{
		echo "no conectado";
	}
?>