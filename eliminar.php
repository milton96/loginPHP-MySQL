<?php
	include("conexion.php");
	session_start();
	$id = $_GET['id'];
	if(isset($_SESSION['username']) && $id != null){
		$sql = "delete from usuarios where id = '$id'";
		$resultado = mysqli_query($conexion, $sql);
		if($resultado){
			#echo "eliminado";
			header('location: index.php');
		}else{
			#echo "error";
		}
	}else{
		header("location: index.php");
	}
?>