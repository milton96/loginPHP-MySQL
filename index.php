<?php
	include("conexion.php");
	session_start();
	if(isset($_SESSION['username'])){
		$usuario =  $_SESSION['username'];
		$obtenertipo = "select tipo from usuarios where usuario = '$usuario'";
		$consultar = mysqli_query($conexion, $obtenertipo);
		$tip = mysqli_fetch_array($consultar);

		if($tip['tipo'] != "1"){
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
	<title>Portal de usuario</title>
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
	<p class="h1 text-center font-weight-bold">¡Bienvenid@! <?php echo $_SESSION['username']; ?></p>
<?php
	if(isset($_POST['cerrarsesion'])){
		session_destroy();
		header('location: index.php');
	}
?>
</body>
</html>
<?php
		}else{
			$where = "";
			$sql = "select id,usuario,password,tipo from usuarios";
			$resultado = mysqli_query($conexion, $sql);
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
	<title>Portal de Administrador</title>
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
			<ul class="navbar-nav mr-auto">
				<form class="col-md-auto" method="post" action="nuevo.php">
					<button type="submit" class="btn btn-dark col-md-auto font-weight-bold" name="nuevousuario">Nuevo usuario</button>
				</form>
			</ul>
			<form class="form-inline my-2 my-lg-0" method="post" action="">
				<button type="submit" class="btn btn-outline-info my-2 my-sm-0" name="cerrarsesion">Cerrar Sesion</button>
			</form>
		</div>
	</nav>
	<br>
	<p class="h1 text-center font-weight-bold">¡Bienvenid@! <?php echo $_SESSION['username'];?></p>	
	<br><br>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<table class="table table-responsive table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Id</th>
							<th>Usuario</th>
							<th>Contraseña</th>
							<th>Tipo usuario</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($row = mysqli_fetch_array($resultado)) {
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['usuario']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><?php if($row['tipo'] == "1"){ echo "Administrador";} else {echo "Usuario";} ?></td>
							<td><a class="btn btn-link text-dark font-weight-bold" href="modificar.php?id=<?php echo $row['id']; ?>">Editar</a></td>
							<td><a class="btn btn-link text-dark font-weight-bold" href="#" data-href="eliminar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirmarDelete">Eliminar</a>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
	<div class="modal fade" id="confirmarDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">¿Seguro que desea eliminar este usuario?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-ok text-white">Eliminar</a>
					<button type="submit" class="btn btn-info btn-ok" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#confirmarDelete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href',$(e.relatedTarget).data('href'));
		$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	});
</script>
<?php
	if(isset($_POST['cerrarsesion'])){
		session_destroy();
		header('location: index.php');
	}
?>
</body>
</html>
<?php
		}
	}else{
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
	<title>Login</title>
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
		</div>
	</nav>
	<div class="container-fluid">
		<br>
		<p class="h1 text-center font-weight-bold">Inicia sesion</p>
		<br><br>
		<div class="row justify-content-md-center">
			<div class="col col-lg-4">
				<form method="post">
					<div class="form-group col-md-auto">
						<label for="user" class="font-weight-bold">Usuario</label>
						<input type="text" class="form-control" name="userlogin" placeholder="Usuario" required>
					</div>
					<div class="form-group col-md-auto">
						<label for="pass" class="font-weight-bold">Contraseña</label>
						<input type="password" class="form-control" name="pwlogin" placeholder="Contraseña" required>
					</div>
					<div class="form-group col-md-auto">
						<button type="submit" class="btn btn-dark col-md-auto font-weight-bold" name="iniciarsesion">Iniciar Sesion</button>
					</div>
				</form>		
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col col-md-auto">
				<div class="form-group">
					<label for="regi" class="font-weight-bold">¿No tienes una cuenta?<a class="btn btn-link text-dark font-weight-bold" href="registro.php">Registrate aqui</a></label>
				</div>
			</div>
		</div>
	</div>
<?php
	include("conexion.php");
	if(isset($_POST['iniciarsesion'])){
		if(isset($_POST['userlogin']) && !empty($_POST['userlogin']) && isset($_POST['pwlogin']) && !empty($_POST['pwlogin'])){
			$sqldos = "select usuario,passencrip from usuarios where usuario='$_POST[userlogin]'";
			$recdos = mysqli_query($conexion, $sqldos);
			$sesion = mysqli_fetch_array($recdos);

			if(password_verify($_POST['pwlogin'], $sesion['passencrip'])){
				$_SESSION['username'] = $_POST['userlogin'];
				header("location: index.php");
			}else{
?>
				<br>
				<p class="h1 text-center font-weight-bold">Datos Erroneos!</p>
<?php
			}
		}else{
?>
			<br>
			<p class="h1 text-center font-weight-bold">Ups! Falta algo</p>
<?php
		}
	}
?>
</body>
</html>
<?php
	}
?>

