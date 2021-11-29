<?php 
	include_once 'conexion.php';
	session_start();

	if(isset($_SESSION['user'])){
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];
		$placa=$_POST['placa'];
		$servicio=$_POST['servicio'];
		$modelo=$_POST['modelo'];

		if(!empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($direccion) && !empty($correo) && !empty($placa) && !empty($servicio) && !empty($modelo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO tallerpfinal(nombre,apellido,telefono,direccion,correo,placa,servicio,modelo) VALUES(:nombre,:apellido,:telefono,:direccion,:correo,:placa,:servicio,:modelo)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':telefono' =>$telefono,
					':direccion' =>$direccion,
					':correo' =>$correo,
					':placa' =>$placa,
					':servicio' =>$servicio,
					':modelo' =>$modelo
				));
				header('Location: pfinal.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>SISTEMA DE REGISTRO DE REPAIR COMPUTER S.A</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="apellido" placeholder="Apellido" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Teléfono" class="input__text">
				<input type="text" name="direccion" placeholder="Direccion" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" placeholder="Correo" class="input__text">
				<input type="text" name="placa" placeholder="Equipo" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="servicio" placeholder="Servicio" class="input__text">
				<input type="text" name="modelo" placeholder="Modelo" class="input__text">
			</div>
			<div class="btn__group">
				<a href="pfinal.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>

<?php
} else {
	header("location:index.php");
	}
?>
