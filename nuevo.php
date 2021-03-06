<?php
	include("conexion.php");
	session_start();
	if(isset($_SESSION['username'])){
		$usuario =  $_SESSION['username'];
		$obtenertipo = "select tipo from usuarios where usuario = '$usuario'";
		$consultar = mysqli_query($conexion, $obtenertipo);
		$tip = mysqli_fetch_array($consultar);
		if($tip['tipo'] == "1"){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
	<title>Agregar</title>
</head>
<body style="background-color:pink;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">
	    	<img src="icon.png" width="30" height="30" class="d-inline-block align-top" alt="">Plataforma
	    </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto"></ul>
			<form class="form-inline my-2 my-lg-0" method="post" action="">
				<button type="submit" class="btn btn-outline-info my-2 my-sm-0" name="cerrarsesion">Cerrar Sesion</button>
			</form>
		</div>
	</nav>
	<div class="container-fluid">
		<br>
		<p class="h1 text-center font-weight-bold">Agregar nuevo usuario</p>
		<br><br>
		<div class="row justify-content-md-center">
			<div class="col col-lg-4">
				<form method="post">
					<div class="form-group col-md-auto">
						<label for="nameuser" class="font-weight-bold">Nombre de usuario</label>
						<input type="text" class="form-control" name="userreg" placeholder="Nombre de usuario" required>
					</div>
					<div class="form-group col-md-auto">
						<label for="passuser" class="font-weight-bold">Contraseña</label>
						<input type="password" class="form-control" name="pwreg" placeholder="Contraseña" required>
					</div>
					<div class="form-group col-md-auto">
						<label for="passrepuser" class="font-weight-bold">Repetir contraseña</label>
						<input type="password" class="form-control" name="pwregveri" placeholder="Repetir Contraseña" required>
					</div>
					<div class="form-group col-md-auto">
						<label for="tipouser" class="font-weight-bold">Tipo de usuario</label>
						<select class="form-control" name="tipo">
							<option selected value="0">Usuario</option>
							<option value="1">Administrador</option>
						</select>
					</div>
					<div class="form-group col-md-auto">
						<button type="submit" class="btn btn-dark col-md-auto" name="agregar">Agregar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col col-md-auto">
				<div class="form-group">
					<a class="btn btn-dark font-weight-bold" href="index.php">Regresar</a>
				</div>
			</div>
		</div>
	</div>
<?php
	if(isset($_POST['cerrarsesion'])){
		session_destroy();
		header('location: index.php');
	}
	include("conexion.php");
	if(isset($_POST['agregar'])){
		if($_POST['userreg'] == '' or $_POST['pwreg'] == ''){
			echo "Debe llenar todos los campos";
		}else{
			$sql = 'select * from usuarios';
			$rec = mysqli_query($conexion, $sql);
			$existe = 0;

			while ($resultado = mysqli_fetch_object($rec)) {
				if($resultado->usuario == $_POST['userreg']){
					$existe = 1;
				}
			}
			if($existe == 0){
				if($_POST['pwreg'] == $_POST['pwregveri']){
					$nom = $_POST['userreg'];
					$pw = $_POST['pwreg'];
					$tp = $_POST['tipo'];
					$pwEnc = password_hash($pw, PASSWORD_DEFAULT);

					$conexion->query("insert into usuarios (usuario, password, tipo, passencrip) values ('$nom', '$pw', '$tp', '$pwEnc')");
					mysqli_query($conexion, $sql);

					//echo "El usuario ha sido modificado con exito";
					header("location: index.php");
				}else{
?>
					<br>
					<p class="h1 text-center font-weight-bold">Las contraseñas no coinciden</p>
<?php
				}
			}else{
?>
				<br>
				<p class="h1 text-center font-weight-bold">El usuario ya existe</p>
<?php
			}
		}
	}
?>
</body>
</html>
<?php
		}else{
			header("location: index.php");
		}
	}else{
		header("location: index.php");
	}
?>
